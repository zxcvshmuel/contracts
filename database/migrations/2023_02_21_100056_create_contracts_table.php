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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable()->default(null);
            $table->integer('events_id')->nullable()->default(null);
            $table->integer('type')->nullable();
            $table->longText('email')->nullable();
            $table->longText('customer_name')->nullable();
            $table->longText('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('items')->nullable();
            $table->longText('contracts_content')->nullable();
            $table->longText('signed_url')->nullable();
            $table->longText('contract_url')->nullable();
            $table->longText('signe_data')->default(null);
            $table->boolean('sent')->default(false);
            $table->timestamp('sent_at')->nullable();
            $table->boolean('opened')->default(false);
            $table->timestamp('open_at')->nullable();
            $table->boolean('signed')->default(false);
            $table->timestamp('signe_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
