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
        Schema::create('global_site_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('registration_enabled')->default(false);
            $table->boolean('show_home_page')->default(true);
            $table->string('key')->default('subscription-tracker')->unique(); // Used to help enforce only one model instance
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
        Schema::dropIfExists('global_site_settings');
    }
};
