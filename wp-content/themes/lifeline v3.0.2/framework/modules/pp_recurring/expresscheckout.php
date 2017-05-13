<?php
//if(!isset($_POST)) return;
require_once ("paypalfunctions.php");
// ==================================
// PayPal Express Checkout Module
// ==================================

//'------------------------------------
//' The paymentAmount is the total value of 
//' the shopping cart, that was set 
//' earlier in a session variable 
//' by the shopping cart page
//'------------------------------------
if(session_id() == '') session_start();
//$paymentAmount = $_POST["Payment_Amount"];
//$paymentAmount = $_SESSION["Payment_Amount"];
$_SESSION["Payment_Amount"] = sh_set($_POST, 'amount');
$_SESSION["Riased_Amount"] = sh_set($_POST, 'raised_amount');
$_SESSION["Billing_Period"] = sh_set($_POST, 'billing_period');
$_SESSION["Billing_Frequency"] = sh_set($_POST, 'billing_frequency');
$_SESSION["Currency_Code"] = sh_set($_POST, 'currency_code');
$_SESSION["Currency_Symbol"] = sh_set($_POST, 'currency_symbol');

//'------------------------------------
//' The currencyCodeType and paymentType 
//' are set to the selections made on the Integration Assistant 
//'------------------------------------
$currencyCodeType = sh_set($_POST, 'currency_code');
$paymentType = "Sale";
#$paymentType = "Authorization";
#$paymentType = "Order";

//'------------------------------------
//' The returnURL is the location where buyers return to when a
//' payment has been succesfully authorized.
//'
//' This is set to the value entered on the Integration Assistant 
//'------------------------------------
$http = (is_ssl()) ? 'https://' : 'http://';
$returnURL = $http.$_SERVER['HTTP_HOST'].add_query_arg( array('recurring_pp_return' => 'return' ) );
$returnURL = urlencode($returnURL);

/*$returnURL = get_template_directory().'/framework/modules/pp_recurring/review.php';*/
//'------------------------------------
//' The cancelURL is the location buyers are sent to when they hit the
//' cancel button during authorization of payment during the PayPal flow
//'
//' This is set to the value entered on the Integration Assistant 
//'------------------------------------
$cancelURL = $http.$_SERVER['HTTP_HOST'].add_query_arg( array('recurring_pp_return' => 'cancel' ) );

$cancelURL = urlencode($cancelURL);

/*$cancelURL = get_template_directory().'/framework/modules/pp_recurring/index.php';*/

//'------------------------------------
//' Calls the SetExpressCheckout API call
//'
//' The CallShortcutExpressCheckout function is defined in the file PayPalFunctions.php,
//' it is included at the top of this file.
//'-------------------------------------------------

$paymentAmount = sh_set($_POST, 'amount');
$sh_express = new SH_Express_checkout;
$resArray = $sh_express->CallShortcutExpressCheckout ($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);

$ack = strtoupper(sh_set($resArray, "ACK"));

if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
{
	$sh_express->RedirectToPayPal ( sh_set($resArray, "TOKEN") );
} 
else  
{
	//Display a user friendly Error on the page using any of the following error information returned by PayPal
	$ErrorCode = urldecode(sh_set($resArray, "L_ERRORCODE0"));
	$ErrorShortMsg = urldecode(sh_set($resArray, "L_SHORTMESSAGE0"));
	$ErrorLongMsg = urldecode(sh_set($resArray, "L_LONGMESSAGE0"));
	$ErrorSeverityCode = urldecode(sh_set($resArray, "L_SEVERITYCODE0"));

	echo "SetExpressCheckout API call failed. ";
	echo "Detailed Error Message: " . $ErrorLongMsg;
	echo "Short Error Message: " . $ErrorShortMsg;
	echo "Error Code: " . $ErrorCode;
	echo "Error Severity Code: " . $ErrorSeverityCode;
}

