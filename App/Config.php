<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'localhost';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'address_book';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'admin';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'admin';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;
    
    /**
     * Cache location
     * @var string
     */
    const CACHE = "cache";

    /**
     *  Enable Twig auto reload - Disable when LIVE !
     * @var boolean
     */
    const RELOAD = true;

    /**
     * Checks if the option is in the .env file else it returns the class's const.
     *
     * @param string $option
     * @return string
     */

    static function env($option){
        if(isset($_ENV[$option])){
            if(in_array($_ENV[$option],["true","false"])){
                return $_ENV[$option] == "true";
            }else{
                return $_ENV[$option];
            }
        }else{
            return constant('self::'. $option);
        }
    }
}
