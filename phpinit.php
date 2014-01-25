<?php
// init some php stuff
function phpinit ($session = true, $header = false, $libloader = null) {
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
            if (false !== (@include_once(\'./steps/\'.$classname.\'.php\')))
                return;
            if (false !== (@include_once(\'./lib/\'.$classname.\'.php\')))
                return;
            if (false !== (@include_once(\'./classes/\'.$classname.\'.php\')))
                return;');
    }

    // no libloader?
    if ($libloader === false)
        spl_autoload_register();
    else
        spl_autoload_register($libloader);

    // load exceptions
    require('./classes/Exceptions.php');
}

// turn on debuggin mode
function debug() {
    // turn on errors
    error_reporting(E_ALL | E_STRICT);
    ini_set('display_errors', true);
}

// setup file access type
function fileaccess() {
    include('./copy/ftp_connection.php');
    if (ini_get('allow_url_fopen') && !empty($ftp['host']) && !empty($ftp['install_to']) && !empty($ftp['installer_path'])) {
        // create wrapper url
        $conn = ($ftp['ssl']?'ftps://':'ftp://')
                .(!empty($ftp['user'])?$ftp['user'].(!empty($ftp['pass'])?':'.$ftp['pass']:'').'@':'')
                .$ftp['host'];

        // set to file access class
        Files::setUrlWrapper($conn, $ftp['installer_path']);

        // update install to/from
        $_SESSION['install_to'] = $ftp['install_to'];
        $_SESSION['installer_path'] = '.';
    }
}


// perform some inits for the installer
function setup() {
    // setup fileaccess
    fileaccess();

    // Installer Folder Name
    define('INSTALLER_FOLDER', 'fs2installer', true);

    // installer path
    if (isset($_SESSION['installer_path'])) {
      define('INSTALLER_PATH', $_SESSION['installer_path'], true);
    } else {
      define('INSTALLER_PATH', '.', true);
    }

    // New version to be installed
    if (!isset($_SESSION['upgrade_to'])) {
        $_SESSION['upgrade_to'] = trim(Files::file_get_contents(INSTALLER_PATH.DIRECTORY_SEPARATOR.'copy/version'));
    }
    define('UPGRADE_TO', $_SESSION['upgrade_to'], true);

    // check for install path and from version
    if (isset($_SESSION['install_to'])) {
        $_SESSION['install_to'] = rtrim($_SESSION['install_to'], '/\\');
        define('INSTALL_TO', $_SESSION['install_to'], true);

        if (!isset($_SESSION['upgrade_from'])) {
            if (false === $_SESSION['upgrade_from'] = InstallerFunctions::getInstalledFS2Version(INSTALL_TO))
                $_SESSION['upgrade_from'] = 'none';
            }
        }

    // old version
    if (isset($_SESSION['upgrade_from'])) {
      define('UPGRADE_FROM', $_SESSION['upgrade_from'], true);
    }

    // URL to installed property
    if (isset($_SESSION['url'])) {
      define('URL', $_SESSION['url'], true);
    }
}
?>
