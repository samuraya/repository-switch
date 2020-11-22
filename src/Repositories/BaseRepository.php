<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Repositories\Eloquent\EloquentShirtOrderRepository;
use App\Models\ShirtOrder;


class BaseRepository
{
	private $order;


	public function __construct(ShirtOrder $order)
	{		
		$this->order= $order;
	}

	protected function sourceOfTruthOne($id)
	{
		
		return $this->order->findOrFail($id);
	}

	protected function sourceOfTruthStore($payload)
	{
		return $this->order->create($payload);       
	}

	protected function sourceOfTruthUpdate($id, $payload)
	{
		$order = $this->order->findOrFail($id);
        $order->update($payload);
        return $order;
	}

	protected function sourceOfTruthDelete($id)
	{
		return $this->order->findOrFail($id)->delete();
	}

	protected function hydrate($orders)
	{
		return $this->order->fill($orders);
	}

}