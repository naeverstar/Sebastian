<?php

use App\Models\CourtType;
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
        Schema::create('court_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->timestamps();
        });

        // Insert data no Seeder
        CourtType::insert([
            ['name' => 'Reguler'],
            ['name' => 'Matras'],
            ['name' => 'Rumput']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_types');
    }
};
