<?php
namespace Scandiweb\Lib\Core;

/**
 * Description of Route
 *
 * @author Sune
 */
class Router extends Request
{
    /**
     * @var routes
     */
    private $routes = [];

    /**
     * The controller instance
     * 
     * @var Controller
     */
    private ?Controller $controller = null;

    /**
     * Add the route base on get request method, 
     * 
     * @param string $path route URL 
     * @param \Closure $callback The route callback function 
     * @return void
     */
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Add the route base on post request method, 
     * 
     * @param string $path route URL 
     * @param \Closure $callback The route callback function 
     * @return void
     */
    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Resolve the route to the routes in the routing table, 
     * 
     * @param string $path route URL 
     * @param \Closure $callback The route callback function 
     * @return void
     */
    public function resolve()
    {
        $getUrl = $this->getUrl();
        $method = $this->getMethod();
        $callback = $this->routes[$method][$getUrl] ?? false;  
        if ($callback === false){
            throw new \Exception('route not found');
        }
        // if callback is Array: [Controller::class, 'action'] 
        if (is_array($callback)){
            $controller = new $callback[0]();
            $this->controller = $controller;
            $this->controller->action = $callback[1];
            $callback[0] = $controller;
        }

        /**
         * Invoke the $callback function or method 
         * passing in the callback parameters
         */ 
        call_user_func($callback, new Request(), new Response());        
    }
}
