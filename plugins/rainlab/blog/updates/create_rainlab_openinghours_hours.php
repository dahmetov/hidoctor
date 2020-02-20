<?php namespace OFFLINE\OpeningHours\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class CreateOfflineOpeninghoursHours extends Migration
{
    public function up()
    {
        Schema::create('rainlab_openinghours_hours', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->text('hours');
            $table->integer('weekday')->unsigned();
            $table->string('note')->nullable();
            $table->integer('post_id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rainlab_openinghours_hours');
    }
}
