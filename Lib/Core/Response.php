<?php
namespace Scandiweb\Lib\Core;

/**
 * Description of Response
 *
 * @author Sune
 */
class Response
{
    private $status = 200;
    protected const ALERTS = ['info', 'success', 'warning', 'danger'];

    public function status(int $code) 
    {
        $this->status = $code;
        return $this;
    }
    
    /**
     * JSON Response
     * 
     * @param array
     */
    public function toJson($data=[])
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($this->status);
        echo json_encode($data);
        exit;
    }

    /**
     * For rendering template
     * 
     * @param string template name
     * @param array 
     */
    public function render($view, $context=[])
    {
        extract($context, EXTR_SKIP);
        $file = dirname(__DIR__) . "/../App/Views/$view.php";
        if (file_exists($file) && is_readable($file)){
            require_once $file;
        } else {
            throw new \Exception("File not found"); // echo "File not found";
        }
    }
}
