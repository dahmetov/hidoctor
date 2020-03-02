<?php namespace RainLab\Blog\Updates;

use RainLab\Blog\Models\Specialization;
use Schema;
use October\Rain\Database\Updates\Migration;

class CreateRegistrationsTable extends Migration
{

    public function up()
    {
        Schema::create('rainlab_blog_registrations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamp('date')->nullable();
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->integer('post_id')->unsigned();
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rainlab_blog_registrations');
    }

}
