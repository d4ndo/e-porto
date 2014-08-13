<?php
/*
 * Copyright 2014 Daniel Dörrhöfer. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License");
 * Derived from "The Marketplace Web Service Orders PHP Library" (Amazon Technologies, Inc.) 
 */

define('APPLICATION_NAME', 'e-post');
define('APPLICATION_VERSION', '0.0.1');
define('ENCODEING', 'Windows-1250');

/* Reply Address */
define('COMPANY', 'Meine Firma');
define('STREET', 'Musterstr.');
define('NUMBER', '23');
define('PLZ', '12345');
define('CITY', 'Musterhausen');
define('LAND', 'DE');

/* Get this from Amazon */
define('AWS_ACCESS_KEY_ID', 'MY_AWS_ACCESS_KEY_ID');
define('AWS_SECRET_ACCESS_KEY', 'MY_AWS_SECRET_ACCESS_KEY');
define ('MERCHANT_ID', 'MY_MERCHANT_ID');
define ('MARKETPLACE_ID', 'MY_MARKETPLACE_ID');

/* Filename of csv file*/
define('FILENAME', 'e-porto.csv');

/* Max time to go back in time . Orders older then MAX wont be considered  */
define('MAX', 96);

/* Set include path to root of library, relative to e-porto directory. Not needed if path is set.*/
set_include_path(get_include_path() . PATH_SEPARATOR . '../src/.');

/* Service url for europe. More endpoints are listed in the MWS Developer Guide */
$serviceUrl = "https://mws-eu.amazonservices.com/Orders/2013-09-01";

/*
 * OPTIONAL ON SOME INSTALLATIONS
 *
 * Autoload function is reponsible for loading classes of the library on demand
 *
 * NOTE: Only one __autoload function is allowed by PHP per each PHP installation,
 * and this function may need to be replaced with individual require_once statements
 * in case where other framework that define an __autoload already loaded.
 *
 * However, since this library follow common naming convention for PHP classes it
 * may be possible to simply re-use an autoload mechanism defined by other frameworks
 * (provided library is installed in the PHP include path), and so classes may just
 * be loaded even when this function is removed
 */
function __autoload($className) {
    $filePath = str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
    $includePaths = explode(PATH_SEPARATOR, get_include_path());
    foreach($includePaths as $includePath)
    {
        if(file_exists($includePath . DIRECTORY_SEPARATOR . $filePath))
        {
            require_once $filePath;
            return;
        }
    }
}
