<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('scenario_id');
            $table->string('name');
            $table->timestamps();

            $table->unique(['scenario_id', 'name']);
        });

        Schema::table('scenarios', static function (Blueprint $table) {
            $table->foreign(['option_id'])
                ->references('id')
                ->on('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scenarios', static function (Blueprint $table) {
            $table->dropForeign(['option_id']);
        });

        Schema::dropIfExists('options');
    }
}
