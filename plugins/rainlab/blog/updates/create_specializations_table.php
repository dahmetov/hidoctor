<?php namespace RainLab\Blog\Updates;

use RainLab\Blog\Models\Specialization;
use Schema;
use October\Rain\Database\Updates\Migration;

class CreateCategoriesTable extends Migration
{

    public function up()
    {
        Schema::create('rainlab_blog_specializations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable()->index();
            $table->timestamps();
        });

        Schema::create('rainlab_blog_posts_specializations', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('post_id')->unsigned();
            $table->integer('specialization_id')->unsigned();
            $table->primary(['post_id', 'specialization_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('rainlab_blog_specializations');
        Schema::dropIfExists('rainlab_blog_posts_specializations');
    }

}
