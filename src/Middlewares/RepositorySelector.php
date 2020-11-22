<?php

namespace App\Middlewares;

use \Psr\Http\Message\{ServerRequestInterface, ResponseInterface};
use \Psr\Http\Server\{RequestHandlerInterface, MiddlewareInterface};
use Psr\Container\ContainerInterface;
use DI\ContainerBuilder;


use DI\Definition\Helper\CreateDefinitionHelper;
use DI\Definition\Helper\AutowireDefinitionHelper;
use App\Models\ShirtOrder;

use App\Repositories\ShirtOrderRepositoryInterface;
use App\Repositories\Truth\TruthShirtOrderRepository;

/*
    this Middleware receives request,if its create, update or delete, 
    then the class instanciates all repos, saves them in container and passes to controller/action class. 

    If request is read then it switches to data source selected by client 
    and passes the request to controller/action class.
*/

class RepositorySelector implements MiddlewareInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    public function process(
        ServerRequestInterface $request, 
        RequestHandlerInterface $handler
    ): ResponseInterface
    {
    /*
        get class names of each datasource repository
    */
        $datasources = require __DIR__ . '/../../config/datasources.php';   
       
        $method = $request->getMethod();
        $route = $request->getUri()->getPath();
        $isDelete = ($method=="GET" && stripos($route, 'delete')) ? true : false;
        
       
        if($method=='POST') {
            $data = $request->getParsedBody();
        } else {
            $data = $request->getQueryParams();
        }

    /*
        If request is POST the source of truth database will be prioratized. 
        All creating, updating and deleting will begin with Mysql database
    */

        if($method=='POST' || $isDelete) { 

    /*
        truth is source of truth database 
        in this example its mysql db
    */
            $source = 'truth';                              
    /*
        instantiate all other data sources 
    */
            $this->instantiateAllRepos($datasources);        
            $request = $request->withAttribute('datasources', $datasources);
            return $handler->handle($request->withAttribute('container', $this->container)); 
            return $handler->handle($request);
            
        } 

    /*
        If request is GET and not /delete then route switches 
        repo to the one selected by client
    */           
        $source = $data['source'] ?? 'cache';    
        $this->switchRepo($source, $datasources);         
        return $handler->handle($request);         
    }

    /*
        instanciate all repositories and save them into container
    */

    public function instantiateAllRepos($datasources)
    {
        foreach($datasources as $source=>$class) {
            $definitionHelper = new AutowireDefinitionHelper($class);
            $definitionHelper->constructorParameter('order', new ShirtOrder());
            $this->container->set($class, $definitionHelper);
        }
    }
    /*
            Dynamically swap the implimentation of the repository interface
            and inject Model instance. Done within DI container instance
     */   
    public function switchRepo($source, $datasources)
    {
        $newRepository = $datasources[$source];
             
        $currentRepository = ShirtOrderRepositoryInterface::class;
        $shirtOrder = new ShirtOrder();
        $definitionHelper = new AutowireDefinitionHelper($newRepository);
        $definitionHelper->constructorParameter('order', $shirtOrder);
        $this->container->set($currentRepository, $definitionHelper);
    }

}