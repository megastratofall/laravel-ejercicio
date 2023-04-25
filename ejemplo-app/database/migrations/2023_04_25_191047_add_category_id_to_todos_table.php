<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            //primero hay que crear la columna categoty_id
            $table->bigInteger('category_id')->unsigned();
            $table
                //foreing me permite especificar una llave foranea
                ->foreign('category_id')
                //es la referencia que vamos a utilizar
                ->references('id')
                //luego dice donde existe esa referencia
                ->on('categories')->after('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            //
        });
    }
};
