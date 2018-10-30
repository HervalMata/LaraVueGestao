<?php
/**
 * Created by PhpStorm.
 * User: Herval
 * Date: 29/10/2018
 * Time: 12:05
 */

namespace Tests\Unit\Unit;

use App;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;
use App\Repository\UnitRepository;

class UnitRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function can_store()
    {
        $repository = App::make(UnitRepository::class);
        $store = $repository->store(['name' => 'Uréia']);
        $this->assertInstanceOf(Unit::class, $store);
        $this->assertInstanceOf(Carbon::class, $store->created_at);
    }

    /** @test */
    public function can_update()
    {
        $repository = App::make(UnitRepository::class);
        $unit = factory(Unit::class)->create();
        $update = $repository->update(['name' => 'Uréia 1'], $unit->id);
        $this->assertInstanceOf(Unit::class, $update);
        $this->assertEquals($unit->id, $update->id);
    }

    /** @test */
    public function can_get()
    {
        $repository = App::make(UnitRepository::class);
        $unit = factory(Unit::class)->create();
        $get = $repository->get($unit->id);
        $this->assertInstanceOf(Unit::class, $get);
        $this->assertEquals($get->id, $unit->id);
    }

    /** @test */
    public function can_get_all()
    {
        $repository = App::make(UnitRepository::class);
        factory(Unit::class)->create();
        $all = $repository->all();
        $this->assertInstanceOf(LengthAwarePaginator::class, $all);
        $this->assertInstanceOf(Unit::class, $all->first());
    }

    /** @test */
    public function can_delete()
    {
        $repository = App::make(UnitRepository::class);
        $unit = factory(Unit::class)->create();
        $delete = $repository->delete($unit->id);
        $trashed = $repository->onlyTrashed()->get($unit->id);
        $this->assertEquals(1, $delete);
        $this->assertInstanceOf(Carbon::class, $trashed->deleted_at);
        $this->assertInstanceOf(Unit::class, $trashed);
        $this->expectException(App\Exceptions\RepositoryException::class);
        $repository->withoutTrashed()->get($unit->id);
    }

    /** @test */
    public function can_force_delete()
    {
        $repository = App::make(UnitRepository::class);
        $unit = factory(Unit::class)->create();
        $repository->forceDelete($unit->id);
        $this->expectException(App\Exceptions\RepositoryException::class);
        $trashed = $repository->onlyTrashed()->get($unit->id);
    }

    /** @test */
    public function can_restore()
    {
        $repository = App::make(UnitRepository::class);
        $unit = factory(Unit::class)->create();
        $repository->delete($unit->id);
        $restore = $repository->restore($unit->id);
        $get = $repository->get($unit->id);
        $this->assertEquals(1, $restore);
        $this->assertNull($get->deleted_at);
        $this->assertInstanceOf(Unit::class, $get);
    }
}