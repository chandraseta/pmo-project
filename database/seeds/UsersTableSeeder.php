<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1600)->create();
        factory(App\Admin::class, 10)->create();
        factory(App\PMO::class, 10)->create();
        factory(App\Pegawai::class, 1580)->create();
    }
}
