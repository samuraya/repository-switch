<?php

namespace App\Test\TestCase;

use DI\Container;
use InvalidArgumentException;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Laminas\Diactoros\ServerRequestFactory;

use Relay\Relay;
use Middlewares\FastRoute;


use UnexpectedValueException;

// use App\Utility\CustomServerRequestFactory;

/**
 * Container Trait.
 */
trait AppTestTrait
{
       
   

   protected function handleRequest($request)
   {
   		$routes = require __DIR__ . '/../../config/routes.php';
   		$middlewareQueue[] = new FastRoute($routes);
   		$requestHandler = new Relay($middlewareQueue);
		return $requestHandler->handle($request);
   }
    /**
     * Create a server request.
     *
     * @param string $method The HTTP method
     * @param string|UriInterface $uri The URI
     * @param array $serverParams The server parameters
     *
     * @return ServerRequestInterface
     */
    protected function createRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface
    {
        return (new ServerRequestFactory())->createServerRequest($method, $uri, $serverParams);
    }

    protected function createCustomServerRequest($method, $uri, $uploadedFiles)
    {
        return (new CustomServerRequestFactory())->createCustomServerRequest($method, $uri, $uploadedFiles);
    }
    /**
     * Create a JSON request.
     *
     * @param string $method The HTTP method
     * @param string|UriInterface $uri The URI
     * @param array|null $data The json data
     *
     * @return ServerRequestInterface
     */
    protected function createJsonRequest(string $method, $uri, array $data = null): ServerRequestInterface
    {
        $request = $this->createRequest($method, $uri);

        if ($data !== null) {
            $request = $request->withParsedBody($data);
        }

        return $request->withHeader('Content-Type', 'application/json');
    }

    /**
     * Create a form request.
     *
     * @param string $method The HTTP method
     * @param string|UriInterface $uri The URI
     * @param array|null $data The form data
     *
     * @return ServerRequestInterface
     */
    protected function createFormRequest(string $method, $uri, array $data = null): ServerRequestInterface
    {
        $request = $this->createRequest($method, $uri);

        if ($data !== null) {
            $request = $request->withParsedBody($data);
        }

        return $request->withHeader('Content-Type', 'application/x-www-form-urlencoded');
    }

    /**
     * Verify that the specified array is an exact match for the returned JSON.
     *
     * @param ResponseInterface $response The response
     * @param array $expected The expected array
     *
     * @return void
     */
    protected function assertJsonData(ResponseInterface $response, array $expected): void
    {
        $actual = (string)$response->getBody();
        $this->assertJson($actual);
        $this->assertSame($expected, (array)json_decode($actual, true));
    }
}
