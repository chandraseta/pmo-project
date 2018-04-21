<?php

namespace Tests\Browser;

use App\Pegawai;
use App\PMO;
use App\User;
use function PHPSTORM_META\type;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserAsPMOTest extends DuskTestCase
{

    public function testPMOLogin()
    {
        $pmo = PMO::inRandomOrder();
        if (is_null($pmo)) {
            factory(User::class)->create();
            $pmo = factory(PMO::class)->create();
        } else {
            $pmo = $pmo->first();
        }
        $user = User::find($pmo->id_user);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/pages');
        });
    }
}
