<?php
function detect_language() {
    // get language
    $de = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'de');
    $en = strpos($_SERVER['HTTP_ACCEPT_LANGUAGE'], 'en');

    if ($de !== false && $de < $en) {
        return 'de_DE';
    } else {
        return 'en_US';
    }
}

function phpinit ($session = true, $header = false, $libloader = null) {

    // Header?
    if ($header !== false) {
        // Set header
        header($header);
    }
    
    // path seperator
    if ( ! defined( 'PATH_SEPARATOR' ) ) {
      if ( strpos( $_ENV[ 'OS' ], 'Win' ) !== false )
        define( 'PATH_SEPARATOR', ';' );
      else define( 'PATH_SEPARATOR', ':' );
    }    

    // Start Session
    if ($session)
        session_start();

    // Disable magic_quotes_runtime
    ini_set('magic_quotes_runtime', 0);

    // Default libloader
    if (is_null($libloader)) {
        $libloader = create_function ('$classname', '
            if (false !== (@include_once(FS2_ROOT_PATH . \'libs/class_\'.$classname.\'.php\')))
                return;
            if (false !== (@include_once(FS2_ROOT_PATH . \'classes/\'.$classname.\'.php\')))
                return;
            if (false !== (@include_once(FS2_ROOT_PATH . \'steps/\'.$classname.\'.php\')))
                return;');
    }

    // no libloader?
    if ($libloader === false)
        spl_autoload_register();
    else
        spl_autoload_register($libloader);
        
    // load exceptions
    require(FS2_ROOT_PATH.'classes/Exceptions.php');        
}
phpinit();
?>
