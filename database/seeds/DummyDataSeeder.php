<?php

use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RekomendasiSeeder::class);
        $this->call(RiwayatSeeder::class);
        $this->call(AsesmenSeeder::class);
        $this->call(SertifikatSeeder::class);
    }
}
