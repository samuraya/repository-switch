<?php

use App\Repositories\Truth\TruthShirtOrderRepository;
use App\Models\ShirtOrder;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Collection;

class TruthShirtOrderRepositoryTest extends TestCase
{

	public function tearDown():void
    {
        Mockery::close();
    }

	public function testAll()
	{
		$order = Mockery::mock(ShirtOrder::class);
		$order->shouldReceive('all')->andReturn(array());
		$repository = new TruthShirtOrderRepository($order);
		$result = $repository->all();

		$this->assertEquals(true, is_array($result));

	}

	public function testFind()
	{
		$id = 3;
		$order = Mockery::mock(ShirtOrder::class);
		$order->shouldReceive('findOrFail')->andReturn(array('id'=>3));

		$repository = new TruthShirtOrderRepository($order);
		$result = $repository->find($id);

		$this->assertEquals(3, $result['id']);
	}


	public function testStore()
	{
		$order = Mockery::mock(ShirtOrder::class);
		$order->shouldReceive('create')->andReturn(array());

		$repository = new TruthShirtOrderRepository($order);
		$result = $repository->store(array());

		$this->assertEquals(array(), $result);
	}

	public function testUpdate()
	{
		$id=3;
		$order = Mockery::mock(ShirtOrder::class);
		$order->shouldReceive('findOrFail')->andReturn(new ShirtOrder);

		$repository = new TruthShirtOrderRepository($order);
		$result = $repository->update($id,array());

		$this->assertEquals(true, $result instanceof ShirtOrder );
	}

	public function testDestroy()
	{
		$id=3;
		$order = Mockery::mock(ShirtOrder::class);
		$order->shouldReceive('findOrFail')->andReturn(new ShirtOrder);

		$repository = new TruthShirtOrderRepository($order);
		$result = $repository->destroy($id);

		$this->assertEquals(0, $result);
	}


}
