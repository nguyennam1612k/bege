<?php
/**
 * Created by PhpStorm.
 * User: trungnv
 * Date: 11/16/2017
 * Time: 9:14 AM
 */
require('stripe/init.php');
$error = '';
$success = '';
if ($_POST) {
    if(!isset($_POST['amount']) || empty($_POST['amount'])){
        throw new Exception("Please input the amount of payment");
    }
    $amount = $_POST['amount'].'00';
    \Stripe\Stripe::setApiKey("sk_test_LZBU7ogG4jfChfaJMQKRlIG7004VVfqASy");
    try {
        if (!isset($_POST['stripeToken'])) throw new Exception("The Stripe Token was not generated correctly");
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'OfficeHeads payment for Mango service',
            'source' => $token,
            // 'metadata' => ['name' => $_POST['name'], 'email' => $_POST['email']]
        ]);
        if ($charge->id) $success = '<h1>Thank You!</h1><h3>Your payment has been processed successfully.</h3>';
    }
    catch (\Stripe\Error\Base $e) {
        $error = $e->getMessage();
    }
    catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Payment for OfficeHeads</title>
    <meta 
     name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' 
/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style type="text/css">
        .payment-errors {    
            color: red;
            margin: 20px auto;
            display: block;
            font-size: 14px;
        }
    </style>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <!-- jQuery is used only for this example; it isn't required to use Stripe -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript">
        // this identifies your website in the createToken call below
        Stripe.setPublishableKey('pk_test_51fPtf262Z9p11AQqmZGZK4J003SfLH077');
        function stripeResponseHandler(status, response) {
            if (response.error) {
                // re-enable the submit button
                $('.submit-button').removeAttr("disabled");
                // show the errors on the form
                $(".payment-errors").html(response.error.message);
            } else {
                var form$ = $("#payment-form");
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                // and submit
                form$.get(0).submit();
            }
        }
        $(document).ready(function() {
            $("#payment-form").submit(function(event) {
                // disable the submit button to prevent repeated clicks
                $('.submit-button').attr("disabled", "disabled");
                // createToken returns immediately - the supplied callback submits the form if there are no errors
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
                return false; // submit from callback
            });
        });
    </script>
</head>
<body>
<!-- to display errors returned by createToken -->
<div align="center" style="background: url('img/repeat.png') center top repeat-y;">
<img src="img/background_logo_small.png" alt="" />    
</div>
<?php if ($success == '') { ?>

<div class="" style="width: 300px; height: 600px; margin: 50px auto;">
    <span class="payment-errors"><?= $error ?></span>
    <form action="" method="POST" id="payment-form">
        <div class="form-group">
            <label>OfficeHeads payment for Mango service: <font size="3"><strong>&nbsp;$790</strong></font></label>
            <input type="hidden" name="amount" autocomplete="off" class="amount form-control" value="790" />
        </div>
    
        <hr />
        <div class="form-group">
            <label>Card Number</label>
            <input type="text" size="20" autocomplete="off" class="card-number form-control" />
        </div>
        <div class="form-group">
            <label>CVC</label>
            <input type="text" style="width: 70px;" size="4" autocomplete="off" class="card-cvc form-control" />
        </div>
        <div class="form-group">
            <label style="width: 100%;float: left;">Expiration (MM/YYYY)</label>
            <input type="text" size="2" style="width: 70px;float: left;" class="card-expiry-month form-control"/>
            <span style="width: 30px;float: left;text-align: center"> / </span>
            <input type="text" size="4" style="width: 90px;float: left;" class="card-expiry-year form-control"/>
        </div>
        <button type="submit" style="margin-top:20px;width: 120px;height: 50px;font-size: 16px;" class="submit-button btn btn-primary">Submit</button>
    </form>
</div>
<?php } else { ?>
    <div class="" style="width: 600px;margin: 100px auto 0;height: 350px;"><?= $success ?>
    </div>
<?php } ?>
<div align="center" style="background: url('img/repeat.png') center top repeat-y;">
<img src="img/background_small.png" alt="" />    
</div>
</body>
</html>

