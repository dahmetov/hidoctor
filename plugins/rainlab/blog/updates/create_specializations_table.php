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

        Schema::table('rainlab_blog_posts', function($table)
        {
            $table->integer('specialization_id')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rainlab_blog_specializations');
        if (Schema::hasColumn('rainlab_blog_posts', 'specialization_id')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('specialization_id');
            });
        }
    }

}
