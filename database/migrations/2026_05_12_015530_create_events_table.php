<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            
            // Иш-чаранын аталышы (мис: "Олимпиада по программированию")
            $table->string('title');
            
            // Кыскача сүрөттөмөсү
            $table->text('description')->nullable();
            
            // Иш-чаранын өткөрүлүүчү күнү (05 МАЙ ж.б.)
            $table->date('event_date');
            
            // Өткөрүлүүчү убактысы (мис: 10:00)
            $table->time('event_time')->nullable();
            
            // Өткөрүлүүчү орду (мис: "Главный корпус, ауд. 101")
            $table->string('location')->nullable();
            
            // Иш-чаранын мукаба сүрөтү (image)
            $table->string('image_path')->nullable();
            
            // Түрү (Олимпиада, Хакатон, Турнир ж.б.) - фильтрлөө үчүн ыңгайлуу
            $table->string('type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}