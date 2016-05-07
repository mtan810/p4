<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('comments', function (Blueprint $table) {

            # Increments method will make a Primary, Auto-Incrementing field.
            # Most tables start off this way
            $table->increments('id');

            # This generates two columns: `created_at` and `updated_at` to
            # keep track of changes to a row
            $table->timestamps();

            # The rest of the fields...
            $table->string('text');                                         # comment text
            $table->integer('user_id')->unsigned();                         # user that created the comment
            $table->foreign('user_id')->references('id')->on('users');      # user_id foreign key
            $table->integer('thread_id')->unsigned();                       # thread that the comment was created in
            $table->foreign('thread_id')->references('id')->on('threads');  # thread_id foreign key

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('comments_thread_id_foreign');
            $table->dropColumn('thread_id');
        });

        Schema::drop('comments');

    }
}
