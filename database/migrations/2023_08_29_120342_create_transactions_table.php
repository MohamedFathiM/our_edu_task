<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('paid_amount');
            $table->string('currency');
            $table->string('parent_email');
            $table->integer('status_code')->comment('1 = authorized, 2 = decline ,3 = refunded');
            $table->date('payment_date');
            $table->string('parent_identification');
            $table->foreignId('user_id')->nullable()->constrained('users');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
