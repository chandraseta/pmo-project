<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataKompetensiAPITest extends TestCase
{

    private $user;

    protected function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItFetchesDataKompetensi()
    {
        $response = $this->actingAs($this->user)
            ->get('/api/kompetensi')
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);

    }

   public function testTest()
   {
       self::assertTrue(true);
   }
}
