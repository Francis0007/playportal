<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('app_name');
            $table->string('app_cat');
            $table->string('app_os');
            $table->text('app_desc');
            $table->string('app_owner');
            $table->string('owner_email');
            $table->string('owner_number');
            $table->string('icon_picture')->nullable();
            $table->string('feature_picture')->nullable();
            $table->json('gameplay_screenshots')->nullable();
            $table->string('compressed_file')->nullable();
            $table->string('status')->default(0);
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
        Schema::dropIfExists('apps');
    }
}
