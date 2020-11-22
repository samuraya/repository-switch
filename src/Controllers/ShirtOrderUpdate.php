<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\ShirtOrderController;
use Zend\Diactoros\Response as Response;


final class ShirtOrderUpdate extends ShirtOrderController
{
	public function action():Response
    {
    	  	
    	$data = $this->request->getParsedBody();              
        unset($data['source']);

        $container = $this->request->getAttribute('container');
       
        $datasources = $this->request->getAttribute('datasources');
        $this->updateAllRepos($data, $datasources, $container);
        return $this->respondRedirect('/all');
    	
    }
    /*
        source of truth database updated first 
        and looped through the rest of repos
    */

    public function updateAllRepos($data, $datasources, $container)
    {
        $db = $container->get($datasources['truth']);
        $data = $db->update($data['id'],$data);
        unset($datasources['truth']);
        foreach($datasources as $source=>$repository) {
            $container->get($repository)->update($data['id'],$data);
        }
        
    }

}