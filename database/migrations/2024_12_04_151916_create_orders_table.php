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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

        
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('users')
                ->onDelete('no action');
            
            $table->unsignedBigInteger('worker_id');
            $table->foreign('worker_id')
                ->references('id')
                ->on('users')
                ->onDelete('no action');


            $table->unsignedBigInteger('order_state_id');
            $table->foreign('order_state_id')
                ->references('id')
                ->on('order_states')
                ->onDelete('no action');

            
            
            $table->timestamp('date_of_completion', precision: 0);
            $table->timestamp('deadline_of_completion', precision: 0);
 

            $table->string('price', 7);
            $table->string('description', 25);
          
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
