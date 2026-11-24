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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->noActionOnUpdate()->cascadeOnDelete();
            $table->foreignId('room_id')->constrained()->noActionOnUpdate()->cascadeOnDelete();;
            $table->dateTime('date'); 
            $table->string('app_name');
            $table->enum('payment', ['очно', 'СБП']);
            $table->enum('status', ['Новая', 'Мероприятие назначено', 'Завершено'])->default('Новая');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
