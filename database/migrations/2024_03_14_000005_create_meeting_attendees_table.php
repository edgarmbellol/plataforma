<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('meeting_attendees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->constrained('committee_meetings')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'confirmed', 'declined', 'attended'])->default('pending');
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index(['meeting_id', 'user_id']);
            $table->index('status');

            // Restricción única para evitar duplicados
            $table->unique(['meeting_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('meeting_attendees');
    }
}; 