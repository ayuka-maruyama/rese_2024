<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StartUserTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => '店舗代表者1',
            'email' => 'owner1@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '店舗代表者2',
            'email' => 'owner2@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '店舗代表者3',
            'email' => 'owner3@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '店舗代表者4',
            'email' => 'owner4@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '店舗代表者5',
            'email' => 'owner5@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '店舗代表者6',
            'email' => 'owner6@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '店舗代表者7',
            'email' => 'owner7@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => '店舗代表者8',
            'email' => 'owner8@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now(),
            'role' => 3,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        User::factory()->count(3)->create();
        User::factory()->count(2)->unverified()->create();
    }
}
