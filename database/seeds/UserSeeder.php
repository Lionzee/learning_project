<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $user = User::create([
            'username' => 'adminsmarter',
            'email' => 'admin@smarter.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 1
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'Admin Smarter',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => 'Smarter Administrator'
        ]);

        $user = User::create([
            'username' => 'userone',
            'email' => 'userone@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 2
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'User Number One',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => $faker->jobTitle
        ]);

        $user = User::create([
            'username' => 'usertwo',
            'email' => 'usertwo@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 2
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'User Number Two',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => $faker->jobTitle
        ]);

        $user = User::create([
            'username' => 'userthree',
            'email' => 'userthree@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 2
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'User Number Three',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => $faker->jobTitle
        ]);

        $user = User::create([
            'username' => 'usefour',
            'email' => 'userfour@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 2
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'User Number Four',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => $faker->jobTitle
        ]);

        $user = User::create([
            'username' => 'userfive',
            'email' => 'usefive@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 2
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'User Number Five',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => $faker->jobTitle
        ]);

        $user = User::create([
            'username' => 'usersix',
            'email' => 'usersix@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 2
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'User Number Six',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => $faker->jobTitle
        ]);

        $user = User::create([
            'username' => 'userseven',
            'email' => 'userseven@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 2
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'User Number Seven',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => $faker->jobTitle
        ]);

        $user = User::create([
            'username' => 'usereight',
            'email' => 'usereight@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'role_id' => 2
        ]);

        DB::table('user_profiles')->insert([
            'user_id' => $user->id,
            'display_name' => 'User Number Eight',
            'bio' => 'Work Hard, Play Hard',
            'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
            'website' => $faker->domainName,
            'phone_number' => $faker->phoneNumber,
            'city' => $faker->city,
            'occupation' => $faker->jobTitle
        ]);
    }
}
