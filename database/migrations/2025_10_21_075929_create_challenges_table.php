<?php
// database/migrations/2024_01_01_create_challenges_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('instructions');
            $table->text('starter_code');
            $table->text('solution');
            $table->enum('difficulty', ['easy', 'medium', 'hard']);
            $table->integer('points');
            $table->json('test_cases');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenges');
    }
};