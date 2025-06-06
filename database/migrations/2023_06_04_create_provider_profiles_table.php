<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('provider_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->text('bio')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('experience')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('provider_profiles');
    }
};
