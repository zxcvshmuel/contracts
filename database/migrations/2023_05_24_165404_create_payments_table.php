<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('package_id')->nullable()->default(null);
            $table->string('action')->nullable()->default(null);
            $table->string('info')->nullable()->default(null);
            $table->string('heshDesc')->nullable()->default(null);
            $table->decimal('amount', 8, 2)->nullable()->default(null);
            $table->string('payment_status')->nullable()->default(null);
            $table->string('payment_method')->nullable()->default(null);
            $table->string('transaction_id')->nullable()->default(null);
            $table->timestamp('payment_date')->nullable();
            $table->longText('request')->nullable()->default(null);
            $table->longText('response')->nullable()->default(null);
            $table->string('transaction_code')->nullable()->default(null);
            $table->string('transaction_status')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
