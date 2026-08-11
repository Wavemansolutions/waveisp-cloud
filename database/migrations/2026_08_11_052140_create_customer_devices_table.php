<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('customer_devices')) {
            Schema::create('customer_devices', function (Blueprint $table) {
                $table->id();

                $table->string('mac_address', 32)->unique();
                $table->string('ip_address', 45)->nullable();

                $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
                $table->foreignId('router_id')->nullable()->constrained('routers')->nullOnDelete();

                $table->string('status')->default('seen');

                $table->timestamp('first_seen_at')->nullable();
                $table->timestamp('last_seen_at')->nullable();

                $table->text('last_user_agent')->nullable();

                $table->timestamps();

                $table->index(['customer_id', 'status']);
                $table->index(['router_id', 'status']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_devices');
    }
};