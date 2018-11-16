<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlerDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawler-data', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('url_id');
            $table->foreign('url_id')->references('id')->on('urls');
            $table->string('marca');
            $table->string('modelo');
            $table->string('ano_fabricacao');
            $table->string('ano_modelo');
            $table->decimal('preco', 14, 2);
            $table->bigInteger('veiculo_id');
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
        Schema::dropIfExists('crawler-data');
    }
}
