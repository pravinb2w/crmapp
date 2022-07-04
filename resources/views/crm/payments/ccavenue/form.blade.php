{{-- 
<html>
    <body> --}}
        {{-- <form method="post" name="redirect" action="http://www.ccavenue.com/shopzone/cc_details.jsp">  --}}
            {{-- <form method="post" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">  --}}

            {{-- <?php
               // echo '<input type=hidden name=encRequest value="'.$data.'"">';
               // echo '<input type=hidden name=Merchant_Id value="'.$merchant.'">';
            ?>
        </form> --}}
        {{-- <script language='javascript'>document.redirect.submit();</script>
    </body>
</html> --}}

<h1>CCAvenue Payment Gateway Intgration</h1>
<div id="ccav-payment-form">
<form name="frmPayment" action="ccavRequestHandler.php" method="POST">
    <input type="hidden" name="merchant_id" value="<?php echo '81E0204433275CCA7E007B7781545845'; ?>"> 
    <input type="hidden" name="language" value="EN"> 
    <input type="hidden" name="amount" value="1">
    <input type="hidden" name="currency" value="INR"> 
    <input type="hidden" name="redirect_url" value="http://youdomain.com/payment-response.php"> 
    <input type="hidden" name="cancel_url" value="http://youdomain.com/payment-cancel.php"> 
    
    <div>
    <input type="text" name="billing_name" value="" class="form-field" Placeholder="Billing Name"> 
    <input type="text" name="billing_address" value="" class="form-field" Placeholder="Billing Address">
    </div>
    <div>
    <input type="text" name="billing_state" value="" class="form-field" Placeholder="State"> 
    <input type="text" name="billing_zip" value="" class="form-field" Placeholder="Zipcode">
    </div>
    <div>
    <input type="text" name="billing_country" value="" class="form-field" Placeholder="Country">
    <input type="text" name="billing_tel" value="" class="form-field" Placeholder="Phone">
    </div> 
    <div>
    <input type="text" name="billing_email" value="" class="form-field" Placeholder="Email">
    </div>
    <div>
    <button class="btn-payment" type="submit">Pay Now</button>
    </div>
</form>