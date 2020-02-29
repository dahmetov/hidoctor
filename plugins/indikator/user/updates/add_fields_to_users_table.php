<?php namespace Indikator\User\Updates;

use October\Rain\Database\Updates\Migration;
use Schema;

class AddFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->string('address', 100)->nullable();
            $table->string('age', 100)->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function($table)
        {
            $table->dropColumn(['address', 'age']);
        });
    }
}
