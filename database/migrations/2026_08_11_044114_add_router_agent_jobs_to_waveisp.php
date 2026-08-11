<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('routers')) {
            Schema::table('routers', function (Blueprint $table) {
                if (! Schema::hasColumn('routers', 'sync_mode')) {
                    $table->string('sync_mode')->default('agent');
                }

                if (! Schema::hasColumn('routers', 'agent_token')) {
                    $table->string('agent_token', 80)->nullable()->unique();
                }

                if (! Schema::hasColumn('routers', 'last_seen_at')) {
                    $table->timestamp('last_seen_at')->nullable();
                }
            });
        }

        if (! Schema::hasTable('router_jobs')) {
            Schema::create('router_jobs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('router_id')->constrained('routers')->cascadeOnDelete();
                $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();

                $table->string('job_type');
                $table->string('status')->default('pending');

                $table->json('payload')->nullable();
                $table->text('result')->nullable();

                $table->unsignedInteger('attempts')->default(0);
                $table->timestamp('available_at')->nullable();
                $table->timestamp('locked_at')->nullable();
                $table->timestamp('completed_at')->nullable();

                $table->timestamps();

                $table->index(['router_id', 'status']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('router_jobs');

        if (Schema::hasTable('routers')) {
            Schema::table('routers', function (Blueprint $table) {
                if (Schema::hasColumn('routers', 'sync_mode')) {
                    $table->dropColumn('sync_mode');
                }

                if (Schema::hasColumn('routers', 'agent_token')) {
                    $table->dropColumn('agent_token');
                }

                if (Schema::hasColumn('routers', 'last_seen_at')) {
                    $table->dropColumn('last_seen_at');
                }
            });
        }
    }
};