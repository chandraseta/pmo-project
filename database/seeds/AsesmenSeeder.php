<?php

use Illuminate\Database\Seeder;

class AsesmenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Kinerja::class, 500)->create();
        factory(App\Kompetensi::class, 500)->create();
    }
}
