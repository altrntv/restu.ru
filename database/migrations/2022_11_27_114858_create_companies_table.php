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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('corporation_id');
            $table->index('corporation_id', 'corporation_company_idx');
            $table->foreign('corporation_id', 'corporation_company_fk')->on('corporations')->references('id');

            $table->string('name')->unique();
            $table->string('slug');

            $table->string('server');
            $table->string('login');
            $table->string('password', 40);

            $table->string('organization_guid', 36)->nullable();

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
        Schema::dropIfExists('companies');
    }
};
