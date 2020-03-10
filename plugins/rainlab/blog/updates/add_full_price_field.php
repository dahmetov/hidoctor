<?php namespace RainLab\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\Blog\Models\Category as CategoryModel;

class AddFullPriceField extends Migration
{

    public function up()
    {
        if (Schema::hasColumn('rainlab_blog_posts', 'full_price')) {
            return;
        }
        Schema::table('rainlab_blog_posts', function($table)
        {
            $table->text('full_price')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('rainlab_blog_posts', 'full_price')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('full_price');
            });
        }
    }

}
