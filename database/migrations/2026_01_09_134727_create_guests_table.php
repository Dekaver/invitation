<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('phone')->nullable();

            $table->enum('rsvp_status', ['yes', 'no', 'maybe'])
                  ->nullable();

            $table->unsignedTinyInteger('total_guest')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
