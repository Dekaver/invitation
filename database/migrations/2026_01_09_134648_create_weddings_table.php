<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('weddings', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            $table->string('groom_name');
            $table->string('groom_father')->nullable();
            $table->string('groom_mother')->nullable();

            $table->string('bride_name');
            $table->string('bride_father')->nullable();
            $table->string('bride_mother')->nullable();

            $table->date('akad_date')->nullable();
            $table->time('akad_start')->nullable();
            $table->time('akad_end')->nullable();
            $table->string('akad_location')->nullable();

            $table->date('reception_date')->nullable();
            $table->time('reception_start')->nullable();
            $table->time('reception_end')->nullable();  
            $table->string('reception_location')->nullable();

            $table->string('theme')->default('default');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weddings');
    }
};

