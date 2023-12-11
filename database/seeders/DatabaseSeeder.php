<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user=User::factory()->create([
            'name'=>'hamza',
            'email'=>'hmza@test.com'
        ]);
        //\App\Models\User::factory(4)->create();
        Listing::factory(8)->create([
            'user_id'=>$user->id
        ]);
       /* Listing::create(
            [
            'title' => 'Sample Title 2',
            'tags' => 'Tag4 Tag5 Tag6',
            'company' => 'Sample Company 2',
            'location' => 'Sample Location 2',
            'email' => 'sample2@example.com',
            'website' => 'http://www.sample2.com',
            'description' => 'This is a sample description for the second record.'
            ]
            );
            Listing::create(
                [
                    'title' => 'full stack ',
                    'tags' => 'laravel , backend',
                    'company' => 'Sample Compa',
                    'location' => 'Sample Location',
                    'email' => 'sample2@example.com',
                    'website' => 'http://www.sample2.com',
                    'description' => 'This is a sample descriptiofghzdfhvvvv fgedfgdf fgfdhdf fgfed.'
                ]
                );*/

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
