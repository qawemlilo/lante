<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
?>

<div class="row-fluid">
  <form class="form-horizontal" name="newcompany" id="newcompany" method="post" action="<?php echo $this->parseUrl('index.php?option=com_otc&task=companies.sellshares'); ?>">
    <fieldset style="border: 1px solid #ccc; padding: 20px;">

      <legend style="margin-bottom: 0px; width:180px;border: 1px solid #e5e5e5; text-align:center;padding: 0px 5px 0px 5px;">Sell Shares</legend>
      
      <!-- Text input-->
      <div class="control-group">
         <label class="control-label" for="companyid">Select Company:</label>
        <div class="controls">
          <?php echo $this->companiesList('mycompanyid', 'companyid'); ?>
        </div>
      </div>
      
      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="website">Available Shares</label>
        <div class="controls">
          <input id="availableshares" type="text"  value="" class="input-xlarge" readonly="readonly" />
        </div>
      </div>
      
  
      <!-- Text input-->
      <div class="control-group">
        <label class="control-label" for="website">Share Price</label>
        <div class="controls">
          <input id="shareprice" type="text"  class="input-xlarge" readonly="readonly" />
          <input name="selling_price" id="selling_price" type="hidden"  class="input-xlarge" />
          
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="num_shares">Number of shares to sell</label>
        <div class="controls">
          <input id="num_shares" name="num_shares" value="" class="input-xlarge" required="" type="text">
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label" for="expirydate">Expiry Date:</label>
        <div class="controls">
          <input value="" class="input-xlarge" type="text" id="expirydate" name="expiry_date" required="" />
        </div>
      </div>
      
      <?php echo JHtml::_('form.token'); ?>
      
      <!-- Button (Double) -->
      <div class="control-group">
        <label class="control-label" for="submit"></label>
        <div class="controls">
          <button id="submit" name="submit" class="btn btn-primary">Submit</button>
          <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=companies'); ?>" class="btn" type="button">
            Cancel
          </a>
        </div>
      </div>
    </fieldset>
  </form>
</div>

<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script type="text/javascript">
jQuery.noConflict();

(function ($) {
    $(function () {
        $( "#expirydate").datepicker({
            dateFormat: 'd M yy'
        });
        
        $('#mycompanyid').on('change', function (event) {
            var shares = $("#mycompanyid option:selected").attr("data-shares"),
                shareprice = $("#mycompanyid option:selected").attr("data-shareprice");
                
            $("#availableshares").val(shares);
            $("#selling_price").val(shareprice);
            $("#shareprice").val('R ' + (parseFloat(shareprice/100).toFixed(2)));
        });
    });
}(jQuery));
</script>
