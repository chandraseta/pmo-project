<?php

use Illuminate\Database\Seeder;

class RiwayatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\RiwayatPekerjaan::class, 200)->create();
        factory(App\RiwayatPendidikan::class, 200)->create();
        factory(App\DataKepegawaian::class, 200)->create();
    }
}
