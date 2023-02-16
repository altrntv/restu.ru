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
        Schema::create('menuboards', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->unsignedBigInteger('organization_id');
            $table->index('organization_id', 'organization_menuboard_idx');
            $table->foreign('organization_id', 'organization_menuboard_fk')->on('organizations')->references('id');

            $table->json('menu_json');

            $table->timestamp('active_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menuboards');
    }
};
