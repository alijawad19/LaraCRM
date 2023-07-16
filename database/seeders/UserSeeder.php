<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$CsH.iYj9aTMafAmCfKUpbeoICu.6hmj6R/uvph7pzCsMKcNVEbqFu', // password = admin123
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$rjqzaMWARCxG6WfRwT9ile83KG.BBEYm.R.ZMwo.O/mjuymxRKMMC', // password = user1234
            'remember_token' => Str::random(10),
        ]);

        $user->assignRole('user');

        User::factory()->count(50)->create();
    }
}
