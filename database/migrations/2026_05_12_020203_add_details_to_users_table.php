<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Колдонуучунун ролу (админ же студент экенин аныктоо үчүн)
            $table->string('role')->default('student')->after('email');
            
            // Студенттин маалыматтары (сүрөттөгү дизайнга ылайык)
            $table->string('faculty')->nullable()->after('role');    // Мисалы: Экономика
            $table->string('group_name')->nullable()->after('faculty'); // Мисалы: ЭК-21
            $table->integer('course')->nullable()->after('group_name'); // Мисалы: 2
            $table->string('phone')->nullable()->after('course');
            
            // Профиль сүрөтү (аватар)
            $table->string('avatar')->nullable()->after('course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Миграцияны артка кайтарганда бул талааларды өчүрүү
            $table->dropColumn(['role', 'faculty', 'group_name', 'course', 'phone', 'avatar']);
        });
    }
}
