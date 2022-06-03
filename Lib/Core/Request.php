<?php
namespace Scandiweb\Lib\Core;
/**
 * Description of Request
 *
 * @author Sune
 */
class Request 
{
    public $method;
    public $contentType;

    public function __construct() 
    {
        $this->method = trim($_SERVER['REQUEST_METHOD']);
        $this->contentType = !empty($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
    }

    /**
     * Get the REQUEST URI from the request, sanitized and 
     * converted to lower case
     * 
     * @return string 
     */
    public function getUrl() {
        // Get the request URI
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false){
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * @return string request method
     */
    public function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @param string input field
     */
    public function getInput(string $field)
    {
        if ($this->getMethod() == 'POST' && !empty($_POST)) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($_POST[$field])) return htmlentities(trim(stripslashes(strip_tags($_POST[$field]))));
        }
    }

    /**
     * @return string input field
     */
    public function getPost(string $field)
    {
        if ($this->getMethod() == 'POST' && !empty($_POST)) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($_POST[$field])) return $_POST[$field];
        }
    }

    /**
     * @return JSON
     */
    public function getJSON()
    {
        if ($this->method !== 'POST') return [];
        if (strcasecmp($this->contentType, 'application/json') !== 0) return [];
        // Receive the RAW post data
        return json_decode(trim(file_get_contents("php://input")));
    }    
}
