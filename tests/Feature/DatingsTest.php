<?php

namespace Tests\Feature;

use App\Enums\Sex;
use App\Models\Dating;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatingsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    /** @test */
    public function 여자는_선호지역_및_선호일정을_수정할_수_있다()
    {
        $this->user->update([
            "sex" => Sex::WOMEN
        ]);

        $dating = Dating::factory()->create([
            "women_id" => $this->user->id
        ]);

        $this->patch("/datings/".$dating->id, [
            "city1" => "123",
            "area1" => "123",
            "city2" => "123",
            "area2" => "123",
        ]);

        $dating = Dating::find($dating->id);

        $this->assertNotNull($dating->city1);
    }

    /** @test */
    public function 주소가_있을_경우_여자는_장소확인여부를_수정할_수_있다 ()
    {
        $this->user->update([
            "sex" => Sex::WOMEN
        ]);

        $dating = Dating::factory()->create([
            "women_id" => $this->user->id,
            "address" => "123",
            "address_detail" => "123123"
        ]);

        $this->patch("/datings/".$dating->id, [
            "city1" => "123",
            "area1" => "123",
            "city2" => "123",
            "area2" => "123",
        ]);

        $dating = Dating::find($dating->id);

        $this->assertNotNull($dating->city1);
    }

    public function 남자는_최종일정과_주소를_수정할_수_있다 ()
    {

    }

    public function 일정은_정해졌으나_장소확인여부없이_일정이_지난_소개팅은_사용횟수_돌려주기()
    {

    }

}
