<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deals', function (Blueprint $table) {

            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('discount_percent');

            $table->dateTime('start_date');

            $table->dateTime('end_date');

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('deals');
    }
};