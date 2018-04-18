<?php

namespace Tests\Feature;

use App\Kinerja;
use App\Kompetensi;
use App\Pegawai;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataKompetensiAPITest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $baseUri = 'api/kompetensi';

    protected function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
        factory(User::class, 10)->create();
        factory(Pegawai::class, 8)->create();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testItFetchesDataKompetensi()
    {
        $response = $this->actingAs($this->user)
            ->get($this->baseUri)
            ->assertStatus(200)
            ->assertJson([
                'success' => true
            ]);

    }

   public function testItStoresDataKompetensiToDatabase()
   {
       $method = 'POST';
       $uri = $this->baseUri;
       $data = factory(Kompetensi::class)->make();
       unset($data->id_pegawai);

       $response = $this->actingAs($this->user)
           ->json($method, $uri, $data)
           ->assertStatus(404);

       $randomUser = User::inRandomOrder()->first();
       $data->nip = $randomUser->nip;

       $response = $this->actingAs($this->user)
           ->json($method, $uri, $data)
           ->assertStatus(200)
           ->assertJson([
               'data' => $data
           ]);

       $this->assertDatabaseHas('kompetensi', $data);
   }
}
