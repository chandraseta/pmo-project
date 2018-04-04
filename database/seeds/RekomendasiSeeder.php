<?php

use Illuminate\Database\Seeder;

class RekomendasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Posisi::class, 50)->create();
        factory(App\RekomendasiPosisi::class, 200)->create();
        factory(App\Training::class, 50)->create();
        factory(App\RekomendasiTraining::class, 200)->create();
    }
}
