<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\ShirtOrderController;
use Laminas\Diactoros\Response as Response;


final class ShirtOrderShowOne extends ShirtOrderController
{

	public function action():Response
    {
       	//var_dump($this->baseRepository);die;
       	$id = $this->request->getAttribute('id');
    	return $this->respond($this->shirtOrderRepository->find($id), 'view.html');   
    }

   


}
