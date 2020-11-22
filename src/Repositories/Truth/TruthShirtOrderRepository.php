<?php
declare(strict_types=1);

namespace App\Repositories\Truth;

use App\Repositories\ShirtOrderRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Models\ShirtOrder;

class TruthShirtOrderRepository  implements ShirtOrderRepositoryInterface
{
    /*
        Its a single source of truth for all data sources
        We define it as local Mysql database
    */
	private $order;

	public function __construct(ShirtOrder $order)
	{
		$this->order = $order;
	}	

	public function all()
	{
		
        echo "<h3 style='color:red'>getting from mysql</h3>";
        return $this->order->all();		
	}
 
    public function find($id)
    {
        echo "<h3 style='color:red'>getting from mysql</h3>";
        return $this->order->findOrFail($id);
    }
 
    public function store($payload)
    {       
        
        echo "<h3 style='color:red'>writing to mysql</h3>";
        return $this->order->create($payload);          
    }
 
    public function update($id, $payload)
    {
        echo "<h3 style='color:red'>updating mysql</h3>";
        $order = $this->order->findOrFail($id);
        $order->update($payload);
        return $order;
    }
 
    public function destroy($id)
    {
        echo "<h3 style='color:red'>deleting from mysql</h3>";
        return $this->order->findOrFail($id)->delete();

    }

























}