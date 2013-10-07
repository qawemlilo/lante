<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="row-fluid">
<form class="form-horizontal" name="newtransaction" id="newtransaction" method="post" action="<?php echo $this->parseUrl('index.php?option=com_otc&task=bank.transaction'); ?>">
<fieldset style="border: 1px solid #ccc; padding: 20px;">

<legend style="margin-bottom: 0px; width:180px;border: 1px solid #e5e5e5; text-align:center;padding: 0px 5px 0px 5px;">New Transaction</legend>

<h4>Transaction Details</h4>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="account_id">Account Number</label>
  <div class="controls">
    <input id="account_id" name="account_id" placeholder="Account Number" class="input-xlarge" required="" maxlength="13" value="" type="text" /> 
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="memberid">Account Holder</label>
  <div class="controls">                     
    <?php echo $this->dropdown; ?>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Deposited Amount</label>
  <div class="controls">
    <div class="input-prepend input-append">
        <span class="add-on">R</span>
        <input class="span4" id="rands" placeholder="Rands" name="rands" required="" maxlength="7" type="text">
        <span class="add-on">.</span>
        <input class="span2" id="cents" placeholder="Cents" name="cents"  required="" maxlength="2" type="text">
    </div>
  </div>
</div>

<input type="hidden" name="transaction_type" value="deposit">
<?php echo JHtml::_('form.token'); ?>

<!-- Button (Double) -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
    <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=admin&layout=transactions'); ?>" class="btn" type="button">
      Cancel
    </a>
  </div>
</div>

    </fieldset>
  </form>
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
