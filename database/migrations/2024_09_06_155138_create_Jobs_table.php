<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // In your migration file for jobs
Schema::create('jobs', function (Blueprint $table) {
    $table->id('job_id'); // Custom primary key
    $table->string('job_title');
    $table->boolean('job_active')->default(1);
    $table->timestamps(); // Adds created_at and updated_at fields
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
