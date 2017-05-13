<?php
	/*==================================================================
	 PayPal Express Checkout Call
	 ===================================================================
	*/
require_once ("paypalfunctions.php");
if(session_id() == '') session_start();
$sh_express =  new SH_Express_checkout;
$PaymentOption = "PayPal";
if ( $PaymentOption == "PayPal" )
{
	/*
	'------------------------------------
	' The paymentAmount is the total value of 
	' the shopping cart, that was set 
	' earlier in a session variable 
	' by the shopping cart page
	'------------------------------------
	*/
	
	$finalPaymentAmount =  sh_set($_SESSION, "Payment_Amount");
	
	/*
	'------------------------------------
	' Calls the DoExpressCheckoutPayment API call
	'
	' The ConfirmPayment function is defined in the file PayPalFunctions.jsp,
	' that is included at the top of this file.
	'-------------------------------------------------
	*/

	//$resArray = ConfirmPayment ( $finalPaymentAmount ); Remove comment with ontime payment.

	$resArray = $sh_express->CreateRecurringPaymentsProfile();
	

	
	$ack = strtoupper(sh_set($resArray, "ACK"));
	
	if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" )
	{
		$resArray2  = $sh_express->ConfirmPayment($finalPaymentAmount);	
		$ack = strtoupper(sh_set($resArray, "ACK"));
		$resArray = array_merge($resArray, $resArray2);
	}
	
	
	if( $ack == "SUCCESS" || $ack == "SUCCESSWITHWARNING" )
	{
		
		/*
		'********************************************************************************************************************
		'
		' THE PARTNER SHOULD SAVE THE KEY TRANSACTION RELATED INFORMATION LIKE 
		'                    transactionId & orderTime 
		'  IN THEIR OWN  DATABASE
		' AND THE REST OF THE INFORMATION CAN BE USED TO UNDERSTAND THE STATUS OF THE PAYMENT 
		'
		'********************************************************************************************************************
		*/

		$transactionId		= sh_set($resArray, "TRANSACTIONID"); // ' Unique transaction ID of the payment. Note:  If the PaymentAction of the request was Authorization or Order, this value is your AuthorizationID for use with the Authorization & Capture APIs. 
		$transactionType 	= sh_set($resArray, "TRANSACTIONTYPE"); //' The type of transaction Possible values: l  cart l  express-checkout 
		$paymentType		= sh_set($resArray, "PAYMENTTYPE");  //' Indicates whether the payment is instant or delayed. Possible values: l  none l  echeck l  instant 
		$orderTime 			= sh_set($resArray, "ORDERTIME");  //' Time/date stamp of payment
		$amt				= sh_set($resArray, "AMT");  //' The final amount charged, including any shipping and taxes from your Merchant Profile.
		$currencyCode		= sh_set($resArray, "CURRENCYCODE");  //' A three-character currency code for one of the currencies listed in PayPay-Supported Transactional Currencies. Default: USD. 
		$feeAmt				= sh_set($resArray, "FEEAMT");  //' PayPal fee amount charged for the transaction
		$settleAmt			= sh_set($resArray, "SETTLEAMT");  //' Amount deposited in your PayPal account after a currency conversion.
		$taxAmt				= sh_set($resArray, "TAXAMT");  //' Tax charged on the transaction.
		$exchangeRate		= sh_set($resArray, "EXCHANGERATE");  //' Exchange rate if a currency conversion occurred. Relevant only if your are billing in their non-primary currency. If the customer chooses to pay with a currency other than the non-primary currency, the conversion occurs in the customer’s account.
		
		/*
		' Status of the payment: 
				'Completed: The payment has been completed, and the funds have been added successfully to your account balance.
				'Pending: The payment is pending. See the PendingReason element for more information. 
		*/
		
		$paymentStatus	= sh_set($resArray, "PAYMENTSTATUS"); 

		/*
		'The reason the payment is pending:
		'  none: No pending reason 
		'  address: The payment is pending because your customer did not include a confirmed shipping address and your Payment Receiving Preferences is set such that you want to manually accept or deny each of these payments. To change your preference, go to the Preferences section of your Profile. 
		'  echeck: The payment is pending because it was made by an eCheck that has not yet cleared. 
		'  intl: The payment is pending because you hold a non-U.S. account and do not have a withdrawal mechanism. You must manually accept or deny this payment from your Account Overview. 		
		'  multi-currency: You do not have a balance in the currency sent, and you do not have your Payment Receiving Preferences set to automatically convert and accept this payment. You must manually accept or deny this payment. 
		'  verify: The payment is pending because you are not yet verified. You must verify your account before you can accept this payment. 
		'  other: The payment is pending for a reason other than those listed above. For more information, contact PayPal customer service. 
		*/
		
		$pendingReason	= sh_set($resArray, "PENDINGREASON");  

		/*
		'The reason for a reversal if TransactionType is reversal:
		'  none: No reason code 
		'  chargeback: A reversal has occurred on this transaction due to a chargeback by your customer. 
		'  guarantee: A reversal has occurred on this transaction due to your customer triggering a money-back guarantee. 
		'  buyer-complaint: A reversal has occurred on this transaction due to a complaint about the transaction from your customer. 
		'  refund: A reversal has occurred on this transaction because you have given the customer a refund. 
		'  other: A reversal has occurred on this transaction due to a reason not listed above. 
		*/
		
		$reasonCode		= sh_set($resArray, "REASONCODE"); 
		$theme_options = get_option(SH_NAME);

			if( !array_key_exists('donation_collected', $theme_options))
			{
				$theme_options['donation_collected'] = 0;
			}
			
			$target_amount = (sh_set($theme_options, 'donation_collected') >= 0) ? (int)sh_set($theme_options , 'donation_collected')+$amt : 10;
			
			if((int)$target_amount > 0){
				$theme_options['donation_collected'] = $target_amount;
				$theme_options['paypal_raised'] = $theme_options['donation_collected'];
			}
			update_option(SH_NAME, $theme_options);
			$donation_transaction = array();
			$donation_transaction =(get_option('general_donation')) ? get_option('general_donation') : array();
			
			array_push($donation_transaction, array(
										'transaction_id' => $transactionId,
										'transaction_type' => $transactionType,
										'payment_type' => $paymentType,
										'order_time' => $orderTime,
										'amount' => $amt,
										'currency_code' => $currencyCode,
										'fee_amount' => $feeAmt,
										'settle_amount' => $settleAmt,
										'tax_amount' => $taxAmt,
										'exchange_rate' => $exchangeRate,
										'payment_status' => $paymentStatus,
										'pending_reason' => $pendingReason,
										'reason_code' => $reasonCode,
										'payer_id' => sh_set($_SESSION, 'payer_id'),
										'ship_to_name' => sh_set($_SESSION, 'shipToName'),
										'donation_type' => 'Multiple',
										 
									));
			update_option('general_donation', $donation_transaction);
		
		if(is_user_logged_in()){
			
			$user_ID = get_current_user_id();
			$user_data = array(sh_set($_SESSION, 'payer_id') => array(
															'fistname' => sh_set($_SESSION, 'first_name'),
															'lastName' => sh_set($_SESSION, 'last_name'),
															'email' => sh_set($_SESSION, 'email'),
															'ship_to_name' => sh_set($_SESSION, 'shipToName'),
															'ship_to_street' => sh_set($_SESSION, 'shipToStreet'),
															'status' => sh_set($_SESSION, 'shipToCity'),
															'addressCountry' => sh_set($_SESSION, 'shipToState'),
															'addressCountryCode' => sh_set($_SESSION, 'shipToZip'),
															'addressZip' => sh_set($_SESSION, 'shipToCountryCode'),
															'addressState' => sh_set($_SESSION, 'shipToCountryName'),
															'addressCity' => sh_set($_SESSION, 'AddressStatus'),
														)
						);
			 update_user_meta( $user_ID, 'trasaction_user_data', $user_data); 
			
		}
		
		echo "<div class='confirm_popup'>Thank you for your payment.</div>";
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
