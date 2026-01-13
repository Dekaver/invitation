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
            $table->string('guest_name')->nullable();
            
            $table->string('rsvp_status')->default('Tidak Hadir');
            $table->text('message');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
