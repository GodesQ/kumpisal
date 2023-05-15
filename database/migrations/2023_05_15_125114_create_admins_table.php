<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->charset('utf8')->collation('utf8_general_ci')->unique();
            $table->string('email', 100)->charset('utf8')->collation('utf8_general_ci')->unique();
            $table->string('password', 150);
            $table->string('firstname', 100)->nullable();
            $table->string('lastname', 100)->nullable();
            $table->string('name', 100)->nullable();
            $table->boolean('is_verify')->nullable()->default(false);
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
        Schema::dropIfExists('admins');
    }
}
