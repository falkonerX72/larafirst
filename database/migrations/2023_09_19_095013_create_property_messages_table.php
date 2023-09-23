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
        Schema::create('property_messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('agent_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('property_id')->nullable();
            $table->string('msg_name')->nullable();
            $table->string('msg_email')->nullable();
            $table->string('msg_phone')->nullable();
            $table->text('message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_messages');
    }
};
