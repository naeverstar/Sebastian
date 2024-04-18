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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('address');
            $table->string('phone');

            $table->foreignId('court_id')->constrained()
                ->cascadeOnDelete();

            $table->date('date');
            $table->time('starttime');
            $table->time('endtime');
            $table->integer('duration');

            $table->integer('costume');
            $table->integer('shoes');
            $table->integer('total');
            // $table->integer('grandtotal');
            $table->integer('paytotal')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
