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
        Schema::table('activities', function (Blueprint $table) {
            $table->unsignedBigInteger('office_id')->nullable();
            $table->foreign('office_id')->references('id')->on('offices_names')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('district_id')->nullable();
            $table->foreign('district_id')->references('id')->on('districts')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('circle_id')->nullable();
            $table->foreign('circle_id')->references('id')->on('circles')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('division_id')->nullable();
            $table->foreign('division_id')->references('id')->on('divisions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('range_id')->nullable();
            $table->foreign('range_id')->references('id')->on('ranges')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->dropForeign('office_id');
            $table->dropForeign('district_id');
            $table->dropForeign('circle_id');
            $table->dropForeign('division_id');
            $table->dropForeign('range_id');
            $table->dropColumn('office_id');
            $table->dropColumn('district_id');
            $table->dropColumn('circle_id');
            $table->dropColumn('division_id');
            $table->dropColumn('range_id');
        });
    }
};
