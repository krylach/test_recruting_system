<?php

use Illuminate\Database\Seeder;
use App\Entities\Candidate;
use Faker\Factory as Faker;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['approved', 'declined'];
        DB::transaction(function () use ($status) {
            $faker = Faker::create();
            for ($i=0; $i < 5; $i++) {
                $candidate = Candidate::create([
                    'name'      => $faker->name,
                    'email'     => $faker->unique()->email,
                    'status'    => $status[rand(0, 1)],
                ]);

                $skills = [];
                for ($j=0; $j < 3; $j++) { 
                    $skills[] = rand(1, 7);
                }
    
                $candidate->skills()->syncWithoutDetaching($skills);
                for ($j=0; $j < 3; $j++) { 
                    $candidate->notes()->create(['comment' => $faker->text(20)]);
                }

                $candidate->searchable();
            }
        });
    }
}
