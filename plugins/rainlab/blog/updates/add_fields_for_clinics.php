<?php namespace RainLab\Blog\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use DbDongle;

class AddFieldsForClinics extends Migration
{
    public function up()
    {

        // Логотип клиники
        // Название клиники
        // Адрес клиники
        // Карта клиники
        // Список специалистов
        // Видео карта (показывает месторасположение)
        // Фотоматериалы (фотографии клиник снаружи и внутри)
        // Отзывы о клинике
        // Верифицирован Hi doctor или VIP (Hi Doctor будет заключать договор с клиниками, и те кто прошли проверку через Hi doctor, будут иметь отличительный знак как Верифицирован Hi doctor или VIP

        if (Schema::hasColumn('rainlab_blog_posts', 'address')) {
            return;
        }
        if (Schema::hasColumn('rainlab_blog_posts', 'is_verified')) {
            return;
        }

        Schema::table('rainlab_blog_posts', function($table)
        {
            $table->mediumText('address')->nullable();
            $table->boolean('is_verified')->nullable();
        });
    }

    public function down()
    {
        if (Schema::hasColumn('rainlab_blog_posts', 'address')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('address');
            });
        }
        if (Schema::hasColumn('rainlab_blog_posts', 'is_verified')) {
            Schema::table('rainlab_blog_posts', function ($table) {
                $table->dropColumn('is_verified');
            });
        }
    }
}
