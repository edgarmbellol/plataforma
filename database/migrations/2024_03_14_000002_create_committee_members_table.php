<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('role', ['president', 'secretary', 'member'])->default('member');
            $table->timestamp('joined_at');
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index(['committee_id', 'user_id']);
            $table->index('role');

            // Restricción única para evitar duplicados
            $table->unique(['committee_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('committee_members');
    }
}; 