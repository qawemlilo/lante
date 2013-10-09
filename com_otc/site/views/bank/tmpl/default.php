<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addStyleDeclaration('#limit {width: 60px}');
?>

<div style="width:98%">

<div>
   <ul class="nav nav-pills" style="margin-bottom: 0px">
    <li>
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=members'); ?>"><i class="icon-user"></i> Registered Members</a>
    </li>
    <li>
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=companies'); ?>"><i class="icon-briefcase"></i> Listed Companies</a>
    </li>
    <li>
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=admin&layout=transactions'); ?>"><i class="icon-signal"></i> Transactions</a>
    </li>
  </ul>
  <hr style="margin-top: 0px" />
</div>


<div class="row-fluid" style="margin-bottom: 10px">
  <div class="span4">
    <form action="<?php echo $this->parseUrl('index.php?option=com_otc&view=bank'); ?>" style="margin-bottom: 0px" method="post" name="pagination-form">
    Display # <?php echo @$this->pagination->getLimitBox() ;?>
    </form>
  </div>

  <div class="span8" style="text-align:right">
    <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=bank&layout=transaction'); ?>" class="btn btn-primary" type="button">
      <i class="icon-check"></i> New Transaction
    </a>
  </div>
</div>
 
<div class="row-fluid"> 
  <?php
  if (is_array($this->transactions) && count($this->transactions) > 0) :
  ?>
  
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="text-align:center">Date</th>
        <th style="text-align:center">Amount</th>
        <th style="text-align:center">Type</th>
        <th style="text-align:center">Account #</th>
        <th>Created By</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach($this->transactions as $transaction) :
    ?>
        <tr>
          <td style="text-align:center"><?php echo $transaction->ts; ?></td>
          <td style="text-align:center">R<?php echo $this->centsToRands((int)$transaction->amount); ?></td>
          <td style="text-align:center"><?php echo $transaction->transaction_type; ?></td>
          <td style="text-align:center"><?php echo $transaction->account_number; ?></td>
          <td><?php echo $transaction->created_by; ?></td>
        </tr>
    <?php
      endforeach;
    ?>
    </tbody>
  </table>

  <?php
    endif;
  ?>
</form>
</div>
<div class="row-fluid" style="text-align: center; border-top: 0px">
    <?php echo @$this->pagination->getPagesLinks(); ?>
</div>

</div>


<script type="text/javascript">
jQuery.noConflict();

(function ($) {
    $(function () {
        $('#newtransaction').on('submit', function (event) {
            var accountnumber = $("#account_id").val(),
                accountid = $("#memberid option:selected").attr("data-accountid");
            
            if (accountnumber === accountid) {
                return true;
            }
            else {
                alert('The Account Number(' +accountnumber+') does not match with the Account Holder('+accountid+')');
                
                return false;
            }
        });
    });
}(jQuery));
</script>
