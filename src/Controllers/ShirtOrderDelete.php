<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\ShirtOrderController;
use Laminas\Diactoros\Response as Response;



final class ShirtOrderDelete extends ShirtOrderController
{
	public function action():Response
    {
    	$id = $this->request->getAttribute('id');
    	$container = $this->request->getAttribute('container');
    	$datasources = $this->request->getAttribute('datasources');
    	$this->deleteFromAllRepos($id, $datasources, $container);

    	return $this->respondRedirect('/all');    	
    }

    /*
        source of truth database updated first 
        and looped through the rest of repos
    */

    public function deleteFromAllRepos($id, $datasources, $container)
    {
        $db = $container->get($datasources['truth']);
        $db->destroy($id);
        unset($datasources['truth']);
        foreach($datasources as $source=>$repository) {
            $container->get($repository)->destroy($id);
        }
        
    }




   
}