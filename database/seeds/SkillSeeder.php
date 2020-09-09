<?php

use Illuminate\Database\Seeder;
use App\Entities\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skillsToCreate = ['PHP', 'Laravel', 'JS', 'VueJS', 'C++', 'CSharp', 'CS 1.6'];
        DB::transaction(function () use ($skillsToCreate) {
            foreach ($skillsToCreate as $key => $skill) {
                Skill::create(['name' => $skill]);
            }
        });
    }
}
