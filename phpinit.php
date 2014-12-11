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
            $step = \'./steps/\'.$classname.\'.php\';
            $lib = \'./lib/\'.$classname.\'.php\';
            $class = \'./classes/\'.$classname.\'.php\';

            if (file_exists($step) && false !== (require_once($step)))
                return;
            if (file_exists($lib) && false !== (require_once($lib)))
                return;
            if (file_exists($class) && false !== (require_once($class)))
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
    error_reporting(E_ALL);
    ini_set('display_errors', true);
}

// setup file access type
function fileaccess() {
    @include('./copy/file_connection.php');
    if (isset($wrapper) && ini_get('allow_url_fopen')) {
        // set path prefixes
        if (!empty($wrapper['target']) && isset($wrapper['install_to'])) {
            Path::setPrefix($wrapper['target'].$wrapper['install_to'], 'target', 'write_wrapper');
        }
        if (!empty($wrapper['installer']) && isset($wrapper['installer_path'])) {
            Path::setPrefix($wrapper['installer'].$wrapper['installer_path'], 'current', 'write_wrapper');
        }
    }
    unset($wrapper);
    // create wrapper url
    //~ $conn = ($ftp['ssl']?'ftps://':'ftp://')
            //~ .(!empty($ftp['user'])?$ftp['user'].(!empty($ftp['pass'])?':'.$ftp['pass']:'').'@':'')
            //~ .$ftp['host'];
}


// perform some inits for the installer
function setup() {
    // setup fileaccess
    fileaccess();

    // Installer Folder Name
    define('INSTALLER_FOLDER', 'fs2installer', true);

    // installer path
    if (!isset($_SESSION['installer_path'])) {
        $_SESSION['installer_path'] = '.';
    }
    define('INSTALLER_PATH', $_SESSION['installer_path'], true);
    Path::setPrefix(INSTALLER_PATH, 'current');

    // New version to be installed
    $_SESSION['upgrade_to'] = trim(Files::file_get_contents(new Path('copy/version', 'current')));
    define('UPGRADE_TO', $_SESSION['upgrade_to'], true);

    // check for install path and from version
    if (isset($_SESSION['install_to'])) {
        $_SESSION['install_to'] = rtrim($_SESSION['install_to'], '/\\');
        define('INSTALL_TO', $_SESSION['install_to'], true);
        Path::setPrefix(INSTALL_TO, 'target');

        if (!isset($_SESSION['upgrade_from'])) {
            if (false === $_SESSION['upgrade_from'] = InstallerFunctions::getInstalledFS2Version(INSTALL_TO)) {
                $_SESSION['upgrade_from'] = 'none';
            }
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
