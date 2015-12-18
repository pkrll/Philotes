<?php
/**
 * The base View generates the presentation.
 * This class renders the HTML output, while
 * also supplying it with the data from the
 * Model, via the Controller.
 *
 * Normally, there is no need for creating
 * custom Views. The base methods will be
 * enough to render the presentations.
 *
 * @author Ardalan Samimi
 * @version 1.0.0
 */
namespace hyperion\core;

class View {

    /**
     * Variables to be supplied to template.
     *
     * @var array
     * @access protected
     **/
    protected $variables;

    public function __construct() { }

    /**
     * Magic method for setting the
     * inaccessible properties.
     *
     * @param   string  Key of the variable.
     * @param   string  Value of the variable.
     */
    public function __set($key, $value) {
        $this->variables[$key] = $value;
    }

    /**
     * Magic method for getting the inaccessible
     * properties.
     *
     * @param   string  Key of the variable.
     * @return  mixed
     */
    public function __get($key) {
        return $this->variables[$key];
    }

    /**
     * Assign a variable to the template.
     *
     * @param   string  The name of the variable.
     * @param   string  The value of the variable.
     */
    public function assign($key, $value) {
        $this->variables[$key] = $value;
    }

    /**
     * Renders the presentation.
     *
     * @param   string  Name of template file.
     */
    public function render($template) {
        // Get the template path and extract and extract
        // the variables assigned to the template.
        $template = TEMPLATES.'/'.$template;
        if ($this->variables)
            extract($this->variables);
        $this->variables = NULL;
        // Start output buffering and get the contents.
        ob_start();
        include $template;
        echo ob_get_clean();
    }

    /**
     * Send a raw HTTP header.
     *
     * @param   mixed   The header string, supplied either
     *                  as a string or an indexed array.
     */
    public function setHeader($header) {
        if (gettype($header) === "array") {
            foreach ($header as $key => $value)
                header($value);
        } else {
            header($header);
        }
    }

}
