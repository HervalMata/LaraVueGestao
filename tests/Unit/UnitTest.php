<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 03:15
 */

namespace Tests\Unit;


use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Unit;

class UnitTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function create_unit()
    {
        $unit = factory(Unit::class)->create();

        $this->assertInstanceOf(Unit::class, $unit);
        $this->assertInstanceOf(Carbon::class, $unit->created_at);
        $this->assertInstanceOf(Carbon::class, $unit->updated_at);
        $this->assertNull($unit->deleted_at);

        $this->assertDatabaseHas('units', [
            'name' => $unit->name,
        ]);
    }

    /** @test */
    public function create_unit_with_deleted()
    {
        $unit = factory(Unit::class)->create();
        $this->assertInstanceOf(Unit::class, $unit);
        $unit->delete();
        $this->assertInstanceOf(Carbon::class, $unit->created_at);
        $this->assertInstanceOf(Carbon::class, $unit->updated_at);
        $this->assertInstanceOf(Carbon::class, $unit->deleted_at);
    }

    /** @test */
    public function create_unit_with_value()
    {
        $unit = factory(Unit::class)->create([
            'name' => 'Uréia',
        ]);

        $this->assertInstanceOf(Unit::class, $unit);

        $this->assertDatabaseHas('units', [
            'name' => 'Uréia',
        ]);
    }
}