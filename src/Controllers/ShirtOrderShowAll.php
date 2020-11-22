<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\ShirtOrderController;
use Laminas\Diactoros\Response as Response;


final class ShirtOrderShowAll extends ShirtOrderController
{

	public function action():Response
    {
    	
       	$orders = $this->shirtOrderRepository->all();
        return $this->respond($orders, 'index.html');
    }

   


}