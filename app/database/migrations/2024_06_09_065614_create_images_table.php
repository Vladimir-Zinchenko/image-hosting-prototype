<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->dateTime('uploaded_at');
            $table->string('source_filename');
            $table->string('filename');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
