<?php
declare(strict_types=1);

namespace App\Repositories\Cache;

use App\Repositories\ShirtOrderRepositoryInterface;
use App\Repositories\Eloquent\EloquentShirtOrderRepository;
use App\Repositories\BaseRepository;
use App\Models\ShirtOrder;
use \APCUIterator;


class CacheShirtOrderRepository implements ShirtOrderRepositoryInterface
{

    /*
        This is in memory APCU cache system
        All settings are defaults
    */

	private $order;
	private $prefix;

	public function __construct(ShirtOrder $order)
	{  

        $this->order = $order;
		$this->regex = '/^shirt_order\./';
        $this->prefix = 'shirt_order.';
        
	}	

	public function all()
	{	
        
        $orders = [];
        foreach (new APCUIterator($this->regex) as $order) {
            $orders[]=$order['value'];
                     
        }
        
        if(empty($orders) || $orders==null) {
            echo "<h3 style='color:red'>Not in cache, getting from mysql first --->></h3>";
            $orders = $this->order->all();
            foreach($orders as $order){
                apcu_add($this->prefix.$order['id'], $order);
            }
            echo "<h3 style='color:red'>saving to cache and fetching from cache</h3>";
            return $orders;
        } else {
            echo "<h3 style='color:red'>getting from cache</h3>";
            return $orders;
            
        }                    

	}
 
    public function find($id)
    {          
        $order = apcu_fetch($this->prefix.$id); 
        if($order === false) {
           echo "<h3 style='color:red'>Not in cache, getting from mysql first --->></h3>";
            $order = $this->order->findOrFail($id);
            echo "<h3 style='color:red'>writing to cache and fetching from cache</h3>";
            apcu_add($this->prefix.$id, $order);
        }   
        echo "<h3 style='color:red'>getting from cache</h3>";  
        return $order;       
    }
 
    public function store($payload)
    {   
               
        $id = (string)$payload['id'];
        echo "<h3 style='color:red'>writing to cache</h3>";          
        apcu_add($this->prefix.$id, $payload);             
        return $payload;          
    }
 
    public function update($id, $payload)
    {
            
        apcu_delete($this->prefix.$id);   
        echo "<h3 style='color:red'>updating cache</h3>";     
        apcu_add($this->prefix.$id, $payload);
        return $payload;        
    }
 
    public function destroy($id)
    {
       
        echo "<h3 style='color:red'>deleting from cache</h3>";
        return apcu_delete($this->prefix.$id);
    }

    public function clear()
    {
       return apcu_clear_cache();
    }

























}