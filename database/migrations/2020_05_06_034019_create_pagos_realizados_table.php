<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosRealizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_realizados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prestamo_id');
            $table->unsignedBigInteger('client_id');
            $table->integer('number');  
            $table->decimal('amount'); 
            $table->date('payment_date');  
            $table->date('receipt_date')->nullable(); 
            $table->decimal('received_amount')->nullable();
            $table->boolean('paid')->default(0);
            $table->timestamps();
            
            $table->foreign('client_id')
            ->references('id')
            ->on('clients');            

            $table->foreign('prestamo_id')
            ->references('id')
            ->on('prestamos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos_realizados');
    }
}
