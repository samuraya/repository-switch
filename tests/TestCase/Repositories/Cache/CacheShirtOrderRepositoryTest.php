<?php

use App\Repositories\Cache\CacheShirtOrderRepository;
use App\Models\ShirtOrder;
use PHPUnit\Framework\TestCase;

//This Test requires "apc.enable_cli" to be enabled in php.ini file
// must be "apc.enable_cli=1"

/*
class CacheShirtOrderRepositoryTest extends TestCase
{

	public function tearDown():void
    {
        Mockery::close();
    }

	public function testAll()
	{
		
		$order = Mockery::mock(ShirtOrder::class);
		$order->shouldReceive('all')->andReturn([array('id'=>'3')]);
		$repository = new CacheShirtOrderRepository($order);
		$result = $repository->all();

		$this->assertEquals(1, count($result));

	}

	public function testFind()
	{
		$id = 3;
		$order = Mockery::mock(ShirtOrder::class);
		$order->shouldReceive('findOrFail')->andReturn(array('id'=>3));

		$repository = new CacheShirtOrderRepository($order);
		$result = $repository->find($id);

		$this->assertEquals(3, $result['id']);
	}


	public function testStore()
	{
		$order = Mockery::mock(ShirtOrder::class);
		
		$repository = new CacheShirtOrderRepository($order);
		$result = $repository->store(array('id'=>3));

		$this->assertEquals(array('id'=>3), $result);
	}

	public function testUpdate()
	{
		$id='three';
		$order = Mockery::mock(ShirtOrder::class);
		//$order->shouldReceive('findOrFail')->andReturn(new ShirtOrder);

		$repository = new CacheShirtOrderRepository($order);
		$result = $repository->update($id,'is_three');

		$this->assertEquals(apcu_fetch('shirt_order.three'), 'is_three');
		apcu_delete('shirt_order.three');
	}

	public function testDestroy()
	{
		$id='non-existent-key';
		$order = Mockery::mock(ShirtOrder::class);
		//$order->shouldReceive('findOrFail')->andReturn(new ShirtOrder);

		$repository = new CacheShirtOrderRepository($order);
		$result = $repository->destroy($id);

		$this->assertEquals(false, $result);
	}


}

*/