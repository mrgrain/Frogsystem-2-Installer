<?php
// init some php stuff
function phpinit ($session = true, $header = false, $libloader = null) {
    // path for includes
    define('INSTALLER_PATH', './', true);
    
    // Header?
    if ($header !== false) {
        // Set header
        header($header);
    }

    // Start Session
    if ($session)
        session_start();

    // Disable magic_quotes if available
    if (get_magic_quotes_gpc() || get_magic_quotes_runtime()) {
        ini_set('magic_quotes_gpc', 0);
        ini_set('magic_quotes_runtime', 0);
    }

    // Default libloader
    if (is_null($libloader)) {
        $libloader = create_function ('$classname', '
            if (false !== (@include_once(INSTALLER_PATH . \'steps/\'.$classname.\'.php\')))
                return;
            if (false !== (@include_once(INSTALLER_PATH . \'lib/.$classname.\'.php\')))
                return;
            if (false !== (@include_once(INSTALLER_PATH . \'classes/\'.$classname.\'.php\')))
                return;');
    }

    // no libloader?
    if ($libloader === false)
        spl_autoload_register();
    else
        spl_autoload_register($libloader);
        
    // load exceptions
    require(INSTALLER_PATH.'classes/Exceptions.php');        
}

// turn on debuggin mode
function debug() {
    // turn on errors
    error_reporting(E_ALL);
    ini_set('display_errors', true);
}

// perform some inits for the installer
function setup() {
    // Installer constants
    define('INSTALLER_LOCATION', 'fs-installer', true);
    if (!isset($_SESSION['upgrade_to'])) {
        $_SESSION['upgrade_to'] = trim(file_get_contents(INSTALLER_PATH.'copy/version'));
    }
    define('UPGRADE_TO', $_SESSION['upgrade_to'], true);

    // check for install path and from version
    if (isset($_SESSION['install_to'])) {
        $last = substr($_SESSION['install_to'], -1, 1);
        if(!("/" == $last || "\\" == $last || DIRECTORY_SEPARATOR == $last)) {
            $_SESSION['install_to'] = $_SESSION['install_to'].DIRECTORY_SEPARATOR;
        }
        define('INSTALL_TO', $_SESSION['install_to'], true);
        if (false === $_SESSION['upgrade_from'] = InstallerFunctions::getInstalledFS2Version(INSTALL_TO))
            $_SESSION['upgrade_from'] = 'none';
    }
    if (isset($_SESSION['upgrade_from'])) {
      define('UPGRADE_FROM', $_SESSION['upgrade_from'], true);
    }
}

?>
