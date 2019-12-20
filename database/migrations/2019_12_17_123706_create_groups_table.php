<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('project_id');
            $table->timestamps();

            $table->foreign(['project_id'])
                ->references('id')
                ->on('projects');
        });

        Schema::create('group_segment', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('segment_id');
            $table->timestamps();

            $table->foreign(['group_id'])
                ->references('id')
                ->on('groups');

            $table->foreign(['segment_id'])
                ->references('id')
                ->on('segments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_segment');
        Schema::dropIfExists('groups');
    }
}
