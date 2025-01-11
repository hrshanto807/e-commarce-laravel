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
        Schema::create('sslcommerz_accounts', function (Blueprint $table) {
            $table->id();

            $table->string('store_id',200);
            $table->string('store_password',200);
            $table->string('store_currency',200);
            $table->string('success_url',200);
            $table->string('fail_url',200);
            $table->string('cancel_url',200);
            $table->string('ipn_url',200);
            $table->string('init_url',200);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sslcommerz_accounts');
    }
};
