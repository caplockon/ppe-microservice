<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Client\Models\Client;
use Modules\Core\Database\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Client::tableName(), function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique()->default(DB::fn()->uid());
            $table->string('uname')->unique();
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Client::tableName());
    }
};
