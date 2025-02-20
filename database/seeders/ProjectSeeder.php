<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker =  Faker::create();

        $users = User::all();

        //create project with random users and attributes and log timesheets to it

        foreach (range(1, 10) as $index) {
            $project =  Project::create([
                'name' => $faker->unique()->company,
                'status' => 1,
            ]);

            // Attach users to the project randomly between 1 and 5
            $project->users()->attach($users->random(rand(1, 5)));

            //Add dynamic attributes to the project
            $attribute = Attribute::whereName('department')->first();
            AttributeValue::create([
                'attribute_id' => $attribute->id,
                'entity_id' => $project->id,
                'value' => $faker->randomElement(['Marketing', 'Finance', 'IT', 'Sales', 'HR'])
            ]);

            //log timesheet for the assigned users
            $project->users()->each(function ($user) use ($faker, $project) {
                $user->timesheets()->create([
                    'project_id' => $project->id,
                    'task_name' => $faker->jobTitle,
                    'date' => $faker->date(),
                    'hours' => $faker->randomFloat(2, 1, 8),
                ]);
            });
        }


    }
}
