<?php
namespace Scandiweb\Lib\Core;
/**
 * Description of Request
 *
 * @author Sune
 */
abstract class RequestMethod 

{
    public $method;
    public $contentType;

    public function __construct() 
    {
        $this->method = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
    }

    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function isGet()
    {
        return $this->method() === 'get' ?? $this->method() === 'GET';
    }

    public function isPost()
    {
        return $this->method() === 'post' ?? $this->method() === 'POST';
    }
}
