<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Social;
use App\Models\Theme;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'image' => '',
        ]);

        Theme::insert([
            'site_title' => 'Our News Portal'
        ]);

        Social::insert([
            'facebook' => ''
        ]);
    }
}
