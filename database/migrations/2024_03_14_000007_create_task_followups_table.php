<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('task_followups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('meeting_tasks')->onDelete('cascade');
            $table->text('observation');
            $table->timestamp('followup_date');
            $table->json('attachments')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            // Índices
            $table->index('task_id');
            $table->index('followup_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_followups');
    }
}; 