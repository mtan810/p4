<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # number_of_subjects * number_of_threads_per_subject
        $number_of_threads = 140;
        $number_of_comments_per_thread = 40;
        $generator = new LoremIpsum();

        for ($i = 1; $i <= $number_of_threads; $i++) {
            for ($j = 1; $j <= $number_of_comments_per_thread; $j++) {
                $user_id = rand(1, 3);
                DB::table('comments')->insert([
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                'text' => implode(' ', $generator->getSentences(rand(1,3))),
                'user_id' => $user_id,
                'thread_id' => $i,
                ]);
            }
        }

    }
}
