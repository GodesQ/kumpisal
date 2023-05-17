<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_uuid');
            $table->string('name', 150);
            $table->string('user_image', 150)->nullable();
            $table->string('email', 255)->charset('utf8')->collation('utf8_general_ci')->unique();
            $table->string('password', 255);
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('middlename', 100)->nullable();
            $table->string('address', 250)->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->string('role')->nullable()->user('user');
            $table->boolean('is_verify')->nullable()->default(false);
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
