<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;

class StripeController extends Controller
{
    public function stripe_data(Request $request){

    	\Stripe\Stripe::setApiKey('sk_test_r0S5AOiKbCP7jizyiLUako01' );
	try {
		\Stripe\Charge::create ( array (
				"amount" => 300 * 100,
				"currency" => "usd",
				"source" => $request->input ( 'stripeToken' ), // obtained with Stripe.js
				"description" => "Test payment." 
		) );
		Session::flash ( 'success-message', 'Payment done successfully !' );
		return Redirect::back ();
	} catch ( \Exception $e ) {
		Session::flash ( 'fail-message', "Error! Please Try again." );
		return Redirect::back ();
	}



    }
}
