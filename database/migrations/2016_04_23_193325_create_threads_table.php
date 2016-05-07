<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('threads', function (Blueprint $table) {

            # Increments method will make a Primary, Auto-Incrementing field.
            # Most tables start off this way
            $table->increments('id');

            # This generates two columns: `created_at` and `updated_at` to
            # keep track of changes to a row
            $table->timestamps();

            # The rest of the fields...
            $table->string('name');                                             # thread name
            $table->string('text');                                             # thread text
            $table->integer('user_id')->unsigned();                             # user that created the thread
            $table->foreign('user_id')->references('id')->on('users');          # user_id foreign key
            $table->integer('subject_id')->unsigned();                          # subject that the thread was created in
            $table->foreign('subject_id')->references('id')->on('subjects');    # subject_id foreign key

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('threads', function (Blueprint $table) {
            $table->dropForeign('threads_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('threads_subject_id_foreign');
            $table->dropColumn('subject_id');
        });

        Schema::drop('threads');

    }
}
