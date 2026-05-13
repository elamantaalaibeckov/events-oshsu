<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            // Студент менен байланыштыруу (users таблицасы менен)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Жетишкендиктин маалыматтары
            $table->string('title');              // Мисалы: "Конкурс научных работ"
            $table->string('place')->nullable();  // Мисалы: "1-орун", "3-орун"
            $table->date('event_date');           // Болгон күнү
            $table->text('description')->nullable(); // Сүрөттөмөсү
            
            // Файлдар (Дипломдун же сертификаттын сүрөтү сакталган жол)
            $table->string('file_path'); 
            
            // Админ текшерүүсү үчүн статустар
            // Стандарттык статус: 'pending' (күтүүдө)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            // Эгерде админ четке какса, себебин жазуу үчүн
            $table->text('admin_comment')->nullable();
            
            $table->timestamps(); // жаралган жана өзгөртүлгөн убактысы
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements');
    }
}