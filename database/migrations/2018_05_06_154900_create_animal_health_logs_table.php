<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalHealthLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $decimalPoints = config('animals.current-health-decimal-points');
        $totalFloatSize = strlen(config('animals.default-health')) + $decimalPoints;

        Schema::create('animal_health_logs', function (Blueprint $table) use ($decimalPoints, $totalFloatSize) {
            $table->increments('id');
            $table->unsignedInteger('animal_id');
            $table->float('previous_health', $totalFloatSize, $decimalPoints);
            $table->float('random_percentage', $totalFloatSize, $decimalPoints);
            $table->float('health_change_percentage', $totalFloatSize, $decimalPoints);
            $table->float('updated_health', $totalFloatSize, $decimalPoints);
            $table->dateTime('zoo_time');
            $table->timestamps();

            $table->foreign('animal_id')->references('id')->on('animals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animal_health_logs', function (Blueprint $table) {
           $table->dropForeign(['animal_id']);
        });

        Schema::dropIfExists('animal_health_logs');
    }
}
