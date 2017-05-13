<?php
/*==================================================================
 PayPal Express Checkout Call
 ===================================================================
*/
// Check to see if the Request object contains a variable named 'token'	
if(session_id() == '') session_start();
ob_start();
$token = "";
if (isset($_REQUEST['token']))
{
	$token = sh_set($_REQUEST, 'token');
}

// If the Request object contains the variable 'token' then it means that the user is coming from PayPal site.	
if ( $token != "" )
{

	require_once ("paypalfunctions.php");
	$sh_express = new SH_Express_checkout;
	/*
	'------------------------------------
	' Calls the GetExpressCheckoutDetails API call
	'
	' The GetShippingDetails function is defined in PayPalFunctions.jsp
	' included at the top of this file.
	'-------------------------------------------------
	*/
	

	$resArray = $sh_express->GetShippingDetails( $token );
	//printr($resArray);
	$ack = strtoupper(sh_set($resArray, "ACK"));
	if( $ack == "SUCCESS" || $ack == "SUCESSWITHWARNING") 
	{
		/*
		' The information that is returned by the GetExpressCheckoutDetails call should be integrated by the partner into his Order Review 
		' page		
		*/
		$email 			= sh_set($resArray, "EMAIL"); // ' Email address of payer.
		$payerId 			= sh_set($resArray, "PAYERID"); // ' Unique PayPal customer account identification number.
		$payerStatus		= sh_set($resArray, "PAYERSTATUS"); // ' Status of payer. Character length and limitations: 10 single-byte alphabetic characters.
		$salutation			= sh_set($resArray, "SALUTATION"); // ' Payer's salutation.
		$firstName			= sh_set($resArray, "FIRSTNAME"); // ' Payer's first name.
		$middleName			= sh_set($resArray, "MIDDLENAME"); // ' Payer's middle name.
		$lastName			= sh_set($resArray, "LASTNAME"); // ' Payer's last name.
		$suffix				= sh_set($resArray, "SUFFIX"); // ' Payer's suffix.
		$cntryCode			= sh_set($resArray, "COUNTRYCODE"); // ' Payer's country of residence in the form of ISO standard 3166 two-character country codes.
		$business			= sh_set($resArray, "BUSINESS"); // ' Payer's business name.
		$shipToName			= sh_set($resArray, "SHIPTONAME"); // ' Person's name associated with this address.
		$shipToStreet		= sh_set($resArray, "SHIPTOSTREET"); // ' First street address.
		$shipToStreet2		= sh_set($resArray, "SHIPTOSTREET2"); // ' Second street address.
		$shipToCity			= sh_set($resArray, "SHIPTOCITY"); // ' Name of city.
		$shipToState		= sh_set($resArray, "SHIPTOSTATE"); // ' State or province
		$shipToCntryCode	= sh_set($resArray, "SHIPTOCOUNTRYCODE"); // ' Country code. 
		$shipToZip			= sh_set($resArray, "SHIPTOZIP"); // ' U.S. Zip code or other country-specific postal code.
		$addressStatus 		= sh_set($resArray, "ADDRESSSTATUS"); // ' Status of street address on file with PayPal   
		$invoiceNumber		= sh_set($resArray, "INVNUM"); // ' Your own invoice or tracking number, as set by you in the element of the same name in SetExpressCheckout request .
		$phonNumber			= sh_set($resArray, "PHONENUM"); // ' Payer's contact telephone number. Note:  PayPal returns a contact telephone number only if your Merchant account profile settings require that the buyer enter one. 
		$_SESSION['TOKEN'] = sh_set($_REQUEST, 'token');
		$_SESSION['email'] = sh_set($resArray, "EMAIL");
		$_SESSION['payer_id'] = sh_set($resArray, "PAYERID");
		$_SESSION['payer_status'] = sh_set($resArray, "PAYERSTATUS");
		$_SESSION['first_name'] = sh_set($resArray, "FIRSTNAME");
		$_SESSION['last_name'] = sh_set($resArray, "LASTNAME");
		$_SESSION['shipToName'] = sh_set($resArray, "SHIPTONAME");
		$_SESSION['shipToStreet'] = sh_set($resArray, "SHIPTOSTREET");
		$_SESSION['shipToCity'] = sh_set($resArray, "SHIPTOCITY");
		$_SESSION['shipToState'] = sh_set($resArray, "SHIPTOSTATE");
		$_SESSION['shipToZip'] = sh_set($resArray, "SHIPTOZIP");
		$_SESSION['shipToCountryCode'] = sh_set($resArray, "SHIPTOCOUNTRYCODE");
		$_SESSION['shipToCountryName'] = sh_set($resArray, "SHIPTOCOUNTRYNAME");
		$_SESSION['AddressStatus'] = sh_set($resArray, "ADDRESSSTATUS");
	} 
	else  
	{
		//Display a user friendly Error on the page using any of the following error information returned by PayPal
		$ErrorCode = urldecode(sh_set($resArray, "L_ERRORCODE0"));
		$ErrorShortMsg = urldecode(sh_set($resArray, "L_SHORTMESSAGE0"));
		$ErrorLongMsg = urldecode(sh_set($resArray, "L_LONGMESSAGE0"));
		$ErrorSeverityCode = urldecode(sh_set($resArray, "L_SEVERITYCODE0"));
		
		echo "GetExpressCheckoutDetails API call failed. ";
		echo "Detailed Error Message: " . $ErrorLongMsg;
		echo "Short Error Message: " . $ErrorShortMsg;
		echo "Error Code: " . $ErrorCode;
		echo "Error Severity Code: " . $ErrorSeverityCode;
	}
}
		
?>
<div class="confirm_popup">
<h2><?php _e('Confirm your informations', SH_NAME)?></h2>
<table>
	<tbody>
		<tr>
			<td><?php _e('Name:', SH_NAME)?>
			<td><?php echo isset($lastName)." ".isset($firstName) ?>
		</tr>
		<tr>
			<td><?php _e('Email:', SH_NAME)?>
			<td><?php echo isset($email); ?>
		</tr>
		<tr>
			<td><?php echo __('You will pay ',SH_NAME ).sh_set($_SESSION, "Currency_Symbol").sh_set($_SESSION, "Payment_Amount").__(' on every ', SH_NAME).sh_set($_SESSION, "Billing_Frequency").' '.sh_set($_SESSION, "Billing_Period");?>	
		</tr>
	<tbody>
</table>
<form action='' METHOD='POST'>
	<input id="paypal_confirmation" type="submit" value="<?php _e('Confirm', SH_NAME)?>"/>
</form>
<script>
	/*jQuery(document).ready(function($){
		var popup = $('div.confirm_popup');
		var cl = $(popup).parent().parent();
		console.log(cl);
		jQuery(cl).find('.donate-btn').trigger("click");
		$(popup).parent().css({'border-top': 'none'});
	});*/
</script>
</div>
<?php $response_output = ob_get_contents();
ob_end_clean();
return $response_output;

?>