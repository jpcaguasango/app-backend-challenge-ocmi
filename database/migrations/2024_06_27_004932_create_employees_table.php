<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('document', 20);
            $table->string('name', 100);
            $table->enum('paymentType', ['perHour', 'salary']);
            $table->decimal('paymentAmount', 10, 2);
            $table->foreignId('clientId')->references('id')->on('clients');
            $table->unique(['document', 'clientId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
