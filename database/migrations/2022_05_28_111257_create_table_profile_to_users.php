<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_profile_to_users', function (Blueprint $table) {
            $table->id();
            $table->string('education');
            $table->string('location');
            $table->string('companyName');
            $table->string('experience');
            $table->string('skills');
            $table->string('profileImage');

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
        Schema::dropIfExists('table_profile_to_users');
    }
};
