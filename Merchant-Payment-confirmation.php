<?php
// Merchant key here as provided by Payu
$MERCHANT_KEY = "TTaBtz"; 

// Merchant Salt as provided by Payu
$SALT = "EgTpDB7i";

// End point - change to https://secure.payu.in for LIVE mode
$PAYU_BASE_URL = "https://secure.payu.in";

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
		  || empty($posted['service_provider'])
  ) {
    $formError = 1;
  } else {
  //  $posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>


 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Food Ordering</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <script src="JavaScript/jquery.js"> </script>
  <script src=" bootstrap/js/bootstrap.min.js"></script>

 <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>



<script>

$(document).ready(function(){


var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                
                 
                      var result=xmlhttp.responseText;
                    
   

            }//if
        }//xmlhttp
        xmlhttp.open("GET", "Merchant-payment-before.php", true);
        xmlhttp.send();
    




}); //end of ready


</script>

<script>

$(document).ready(function(){

$.getJSON('Merchant-details-for-payment.php',function(data)
 {


  document.getElementById("firstname").value=data[0];
  document.getElementById("email").value=data[1];
  document.getElementById("phone").value=data[2];



});


});




</script>



</head>
<body onload="submitPayuForm()">

<div class="container-fluid">
  <div class="row">
       <div class="col-md-12 col-xs-12 col-sm-12 col-lg=12">
        
           <nav class="navbar navbar-inverse navbar-fixed-top">
  
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                  </button>
               <a class="navbar-brand" href="#"><span class="bg-primary" style="font-weight:bold">Website4FoodDelivery</span></a>               
               
               </div>
              <div class="collapse navbar-collapse" id="myNavbar" >
               <div class="nav pull-right">
                  <ul class="nav navbar-nav">
                   	
                     <li class="active"><a  style="font-weight:bold">Make Payment</a></li>

                  </ul>
                </div>
              </div>
             </div>
            </nav>
      
       </div><!col end here>

  </div><!row for logo end here>

<div class="row">
      <div class="col-md-2 col-lg=2 hidden-xs hidden-sm">

      </div>
<!********************************************************sinup form start******************************************************************>
<div class="col-md-8 col-xs-12 col-sm-12 col-lg=8" style="margin-top:70px">
 <h1 class="text-info" style="margin-left:50px">PAYMENT CONFIRMATION</h1>
<br><br> 

<form action="<?php echo $action; ?>" method="post" name="payuForm" role="form" onsubmit="return toSubmit()" >
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <input type="hidden" name="productinfo" value="json_encode(json_decode('[{"name":"food website","description":"website for online food delivery","value":"2000","isRequired":"false"},{"name":"developmentfee","description":"website charge fee","value":"2000","isRequired":"false"}]'))" />

     <input type="hidden" name="furl" value="http://www.website4fooddelivery.in/Merchant-Payment-failure-page.php"/>
     <input type="hidden" name="surl" value="http://www.website4fooddelivery.in/Merchant-Payment-success-page.php"/>
     <input type="hidden" name="service_provider" value="payu_paisa"  />
     <input type="hidden" name="amount" value="2000" />

     <table  class="table table-striped">

<tr>
          <td><label>Amount</label></td>
          <td><input name="amountShowOnly" value="2000 INR" class="form-control" readonly /></td>
</tr>
<tr>
          <td><label>Name</label></td>
          <td><input name="firstname" id="firstname" class="form-control" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" readonly/></td>
</tr>

<tr>
          <td><label>Email</label></td>
          <td><input name="email" id="email" class="form-control" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" readonly /></td>
</tr>
<tr>   
       <td><label>Phone</label></td>
          <td><input name="phone" id="phone" class="form-control" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
</tr>


        <tr>
      
          <?php if(!$hash) { ?>
            <td colspan="2" style="text-align:center"><input type="submit" class="btn btn-default" value="Make Payment" style="color:#FFFFFF;background-color:#FF3300;font-weight:bold" /></td>
          <?php } ?>
        
        </tr>
      </table>
    </form>




















</div>
<!********************************************************sinup form End******************************************************************>
       <div class="col-md-2 col-lg=2 hidden-xs hidden-sm">

      </div>

</div><!end of row for form>





</div><!fluid content end here>

</body>
</html>
