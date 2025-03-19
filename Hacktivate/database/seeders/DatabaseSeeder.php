<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\Administration;
use App\Models\Club;
use App\Models\Event;
use App\Models\EventApproval;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create an admin user manually
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'adm@admin.com',
            'password' => Hash::make('admin12345'), // Secure password
            'role' => 'admin', // Ensure your users table has a "role" column
        ]);

        // Create a club manager user manually  

        $users = User::all(); // Retrieve all users for relationships

        // Create universities
        for ($i = 0; $i < 5; $i++) {
            $university = University::create([
                'name' => $faker->company,
                'contact_email' => $faker->email,
            ]);

            // Create administrations
            for ($j = 0; $j < 3; $j++) {
                Administration::create([
                    'university_id' => $university->id,
                    'name' => $faker->name,
                    'email' => $faker->email,
                    'phone' => $faker->phoneNumber,
                ]);
            }

            // Create clubs
            for ($k = 0; $k < 4; $k++) {
                $club = Club::create([
                    'name' => $faker->word,
                    'description' => $faker->sentence,
                    'logo' => $faker->imageUrl(),
                    'created_by' => $users->random()->id,
                    'university_id' => $university->id,
                ]);

                // Create events
                for ($l = 0; $l < 2; $l++) {
                    $event = Event::create([
                        'club_id' => $club->id,
                        'title' => $faker->sentence,
                        'description' => $faker->paragraph,
                        'event_date' => $faker->dateTimeBetween('now', '+1 year'),
                        'location' => $faker->address,
                        'status' => $faker->randomElement(['pending', 'approved', 'rejected']),
                    ]);

                    // Create event approvals
                    for ($m = 0; $m < 3; $m++) {
                        EventApproval::create([
                            'event_id' => $event->id,
                            'approved_by' => $users->random()->id,
                            'status' => $faker->randomElement(['approved', 'rejected']),
                            'remarks' => $faker->sentence,
                            'approved_at' => $faker->dateTime,
                        ]);
                    }
                }
            }
        }
    }
}
