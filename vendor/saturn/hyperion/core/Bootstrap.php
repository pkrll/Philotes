<?php
/**
 * All requests funnels through
 * the Bootstrap class.
 *
 * @author Ardalan Samimi
 * @version 1.0.1
 */
namespace hyperion\core;
require_once(dirname(__DIR__)."/Config.php");

class Bootstrap {

    /**
     * Name of the requested
     * controller class.
     *
     * @var string
     * @access private
     **/
    private $controller = DEFAULT_CONTROLLER;

    /**
     * Name of the requested
     * method.
     *
     * @var string
     * @access private
     **/
    private $method = DEFAULT_METHOD;

    /**
     * Holds the additonal
     * arguments provided.
     *
     * @var string
     * @access private
     **/
    private $arguments;

    /**
     * Get the requested page and initialize
     * the controller, if it exists. If not,
     * the default controller defined by the
     * DEFAULT_CONTROLLER constant, is loaded.
     *
     */
    public function __construct() {
        // Get the requested page, sans the slash
        // at the beginning of the string.
        $URIRequest = substr($_SERVER['REQUEST_URI'], 1);
        $this->parseURI($URIRequest);
        $this->loadController();
    }

    /**
	 * Parse the specified URI and set
	 * which controller and method to
     * use, along with any additional
     * parameters.
	 *
	 * @param  string  The requested controller
	 */
    private function parseURI($URIRequest) {
        if (is_null($URIRequest))
            return FALSE;
        $URIRequest = explode("/", $URIRequest);
        foreach ($URIRequest as $key => $value) {
            if (is_null($value))
                continue;
            switch ($key) {
                case 0:
                    // The first part of the path is the
                    // controller, which must have first
                    // letter capitalized.
                    $this->controller = ucfirst($value);
                    break;
                case 1:
                    $this->method = $value;
                    break;
                default:
                    $this->arguments[] = $value;
            }
        }
    }

    /**
     * Load the requested controller.
     *
     */
    private function loadController() {
        // Set the file path of the controller,
        // and check if it is already included.
        $controller = $this->getPathOfController();
        if (!class_exists($controller['className']))
            include $controller['pathName'];
        // Create an instance of the controller
        new $controller['className']($this->method, $this->arguments);
    }

    /**
	 * Get the path of the requested
	 * controller. If not found, get
	 * the default controller instead.
	 *
	 * @return array
	 */
    private function getPathOfController() {
        $name = $this->controller.'Controller';
        $path = CONTROLLERS . '/' . $name . '.php';
        // If file does not exist, set the path
        // to the default controller.
        if (!file_exists($path)) {
            $name = DEFAULT_CONTROLLER.'Controller';
            $path = CONTROLLERS.'/'.$name.'.php';
            // Set the first part of the the request path
            // to the method if there are no controllers
            // by that name.
            $this->method = lcfirst($this->controller);
        }
        return array(
            "className" => $name,
            "pathName"  => $path
        );
    }



}
