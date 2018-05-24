<?php

namespace Tests\Feature;

use App\Kinerja;
use App\Kompetensi;
use App\Pegawai;
use App\PMO;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DataKinerjaAPITest extends TestCase
{
    use DatabaseTransactions;

    private $user;
    private $baseUri = 'api/kinerja';

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

    public function testItFetchesDataKinerja() {
        $data = Kinerja::all();
        $response = $this->actingAs($this->user)
            ->get($this->baseUri)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data' => $data->toArray()
            ]);
    }

    public function testItFetchesParticularDataKinerja() {
        $randomData = Kinerja::inRandomOrder()->first();
        $existingId = $randomData->id_kinerja;
        $uri = $this->baseUri.'/'.$existingId;
        $response = $this->actingAs($this->user)
            ->get($uri)
            ->assertStatus(200)
            ->assertJson([
                'data' => $randomData->toArray()
            ]);

        $nonExistingId = Kinerja::all()->max('id_kinerja') + 1;
        $uri = $this->baseUri.'/'.$nonExistingId;
        $response = $this->actingAs($this->user)
            ->get($uri)
            ->assertStatus(404);

    }

    public function testItStoresDataKinerjaToDatabase() {
        $method = 'POST';
        $uri = $this->baseUri;
        $data = factory(Kinerja::class)->make();
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

        $this->assertDatabaseHas('kinerja', $data->toArray());
    }

    public function testItUpdatesDataKinerja() {
        $data = Kinerja::inRandomOrder()->first();
        $newData = factory(Kinerja::class)->make();
        $newData->id_kinerja = $data->id_kinerja;
        $newData->id_pegawai = $data->id_pegawai;

        $method = 'PUT';
        $uri = $this->baseUri.'/'.$newData->id_kinerja;
        $payload = $newData->toArray();
        $response = $this->actingAs($this->user)
            ->json($method, $uri, $payload)
            ->assertStatus(200)
            ->assertJson([
                'data' => $payload
            ]);

        $nonExistId = Kinerja::all()->max('id_kinerja') + 1;
        $newData->id_kinerja = $nonExistId;
        $uri = $this->baseUri.'/'.$newData->id_kinerja;
        $payload = $newData->toArray();
        $response = $this->actingAs($this->user)
            ->json($method, $uri, $payload)
            ->assertStatus(404);
    }
}
