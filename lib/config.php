<?php

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */
$system_path = "";
// Set the current directory correctly for CLI requests
if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}

if (realpath($system_path) !== FALSE) {
    $system_path = realpath($system_path) . '/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/') . '/';

// Is the system path correct?
if (!is_dir($system_path)) {
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}


/*
 * -------------------------------------------------------------------
 *  Set the database configuration constants
 * -------------------------------------------------------------------
 */

define('DB_NAME', 'signalpeptide');
define('DB_HOST', '127.0.0.1');
define('DB_PORT', NULL);
define('DB_USER', 'root');
define('DB_PASS', '');

define('DOMAIN', "http://10.0.2.22" );
define('URLPATH', $_SERVER['SCRIPT_NAME']);
define("DOMAIN_URLPATH", DOMAIN ."". URLPATH);

$rootPath = explode('/',  substr(URLPATH,1));

define("CSSPATH", DOMAIN .'/bubbletric/application/view/resources/css');
define("SCRIPTPATH", DOMAIN .'/bubbletric/application/view/resources/js');
define("IMAGEPATH", DOMAIN .'/bubbletric/application/view/resources/image');
define("RESOURCEPATH", DOMAIN .'/bubbletric/application/view/resources');
define("VIEWPATH", DOMAIN .'/bubbletric/application/view');
 

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// The PHP file extension
// this global constant is deprecated.
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

define("APPATH", dirname(dirname(__FILE__)));

?>
