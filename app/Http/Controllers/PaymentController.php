<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function index(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // پیدا کردن رکورد پرداختی که در مرحله checkout ایجاد شده بود
        $payment = $order->payments()->first() ?? (object) [
            'method' => 'zarinpal',
            'amount' => $order->total_price
        ];

        return view('payment.index', compact('order', 'payment'));
    }

    public function zarinpal(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $amount = (int) preg_replace('/[^0-9.]/', '', $order->total_price);
        if ($amount < 1000) { $amount = 1000; }

        // 👈 به جای create جدید، رکورد ایجاد شده در مرحله checkout را پیدا میکنیم
        $payment = $order->payments()->firstOrCreate(
            ['status' => 'pending'],
            ['amount' => $amount, 'method' => 'zarinpal']
        );

        $response = Http::withoutVerifying()
            ->timeout(15)
            ->post('https://sandbox.zarinpal.com/pg/v4/payment/request.json', [
                'merchant_id'  => 'ffffffff-ffff-ffff-ffff-ffffffffffff',
                'amount'       => $amount,
                'callback_url' => url('/payment/callback'),
                'description'  => 'Payment for Order #' . $order->id,
                'metadata'     => [
                    'order_id' => (string) $order->id,
                ]
            ]);

        if (!$response->successful()) {
            $payment->update(['status' => 'failed']); 
            dd('خطا در اتصال به درگاه', $response->json());
        }

        $result = $response->json();

        if (isset($result['data']['code']) && $result['data']['code'] == 100) {
            $authority = $result['data']['authority'];

            $payment->update([
                'authority' => $authority
            ]);

            return redirect()->to("https://sandbox.zarinpal.com/pg/StartPay/{$authority}");
        }

        $payment->update(['status' => 'failed']);
        dd('زرین‌پال آتوریتی صادر نکرد:', $result);
    }

    public function callback(Request $request)
    {
        $authority = $request->query('Authority');
        $status = $request->query('Status');

        // ۱. پیدا کردن رکورد پرداخت بر اساس آتوریتی برگشتی از زرین‌پال
        $payment = Payment::where('authority', $authority)->first();

        if (!$payment) {
            return redirect()->route('payment.failed')->with('error', 'تراکنش یافت نشد.');
        }

        if ($status === 'OK') {
            // ۲. آپدیت جدول payments به وضعیت موفقیت‌آمیز
            $payment->update([
                'status' => 'success',
                'paid_at' => now()
            ]);

            // ۳. آپدیت جدول orders به وضعیت پردازش یا پرداخت شده (از حالت کامنت خارج شد)
            $order = $payment->order;
            if ($order) {
                $order->update([
                    'status' => 'processing' // یا 'paid' بر اساس استراتژی پروژه
                ]);
                
                return redirect()->route('order.success', $order);
            }
        }

        // اگر پرداخت ناموفق بود یا کاربر لغو کرد
        $payment->update(['status' => 'failed']);
        return redirect()->route('payment.failed')->with('error', 'تراکنش ناموفق بود یا لغو شد.');
    }
}