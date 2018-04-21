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
    private $user;

    protected function setUp()
    {
        parent::setUp();
        $pmo = PMO::inRandomOrder();
        if (is_null($pmo)) {
            factory(User::class)->create();
            $pmo = factory(PMO::class)->create();
        } else {
            $pmo = $pmo->first();
        }
        $this->user = User::find($pmo->id_user);
    }


    public function testPMOLogin()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', $this->user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->assertPathIs('/pages');
        });
    }

    public function testPMOPage() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user)
                    ->visit('/pages/pmo')
                    ->assertSee('UPT PMO')
                    ->assertSeeIn('@pmo-navbar', 'Data Pegawai')
                    ->assertSeeIn('@pmo-navbar', 'Data Kompetensi')
                    ->assertSeeIn('@pmo-navbar', 'Data Kinerja')
                    ->assertVue('currentTab', 'dataPegawai', '@pmo-main-page')
                    ->assertMissing('@tambah-data-button')
                    ->assertMissing('@upload-data-button')
                    ->assertVisible('@download-data-button')
                    ->assertVisible('@data-table')
                    ->assertVue('tableTitle', 'Data Pegawai', '@data-table');
        });
    }
}
