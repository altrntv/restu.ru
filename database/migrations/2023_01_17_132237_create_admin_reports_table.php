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
        Schema::create('admin_reports', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');
            $table->string('slug');
            $table->string("icon")->default("bar-chart-2");
            $table->string("type_date")->default("day");

            $table->unsignedBigInteger('organization_id');
            $table->index('organization_id', 'organization_admin_report_idx');
            $table->foreign('organization_id', 'organization_admin_report_fk')->on('organizations')->references('id');

            $table->json('report_json');
            $table->json('request_json');

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
        Schema::dropIfExists('admin_reports');
    }
};
