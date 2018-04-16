<?php

use App\Training;
use Illuminate\Database\Seeder;

class TrainingSeeder extends Seeder
{
    private $training = [
        'Achievement Motivation Training',
        'Achievement Orientation',
        'Building Commitment',
        'Change Management',
        'Continuous Learning and Improvement',
        'Customer Services Orientation',
        'Decision Making',
        'Effective Leadership',
        'Emphatic Communication',
        'Extraordinary Productivity',
        'Group Dynamic',
        'Group Leadership',
        'Management by Objective',
        'Performance Mangement',
        'Policy Deployment',
        'Problem Solving',
        'Quality Management',
        'Relationship Management',
        'Risk Management',
        'Services Excellence',
        'Strategic Management',
        'Stress Management',
        'Team Building',
        'Time Management',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->training as $training) {
            Training::firstOrCreate(['nama_training' => $training]);
        }

        factory(App\RekomendasiTraining::class, 200)->create();
    }
}
