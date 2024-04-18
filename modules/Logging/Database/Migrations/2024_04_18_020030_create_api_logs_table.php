<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Core\Database\DB;
use Modules\Logging\Models\ApiLog;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(ApiLog::tableName(), function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique()->default(DB::fn()->uid());
            $table->string('name');
            $table->string('method');
            $table->longText('url')->nullable();
            $table->longText('request_header')->nullable();
            $table->longText('request_body')->nullable();
            $table->longText('response_header')->nullable();
            $table->longText('response_body')->nullable();
            $table->longText('status')->nullable();
            $table->longText('trace_log')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ApiLog::tableName());
    }
};
