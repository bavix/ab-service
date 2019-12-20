<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenarios', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('ratified_id')->nullable();
            $table->unsignedBigInteger('approved_id')->nullable();
            $table->boolean('enabled')->default(true);
            $table->timestamps();

            $table->unique(['name', 'project_id']);
            $table->foreign(['project_id'])
                ->references('id')
                ->on('projects');
        });

        Schema::create('group_scenario', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('scenario_id');
            $table->timestamps();

            $table->foreign(['group_id'])
                ->references('id')
                ->on('groups');

            $table->foreign(['scenario_id'])
                ->references('id')
                ->on('scenarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_scenario');
        Schema::dropIfExists('scenarios');
    }
}
