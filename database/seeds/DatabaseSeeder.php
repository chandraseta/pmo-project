<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PosisiSeeder::class);
        $this->call(TrainingSeeder::class);
        $this->call(RiwayatSeeder::class);
        $this->call(AsesmenSeeder::class);
        $this->call(SertifikatSeeder::class);
    }
}
