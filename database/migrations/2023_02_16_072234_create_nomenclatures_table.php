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
        Schema::create('nomenclatures', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('code');
            $table->integer('price');

            $table->unsignedBigInteger('organization_id');
            $table->index('organization_id', 'organization_nomenclature_idx');
            $table->foreign('organization_id', 'organization_nomenclature_fk')->on('organizations')->references('id');

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
        Schema::dropIfExists('nomenclatures');
    }
};
