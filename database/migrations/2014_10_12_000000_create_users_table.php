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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->nullable()->default(null);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password')->default('12345');
            $table->string('currency')->default('usd');
            $table->string('contract_color')->default('#2cb4f34d');
            $table->string('country')->default('us');
            $table->integer('user_type')->default(1);
            $table->string('color')->default('blue');
            $table->dateTime('active_until')->default('2023-02-19 18:08:59')->nullable();
            $table->longText('logo_url')->nullable();
            $table->string('comp_id')->nullable();
            $table->string('comp_name')->nullable();
            $table->longText('signature')->nullable();
            $table->string('comp_email')->nullable();
            $table->string('comp_phone')->nullable();
            $table->string('comp_address')->nullable();
            $table->boolean('licensed_dealer')->default(false);
            $table->longText('custom_text')->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
