<?php namespace RainLab\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\Blog\Models\Category as CategoryModel;

class AddIsDoctorField extends Migration
{

    public function up()
    {
        if (Schema::hasColumn('rainlab_blog_posts', 'type')) {
            return;
        }
        Schema::table('rainlab_blog_posts', function($table)
        {
            $table->enum('type', [
                'doctor',
                'clinic',
                'laboratory',
                'pharmacy',
            ])->nullable();
        });


        if (Schema::hasColumn('rainlab_blog_posts', 'parent_id')) {
            return;
        }
        Schema::table('rainlab_blog_posts', function($table)
        {
            $table->integer('parent_id')->nullable()->unsigned();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('rainlab_blog_posts', 'type')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('type');
            });
        }

        if (Schema::hasColumn('rainlab_blog_posts', 'parent_id')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('parent_id');
            });
        }
    }

}
