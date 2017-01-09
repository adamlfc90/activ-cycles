<?php namespace Rejuvenate\Events\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('rejuvenate_events', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->boolean('live');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rejuvenate_events');
    }
}
