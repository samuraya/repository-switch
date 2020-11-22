<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\ShirtOrderController;
use Laminas\Diactoros\Response as Response;


final class ShirtOrderCreate extends ShirtOrderController
{

	public function action():Response
    {
       	return $this->respond(array(),'create.html');   
    }  


}
