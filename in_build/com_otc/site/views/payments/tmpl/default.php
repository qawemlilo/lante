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
        <span>Payments</span>
      </div>
    </div>
  </div>
  
  <div>
    <form action="<?php echo $this->parseUrl('index.php?option=com_otc&view=payments'); ?>" style="margin-bottom: 0px" method="post" name="pagination-form">
    Display # <?php echo @$this->pagination->getLimitBox() ;?>
    </form>
  </div>
  
  <div class="row-fluid">
    <div>
    	<table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="15%">Name</th>
                <th width="15%">Cell Number</th>
                <th width="15%">Account #</th>
                <th width="10%">Amount Transfered</th>
                <th width="15%">Date</th>
                <th width="10%">Payment Type</th>
                <th width="10%">Status</th>
                <th width="10%">&nbsp;</th>
              </tr>
            </thead>
            <tbody>
            <?php
              foreach($this->payments as $payment) :
            ?>
                <tr>
                  <td><?php echo $payment->name . " " . $payment->surname; ?></td>
                  <td><?php echo $payment->cell_number; ?></td>
                  <td><?php echo $payment->account_id; ?></td>
                  <td><?php echo $payment->amount; ?></td>
                  <td><?php echo $payment->tnx_date; ?></td>
                  <td><?php echo $payment->payment_type; ?></td>
                  <td><?php echo $payment->status; ?></td>
                  <td><a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=payments&layout=paymentdetail&id=' . $payment->id);?>">View Detail</a></td>
                </tr>
            <?php
              endforeach;
            ?>
            </tbody>
          </table>
    </div>
  </div>
 
  
</div>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/script-planning.js'; ?>"></script>
