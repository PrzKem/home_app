<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('periodical_events', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('type');
            $table->integer('day');
            $table->integer('month');
            $table->timestamps();
        });
        Schema::create('householding_events', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->integer('day_of_generation')->nullable();
            $table->integer('span_of_weeks');
            $table->timestamp('generation_date');
            $table->text('extra_marks');
            $table->timestamps();
        });
        Schema::create('events_proposals', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->boolean('accepted');
            $table->timestamp('time_start');
            $table->timestamp('time_stop');
            $table->float('estimated_cost_per_person');
            $table->text('budget_source');
            $table->timestamps();
        });
        Schema::create('events_planners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_ID');
            $table->text('title');
            $table->timestamp('date_time');
            $table->float('cost_per_person');
            $table->text('location');
            $table->text('extra_marks');
            $table->timestamps();

            $table->foreign('event_ID')->references('id')->on('events_proposals')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        Schema::create('events_acceptances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proposal_ID');
            $table->text('person');
            $table->boolean('accepted')->nullable();
            $table->boolean('is_participant');
            $table->timestamps();

            $table->foreign('proposal_ID')->references('id')->on('events_proposals')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
        Schema::create('household_checklists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_ID');
            $table->text('value');
            $table->text('person_responsible');
            $table->timestamps();

            $table->foreign('event_ID')->references('id')->on('householding_events')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('household_checklists');
      Schema::dropIfExists('events_acceptances');
      Schema::dropIfExists('periodical_events');
      Schema::dropIfExists('householding_events');
      Schema::dropIfExists('events_planners');
      Schema::dropIfExists('events_proposals');
    }
};
