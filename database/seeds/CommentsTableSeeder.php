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
        $number_of_threads = 20;
        $number_of_comments = 40;
        for ($i = 1; $i <= $number_of_threads; $i++) {
            for ($j = 1; $j <= $number_of_comments; $j++) {
                $user_id = rand(1, 3);
                DB::table('comments')->insert([
                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                'text' => 'text'.$j,
                'user_id' => $user_id,
                'thread_id' => $i,
                ]);
            }
        }
    }
}
