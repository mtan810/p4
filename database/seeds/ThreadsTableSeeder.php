<?php

use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_of_subjects = 7;
        $number_of_threads_per_subject = 20;
        $generator = new LoremIpsum();

        for ($i = 1; $i <= $number_of_subjects; $i++) {
            for ($j = 1; $j <= $number_of_threads_per_subject; $j++) {
                DB::table('threads')->insert([
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                'name' => implode(' ', $generator->getRandomWords(rand(1,3))),
                'text' => implode(' ', $generator->getSentences(rand(1,3))),
                'user_id' => rand(1,103),
                'subject_id' => $i,
                ]);
            }
        }

    }
}
