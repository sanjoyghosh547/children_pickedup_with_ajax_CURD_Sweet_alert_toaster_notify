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
        Schema::create('children_details', function (Blueprint $table) {
            $table->id();
            $table->string('child_name');
            $table->timestamps('date_of_birth');
            $table->string('class');
            $table->string('address');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->integer('zip_code');
            $table->string('child_photo')->nullable();
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
        Schema::dropIfExists('children_details');
    }
};
