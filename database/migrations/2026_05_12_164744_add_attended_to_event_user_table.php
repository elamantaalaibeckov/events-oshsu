<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttendedToEventUserTable extends Migration
{
    /**
     * Миграцияны иштетүү (Колонка кошуу)
     */
    public function up()
    {
        if (Schema::hasTable('event_user')) {
            Schema::table('event_user', function (Blueprint $table) {
                // Эгер attended колонкасы жок болсо гана кошобуз
                if (!Schema::hasColumn('event_user', 'attended')) {
                    $table->boolean('attended')->default(false)->after('event_id');
                }
            });
        }
    }

    /**
     * Миграцияны артка кайтаруу (Колонканы өчүрүү)
     */
    public function down()
    {
        if (Schema::hasColumn('event_user', 'attended')) {
            Schema::table('event_user', function (Blueprint $table) {
                $table->dropColumn('attended');
            });
        }
    }
}