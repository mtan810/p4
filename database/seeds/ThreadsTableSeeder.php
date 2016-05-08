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

        for ($i = 1; $i <= $number_of_subjects; $i++) {
            for ($j = 1; $j <= $number_of_threads_per_subject; $j++) {
                $user_id = rand(1, 3);
                DB::table('threads')->insert([
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                'text' => 'text'.$j,
                'name' => 'name'.$j,
                'user_id' => $user_id,
                'subject_id' => $i,
                ]);
            }
        }

    }
}
