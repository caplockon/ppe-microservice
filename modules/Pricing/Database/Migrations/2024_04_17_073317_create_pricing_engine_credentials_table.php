<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Client\Models\Client;
use Modules\Core\Database\DB;
use Modules\Pricing\Models\ClientPricingEngine;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(ClientPricingEngine::tableName(), function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique()->default(DB::fn()->uid());
            $table->unsignedBigInteger('client_id');
            $table->string('engine_driver');
            $table->json('engine_credentials')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')
                ->on(Client::tableName())
                ->references('id')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ClientPricingEngine::tableName());
    }
};
