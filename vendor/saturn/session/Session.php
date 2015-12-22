<?php
/**
 * Simple Session Class
 *
 * @author Ardalan Samimi
 * @version 1.0.0
 */
namespace saturn\session;
class Session {
    const SESSION_IDENTIFIER = "XYZ";
    /**
     * Set the session variable. If the
     * '$global' param is set to false
     * the session variable should not
     * be accessible by any other class
     * than the invoking one.
     *
     * @param   string  Name of $_SESSION variable
     * @param   mixed   Value of variable
     * @param   bool    OPTIONAL. A TRUE value will
     *                  make it accessible globally.
     *                  Defaults to TRUE.
     */
	public static function set($key, $value, $global = TRUE) {
		$variableName = self::constructVariableName($key, $global);
		$_SESSION[$variableName] = $value;
	}

    /**
     * Retrieves the session variable.
     *
     * @param   string  Name of variable.
     * @param   bool    OPTIONAL. Accessibilty of
     *                  the session variable. Use
     *                  FALSE if the accessibilty
     *                  is local, and TRUE if it's
     *                  global. Defaults to TRUE.
     * @return  mixed
     */
	public static function get($key, $global = TRUE) {
		$variableName = self::constructVariableName($key, $global);
		return isset($_SESSION[$variableName]) ? $_SESSION[$variableName] : NULL;
	}

    /**
     * Clears the session variable.
     *
     * @param   string  Name of variable.
     * @param   bool    OPTIONAL. Accessibilty of
     *                  the session variable. Use
     *                  FALSE if the accessibilty
     *                  is local, and TRUE if it's
     *                  global. Defaults to TRUE.
     */
	public static function clear($key, $global = TRUE) {
		$variableName = self::constructVariableName($key, $global);
		unset($_SESSION[$variableName]);
	}

    /**
     * Checks if a session variable is set.
     *
     * @param   string  Name of variable.
     * @return  bool
     */
	public static function check($key) {
		return isset($_SESSION[$key]) ? TRUE : FALSE;
	}

    /**
     * Generates a name for the session variable. If the
     * global parameter is TRUE the name should have the
     * global prefix, otherwise the class name.
     *
     * @param   string  Name of variable.
     * @param   bool    OPTIONAL. Accessibilty of
     *                  the session variable. Use
     *                  FALSE if the accessibilty
     *                  is local, and TRUE if it's
     *                  global. Defaults to TRUE.
     * @return  string
     */
	private static function constructVariableName($key, $global = TRUE) {
		if ($global)
			return SESSION_IDENTIFIER . '_' . $key;
		else
			return get_called_class() . '_' . $key;
	}
}
