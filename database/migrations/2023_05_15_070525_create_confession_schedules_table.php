<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfessionSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confession_schedules', function (Blueprint $table) {
            $table->id();
            $table->uuid('church_uuid');
            $table->date('started_date');
            $table->time('started_time');
            $table->date('end_date');
            $table->time('end_time');
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
        Schema::dropIfExists('confession_schedules');
    }
}
