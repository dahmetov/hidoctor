<?php namespace RainLab\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\Blog\Models\Category as CategoryModel;

class PostsAddMetadata extends Migration
{

    public function up()
    {
        Schema::table('rainlab_blog_posts', function($table)
        {
            $table->integer('experience')->default(0);
            $table->string('languages')->nullable();
            $table->decimal('price', 9, 3)->default(0);
        });
    }

    public function down()
    {
        if (Schema::hasColumn('rainlab_blog_posts', 'price')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('price');
            });
        }

        if (Schema::hasColumn('rainlab_blog_posts', 'experience')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('experience');
            });
        }

        if (Schema::hasColumn('rainlab_blog_posts', 'languages')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('languages');
            });
        }
    }

}
