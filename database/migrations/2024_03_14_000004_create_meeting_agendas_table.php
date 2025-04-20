<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('meeting_agendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meeting_id')->constrained('committee_meetings')->onDelete('cascade');
            $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index('meeting_id');
            $table->index(['meeting_id', 'order']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('meeting_agendas');
    }
}; 