<?php

namespace Tests\Feature;

use App\Exceptions\Handler;
use App\Kinerja;
use App\Kompetensi;
use App\Pegawai;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataKompetensiAPITest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $baseUri = 'api/kompetensi';

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

       $payload = $data;
       $response = $this->actingAs($this->user)
           ->json($method, $uri, $payload->toArray())
           ->assertStatus(404);

       $randomUser = Pegawai::inRandomOrder()->first();
       $data->nip = $randomUser->nip;

       $payload = $data->toArray();
       unset($data->nip);
       $response = $this->actingAs($this->user)
           ->json($method, $uri, $payload)
           ->assertStatus(200)
           ->assertJson([
               'data' => $data->toArray()
           ]);

       $this->assertDatabaseHas('kompetensi', $data->toArray());
   }
}
