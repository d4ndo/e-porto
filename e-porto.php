<?php
/*******************************************************************************
 * Copyright 2009-2014 Amazon Services. All Rights Reserved.
 * Licensed under the Apache License, Version 2.0 (the "License");
 *
 * You may not use this file except in compliance with the License.
 * You may obtain a copy of the License at: http://aws.amazon.com/apache2.0
 * This file is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR
 * CONDITIONS OF ANY KIND, either express or implied. See the License for the
 * specific language governing permissions and limitations under the License.
 *******************************************************************************
 * PHP Version 5
 * @category Amazon
 * @package  e-porto
 * @version  2013-09-01
 * Library Version: 2013-09-01
 */

require_once('.config.inc.php');

/*
 * e-porto
 *
 * AWS_ACCESS_KEY_ID and AWS_SECRET_ACCESS_KEY constants
 * are defined in the .config.inc.php located in the same
 * directory as this sample
 */
$config = array (
    'ServiceURL' => $serviceUrl,
    'ProxyHost' => null,
    'ProxyPort' => -1,
    'MaxErrorRetry' => 3,
 );

$service = new MarketplaceWebServiceOrders_Client(AWS_ACCESS_KEY_ID,
                                                  AWS_SECRET_ACCESS_KEY,
                                                  APPLICATION_NAME,
                                                  APPLICATION_VERSION,
                                                  $config);

/*
 * Uncomment to try out Mock Service that simulates MarketplaceWebServiceOrders
 * responses without calling MarketplaceWebServiceOrders service.
 *
 * Responses are loaded from local XML files. You can tweak XML files to
 * experiment with various outputs during development
 *
 * XML files available under MarketplaceWebServiceOrders/Mock tree
 *
 */
 // $service = new MarketplaceWebServiceOrders_Mock();


/* Setup request parameters  */
$request = new MarketplaceWebServiceOrders_Model_ListOrdersRequest();
$request->setSellerId(MERCHANT_ID);
$request->setMarketplaceId(MARKETPLACE_ID);
$now = gmdate('Y-m-d\TH:i:s\Z', time()-MAX*60*60);
$orderStatuses = array('PartiallyShipped','Unshipped');
$request->setOrderStatus($orderStatuses);
$request->setCreatedAfter($now);
invokeListOrders($service, $request);

/*
 * e-porto invoke List Orders for the last MAX hours.
 * Gets competitive pricing and related information for a product identified by
 * the MarketplaceId and ASIN.
 *
 * @param MarketplaceWebServiceOrders_Interface $service instance of MarketplaceWebServiceOrders_Interface
 * @param mixed $request MarketplaceWebServiceOrders_Model_ListOrders or array of parameters
 */
function invokeListOrders(MarketplaceWebServiceOrders_Interface $service, $request)
{
    try {
        $fp = fopen(FILENAME, "w");
        $response = $service->ListOrders($request);

        fwrite($fp,iconv("UTF-8", ENCODEING, "NAME;ZUSATZ;STRASSE;NUMMER;PLZ;STADT;LAND;ADRESS_TYP"));
	fwrite($fp,"\r\n");
        fwrite($fp,iconv("UTF-8", ENCODEING, COMPANY.";;".STREET.";".NUMBER.";".PLZ.";".CITY.";".LAND.";HOUSE"));
	fwrite($fp,"\r\n");

	if ($response->isSetListOrdersResult()) 
        {
            $listOrdersResult = $response->getListOrdersResult();
	}

	$orders = $listOrdersResult->getOrders();

	foreach ($orders as $order) 
        {
            $adr = $order->getShippingAddress();
            $name =  $adr->getName();
	    $zusatz = $adr->getAddressLine1();
	    $strasse = $adr->getAddressLine2();
	    $plz = $adr->getPostalCode();
	    $stadt = $adr->getCity();
	    $land = $adr->getCountryCode();

	    fwrite($fp,iconv("UTF-8", "Windows-1252", $name));
	    fwrite($fp,";");
	    fwrite($fp,iconv("UTF-8", "Windows-1252", $zusatz));
	    fwrite($fp,";");
	    fwrite($fp,iconv("UTF-8", "Windows-1252", $strasse));
	    fwrite($fp,";");
	    fwrite($fp,";");
	    fwrite($fp,iconv("UTF-8", "Windows-1252", $plz));
	    fwrite($fp,";");
	    fwrite($fp,iconv("UTF-8", "Windows-1252", $stadt));
	    fwrite($fp,";");
	    fwrite($fp,iconv("UTF-8", "Windows-1252", $land));
	    fwrite($fp,";");
	    fwrite($fp,"HOUSE");
	    fwrite($fp,"\r\n");
	}
     } catch (MarketplaceWebServiceOrders_Exception $ex) {
        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
     }
 }
