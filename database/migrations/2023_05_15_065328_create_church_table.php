<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChurchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('churches', function (Blueprint $table) {
            $table->id();
            $table->uuid('church_uuid');
            $table->string('name', 150);
            $table->longText('description');
            $table->string('church_image', 150);
            $table->string('address', 250)->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->string('parish_priest', 250)->nullable();
            $table->date('feast_date')->nullable();
            $table->string('criteria', 100)->nullable();
            $table->string('contact_number', 255);
            $table->string('facebook_link', 255);
            $table->boolean('is_active')->nullable()->default(false);
            $table->boolean('is_delete')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('church');
    }
}
