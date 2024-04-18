<?php

use App\Models\Court;
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
        Schema::create('courts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('court_type_id')->constrained()
                ->cascadeOnDelete();

            $table->string('name');
            $table->integer('price');

            $table->timestamps();
        });

        // Insert data to Database
        Court::insert([
            ['court_type_id' => 1, 'name' => 'Indoor', 'price' => 300000],
            ['court_type_id' => 2, 'name' => 'Indoor', 'price' => 250000],
            ['court_type_id' => 3, 'name' => 'Indoor', 'price' => 200000],
            ['court_type_id' => 1, 'name' => 'Outdoor', 'price' => 250000],
            ['court_type_id' => 2, 'name' => 'Outdoor', 'price' => 200000],
            ['court_type_id' => 3, 'name' => 'Outdoor', 'price' => 150000],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courts');
    }
};
