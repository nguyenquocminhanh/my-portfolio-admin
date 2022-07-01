<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\BlogPage;
use App\Models\ContactPage;
use App\Models\TestimonialPage;
use App\Models\AboutPage;
use App\Models\ProjectPage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        BlogPage::create([
            'description' => null,
            'cover_image' => null,
        ]);
        
        ContactPage::create([
            'description' => null,
            'cover_image' => null,
        ]);

        TestimonialPage::create([
            'description' => null,
            'cover_image' => null,
        ]);

        AboutPage::create([
            'description' => null,
            'cover_image' => null,
        ]);
        
        ProjectPage::create([
            'description' => null,
            'cover_image' => null,
        ]);
        
    }
}
