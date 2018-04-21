<?php

namespace Tests\Browser;

use App\PMO;
use App\User;
use function PHPSTORM_META\type;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    private $user;

    public function testLogin()
    {
        $pmo = PMO::inRandomOrder();
        if (is_null($pmo)) {
            factory(User::class)->create();
            $pmo = factory(PMO::class)->create();
        } else {
            $pmo = $pmo->first();
        }
        $this->user = User::find($pmo->id_user);
        $account = $this->user;

        $this->browse(function (Browser $browser) use ($account) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', $this->user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/pages');
        });
    }
}
