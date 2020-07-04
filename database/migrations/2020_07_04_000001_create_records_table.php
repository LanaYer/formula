<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date'); //Дата записи
            $table->time('time_start'); //Время начала работ
            $table->time('time_end'); //Время окончания работ
            $table->integer('box_id'); //Номер бокса, в который записана машина
            $table->string('car_num'); //Гос. Номер автомобиля
            $table->integer('car_id'); //ID автомобиля (для теста везде ставим 1)
            $table->integer('card_id'); //ID карты клиента (для теста везде ставим 1)
            $table->text('description'); //описание работ
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('removed_at')->nullable();

            $table->foreign('box_id', 'records_fk_box_id')
                ->references('id')->on('boxes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
