<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
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

        Schema::create('animals', function (Blueprint $table) use ($totalFloatSize, $decimalPoints) {
            $table->increments('id');
            $table->unsignedInteger('breed_id');
            $table->string('name');
            $table->float('previous_health', $totalFloatSize, $decimalPoints)
                ->default(config('animals.default-health'));
            $table->float('current_health', $totalFloatSize, $decimalPoints)
                ->default(config('animals.default-health'));
            $table->timestamps();

            $table->foreign('breed_id')->references('id')->on('breeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropForeign(['breed_id']);
        });
        Schema::dropIfExists('animals');
    }
}
