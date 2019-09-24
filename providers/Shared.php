<?php


namespace Ludndev\UrlShortener\API\Providers;


/**
* 
*/
class Shared 
{


    /**
     * A proper way to scan a directory, with dots
     *
     * @access public
     * @static
     * @param string $path
     * @return array
     */
    public static function ProperScandir(string $path):array
    {
        return 
            array_slice(
                scandir( $path ), 2
            );
    }




    /**
     * A proper way to scan a directory, with dots
     *
     * @access public
     * @static
     * @param string $path
     * @return array
     */
    public static function ControllersLoader():array
    {
        $loaders = [];

        $controllers = self::ProperScandir( DIR . './controllers/' );

        foreach ($controllers as $controller) {

            if ( is_dir( DIR . "./controllers/$controller/" ) ) {

                $controller = self::ProperScandir( DIR . "./controllers/$controller/" );

                foreach ($controller as $loader) {
                    if ( preg_match('/^.*\.(loader.php)$/i', $loader) )
                        $loaders[] = $loader;
                }

            }

        }

        return $loaders;
    }

    /**
     * Function_description
     *
     * @access public
     * @static
     * @see link
     * @param string $param
     * @return type
     */
    public static function funct(string $param)
    {
        # code
    }


}