<?php

namespace Tests\Feature\Packs;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Pack;

class WebTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_show_pack()
    {
        $pack = factory(Pack::class)->create();

        $response = $this->get(route ('packs.show', ['pack' => $pack]));

        $response->assertStatus(200);
    }
}
