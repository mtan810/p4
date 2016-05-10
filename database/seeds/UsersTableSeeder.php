<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    $user = \App\User::firstOrCreate(['email' => 'qazqazq159@gmail.com']);
	    $user->name = 'Mason';
	    $user->email = 'qazqazq159@gmail.com';
	    $user->password = \Hash::make('helloworld');
	    $user->theme = 1;
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'jamal@harvard.edu']);
	    $user->name = 'Jamal';
	    $user->email = 'jamal@harvard.edu';
	    $user->password = \Hash::make('helloworld');
	    $user->theme = 2;
	    $user->save();

	    $user = \App\User::firstOrCreate(['email' => 'jill@harvard.edu']);
	    $user->name = 'Jill';
	    $user->email = 'jill@harvard.edu';
	    $user->password = \Hash::make('helloworld');
	    $user->theme = 3;
	    $user->save();

        $faker = Faker\Factory::create();
        $number_of_users = 100;
        for ($i = 4; $i <= $number_of_users+3; $i++) {
            $user = \App\User::firstOrCreate(['email' => 'email'.$i.'@harvard.edu']);
            $user->name = $faker->name;
            $user->email = 'email'.$i.'@harvard.edu';
            $user->password = \Hash::make('helloworld');
            $user->theme = rand(1,3);
            $user->save();
        }

    }
}
