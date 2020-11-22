<?php
namespace App\Repositories;
use App\Models\ShirtOrder; 


interface ShirtOrderRepositoryInterface
{
    public function all();
 
    public function find($id);
 
    public function store($order);
 
    public function update($id, $order);
 
    public function destroy($id);
}