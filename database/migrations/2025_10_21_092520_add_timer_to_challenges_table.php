<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->integer('time_limit')->default(300); // الوقت بالثواني (5 دقائق افتراضياً)
            $table->integer('bonus_points')->default(0); // نقاط المكافأة للإنجاز السريع
        });
        
        Schema::table('submissions', function (Blueprint $table) {
            $table->integer('time_taken')->nullable(); // الوقت المستغرق بالثواني
            $table->boolean('completed_in_time')->default(false); // هل أنجز في الوقت؟
            $table->integer('bonus_earned')->default(0); // النقاط الإضافية المكتسبة
        });
    }

    public function down()
    {
        Schema::table('challenges', function (Blueprint $table) {
            $table->dropColumn(['time_limit', 'bonus_points']);
        });
        
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn(['time_taken', 'completed_in_time', 'bonus_earned']);
        });
    }
};