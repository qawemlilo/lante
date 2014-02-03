<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access'); 

$document =& JFactory::getDocument();
$style = '
  .pdetails {
    margin-bottom: 0px;
  }
  .pdetails .control-group {
    padding-top: 5px;
  }
  .pdetails .control-group label {
    width: 120px;
    margin-left: 5px;
    font-size:12px;
    font-color:#333;
    font-weight: bold;
  }
  
  .pdetails .control-group .controls {
    text-align: right;
  }
  
  .pdetails .control-group .controls input[type=text], .pdetails .control-group .controls textarea, .pdetails .control-group .controls strong {
    margin-right: 5px;
  }
  
  .pdetails .control-group {
    background-color: #fff;
  }
  
  .table tbody {
    background-color:#f5f5f5;
  }
  
  table .text-center {text-align: center}
';
$document->addStyleSheet(JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
$document->addStyleDeclaration($style);
$document->addScript(JURI::base() . 'components/com_otc/assets/js/accounting.min.js');
?>

<div style="width:98%;">

  <div id="breadcrumbs" style="margin-bottom: 10px">
    <div class="module">
      <div class="breadcrumbs">
        <a href="/" class="pathway">Home</a> 
        &nbsp;<i class="icon-caret-right"></i>&nbsp; 
        <span>Payment Detail</span>
      </div>
    </div>
  </div>
  
  <div>

    
    
	
    <h3>LanteOTC Member Information</h3>
    <div><b>LAnteOTC Member id:</b> <?php echo $this->paymentdetail->memberid; ?></div>
    <div><b>LAnteOTC Member Name:</b> <?php echo $this->paymentdetail->name . " " . $this->paymentdetail->surname; ?></div>
    <div><b>LAnteOTC Member Cell Number:</b> <?php echo $this->paymentdetail->cell_number; ?></div>
    <div><b>LAnteOTC Member Email:</b> <?php echo $this->paymentdetail->email; ?></div>
    <div><b>LAnteOTC Member Account ID:</b> <?php echo $this->paymentdetail->account_id; ?></div>
    <div><b>LAnteOTC Member Account Number:</b> <?php echo $this->paymentdetail->account_number; ?></div>
    <br />
    
    <h3>Transaction Information</h3>
    <div><b>Payment Id:</b> <?php echo $this->paymentdetail->id; ?></div>
    <div><b>MonsterPay Transaction Id:</b> <?php echo $this->paymentdetail->tnx_id; ?></div>
    <div><b>Transaction Date:</b> <?php echo $this->paymentdetail->tnx_date; ?></div>
    <div><b>Merchant Email:</b> <?php echo $this->paymentdetail->seller_email; ?></div>
    <br />
    
    <h3>Transferer Information (From MonsterPay)</h3>
    <div><b>Username:</b> <?php echo $this->paymentdetail->buyer_uname; ?></div>
    <div><b>Title:</b> <?php echo $this->paymentdetail->buyer_title; ?></div>
    <div><b>First Name:</b> <?php echo $this->paymentdetail->buyer_fname; ?></div>
    <div><b>Last Name:</b> <?php echo $this->paymentdetail->buyer_lname; ?></div>
    <div><b>Email:</b> <?php echo $this->paymentdetail->buyer_email; ?></div>
    <div><b>Contact Number:</b> <?php echo $this->paymentdetail->buyer_cnumber; ?></div>
    <div><b>Street1 Address:</b> <?php echo $this->paymentdetail->buyer_street1; ?></div>
    <div><b>Street2 Address:</b> <?php echo $this->paymentdetail->buyer_street2; ?></div>
    <div><b>City:</b> <?php echo $this->paymentdetail->buyer_city; ?></div>
    <div><b>State:</b> <?php echo $this->paymentdetail->buyer_state; ?></div>
    <div><b>Zip:</b> <?php echo $this->paymentdetail->buyer_zip; ?></div>
    <div><b>Country:</b> <?php echo $this->paymentdetail->buyer_country; ?></div>
    <br />
    
    <h3>Payment Information</h3>
    <div><b>Payment Type:</b> <?php echo $this->paymentdetail->payment_type; ?></div>
    <div><b>Amount Transfered (Rand):</b> <?php echo $this->paymentdetail->amount; ?></div>
    <div><b>Currency:</b> <?php echo $this->paymentdetail->currency; ?></div>
    <div><b>Status:</b> <?php echo $this->paymentdetail->status; ?></div>
    

  </div>
 
  
</div>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/script-planning.js'; ?>"></script>
