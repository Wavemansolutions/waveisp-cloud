<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users') && ! Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_admin')->default(false)->after('password');
            });
        }

        if (! Schema::hasTable('routers')) {
            Schema::create('routers', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('ip_address');
                $table->unsignedInteger('api_port')->default(8728);
                $table->string('username');
                $table->text('password');
                $table->boolean('api_ssl')->default(false);
                $table->string('location')->nullable();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('plans')) {
            Schema::create('plans', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('price', 12, 2);
                $table->unsignedInteger('validity_value')->default(1);
                $table->string('validity_unit')->default('days');
                $table->unsignedBigInteger('data_limit_mb')->default(0);
                $table->string('mikrotik_profile')->default('WAVEISP-2M');
                $table->string('speed_limit')->nullable();
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('customers')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->id();

                $table->string('full_name')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();

                $table->string('mac_address', 32)->nullable()->index();
                $table->string('ip_address', 45)->nullable();
                $table->timestamp('last_seen_at')->nullable();

                $table->string('username')->nullable()->unique();
                $table->string('password')->nullable();

                $table->foreignId('router_id')->nullable()->constrained('routers')->nullOnDelete();
                $table->foreignId('plan_id')->nullable()->constrained('plans')->nullOnDelete();

                $table->string('status')->default('active');

                $table->timestamp('starts_at')->nullable();
                $table->timestamp('expires_at')->nullable();

                $table->boolean('mikrotik_created')->default(false);
                $table->timestamp('mikrotik_created_at')->nullable();
                $table->text('mikrotik_error')->nullable();

                $table->softDeletes();
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('payments')) {
            Schema::create('payments', function (Blueprint $table) {
                $table->id();

                $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
                $table->foreignId('plan_id')->nullable()->constrained('plans')->nullOnDelete();

                $table->decimal('amount', 12, 2);
                $table->string('reference')->unique();
                $table->string('provider')->default('paystack');
                $table->string('status')->default('pending');

                $table->json('payload')->nullable();

                $table->string('hotspot_login_url', 2048)->nullable();
                $table->string('hotspot_mac', 32)->nullable();
                $table->string('hotspot_ip', 45)->nullable();
                $table->text('hotspot_dst')->nullable();
                $table->timestamp('hotspot_captured_at')->nullable();

                $table->timestamps();
            });
        }

        if (! Schema::hasTable('free_trials')) {
            Schema::create('free_trials', function (Blueprint $table) {
                $table->id();

                $table->string('mac_address', 32)->unique();
                $table->string('hotspot_ip', 45)->nullable();

                $table->string('username')->unique();
                $table->string('password');

                $table->foreignId('router_id')->nullable()->constrained('routers')->nullOnDelete();

                $table->unsignedBigInteger('limit_bytes')->default(52428800);
                $table->string('status')->default('active');

                $table->boolean('mikrotik_created')->default(false);
                $table->timestamp('mikrotik_created_at')->nullable();
                $table->text('mikrotik_error')->nullable();
                $table->timestamp('last_seen_at')->nullable();

                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('free_trials');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('routers');

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'is_admin')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_admin');
            });
        }
    }
};
