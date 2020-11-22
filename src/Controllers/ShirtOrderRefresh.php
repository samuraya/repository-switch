<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\ShirtOrderController;
use Laminas\Diactoros\Response as Response;



final class ShirtOrderRefresh extends ShirtOrderController
{
	public function action():Response
    {
    	$this->shirtOrderRepository->clear();
    	return $this->respondRedirect('/all');
    }
   
}