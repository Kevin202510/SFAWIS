<?php

use App\Enums\SensorConfigurationStatus;
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
        Schema::create('sensor_configurations', function (Blueprint $table) {
            $table->id();
            $table->string("configuration_name");
            $table->string("logo")->nullable();
            $table->string("description");
            $table->json("configuration_value")->comment("Preset Value For Sensors");
            $table->string("status")->default(SensorConfigurationStatus::ACTIVE);
            $table->morphs('created_by');
            $table->morphs('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_configurations');
    }
};
