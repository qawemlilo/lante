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
        <span>Buy / Sell Shares</span>
      </div>
    </div>
  </div>
  
  <div class="row-fluid">
  <table class="table table-bordered">
   <thead>
    <tr>
      <th>
        Buy-Sell Shares
      </th>
    </tr>
  </thead>
  
  <tbody style="background-color:#f5f5f5;">
    <tr>
      <td>
        The calculation below assist you to obtain accurate values to either sell or buy your shares. Please note we will only process your transaction after a match is made, thereafter communication will be sent to you via email. Please note that the minimum total investment is R500.
      </td>
    </tr>
  </tbody>
 </table>
 </div>
 
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <input type="checkbox" id="buyshares" value="buyshares" style="margin:0px;"> I Want To Buy Shares 
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr>
            <td>
                
              <form class="pdetails" name="buysharesform" id="buysharesform" action="index.php?option=com_otc&task=tradebuy.buyshares" method="post" >
                
                <div class="control-group" style="background-color:#fd7800; color:#fff; padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="name" style="width:180px;">Cash Amount Available</label>
                  <div class="controls">
                    <strong>
                      R<?php 
                          if($this->member->pendingbalance) echo $this->centsToRands($this->member->pendingbalance);  
                          elseif(!$this->member->pendingbalance && $this->member->balance) echo $this->centsToRands($this->member->balance); 
                          else echo '0.00'; 
                      ?>
                    </strong>
                  </div>
                </div>

                <?php echo JHtml::_('form.token'); ?>
                <input type="hidden" name="memberid" value="<?php echo $this->member->id; ?>" />
                <input type="hidden" name="userid" value="<?php echo $this->member->userid; ?>" />
                <input type="hidden" name="share_price" id="share_price" value="" />
                <input type="hidden" name="company_name" id="company_name" value="" />
                                
                <div class="control-group">
                  <label class="control-label" for="companyid">Select Company:</label>
                  <div class="controls">
                    <?php echo $this->companiesList('companyid', 'companyid'); ?> &nbsp;
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="num_shares">Number of Shares:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="num_shares" name="num_shares" required="" autocomplete="off" />
                  </div>
                </div>
                
                <div class="control-group" style="padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="bidding_rands">Bidding Price:</label>
                  <div class="controls">
                    <div class="input-prepend input-append" style="width:400px">
                        <span class="add-on">R</span>
                        <input class="span2" id="bidding_rands" placeholder="Rands" name="rands" required="" type="text" autocomplete="off">
                        <span class="add-on">.</span>
                        <input class="span2" id="bidding_cents" placeholder="Cents" name="cents" maxlength="2" required="" type="text" autocomplete="off">
                    </div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="expiry_date">Expiry Date:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="expiry_date" name="expiry_date" required="" autocomplete="off" />
                  </div>
                </div>
                
                <hr style="margin: 5px 0px; height:5px; background-color:#fd7800;" />
                
                <div class="control-group">
                  <label class="control-label" for="bid_value">Bid Value:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="bid_value">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="transaction_fee">Transaction Fee:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="transaction_fee">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="security_fee">Securities Tax:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="security_fee">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group" style="background-color:#fd7800; color:#fff; padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="investment_charge">Total Investment:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="investment_charge">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group" style="padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="submit">&nbsp;</label>
                  <div class="controls">
                    <input value="Process Purchase" class="btn btn-primary" style="font-weight:bold; color:#fff" type="submit" name="submit" />  &nbsp;
                  </div>
                </div>
                
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <input type="checkbox" id="sellshares" value="sellshares" style="margin:0px;"> I want To Sell My Shares 
            </th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              <form class="pdetails" name="sellsharesform" id="sellsharesform" action="index.php?option=com_otc&task=tradesell.sellshares" method="post" >
              
                <div class="control-group" style="background-color:#fd7800; color:#fff; padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="name" style="width:180px;">&nbsp;Total Shares Available</label>
                  <div class="controls">
                    <strong id="mytotalshares">&nbsp;</strong>
                  </div>
                </div>
                                
                <?php echo JHtml::_('form.token'); ?>
                <input type="hidden" name="memberid" value="<?php echo $this->member->id; ?>" />
                <input type="hidden" name="userid" value="<?php echo $this->member->userid; ?>" />
                <input type="hidden" name="share_price" id="shareprice" value="" />
                <input type="hidden" name="company_name" id="companyname" value="" />
                
                <div class="control-group">
                  <label class="control-label" for="companyid">Select Company:</label>
                  <div class="controls">
                    <?php echo $this->companiesList('mycompanyid', 'companyid'); ?> &nbsp;
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="numshares">Number of Shares:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="numshares" name="num_shares" required="" autocomplete="off" />
                  </div>
                </div>
                
                
                <div class="control-group" style="padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="trading_rands">Selling Price:</label>
                  <div class="controls">
                    <div class="input-prepend input-append" style="width:400px">
                        <span class="add-on">R</span>
                        <input class="span2" id="trading_rands" placeholder="Rands" name="rands" autocomplete="off" required="" type="text">
                        <span class="add-on">.</span>
                        <input class="span2" id="trading_cents" placeholder="Cents" autocomplete="off" name="cents" maxlength="2" required="" type="text">
                    </div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="expirydate">Expiry Date:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="expirydate" name="expiry_date" required="" autocomplete="off" />
                  </div>
                </div>
                
                <hr style="margin: 5px 0px; height:5px; background-color:#fd7800;" />
                
                <div class="control-group">
                  <label class="control-label" for="subtotal">Sell Value:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="subtotal">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="transactionfee">Transaction Fee:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="transactionfee">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="securityfee">Securities Tax:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="securityfee">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group" style="background-color:#fd7800; color:#fff; padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="payout">Total Payout:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="payout">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group" style="padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="submit">&nbsp;</label>
                  <div class="controls">
                    <input value="Process Sale" class="btn btn-primary" style="font-weight:bold; color:#fff" type="submit" name="submit" />  &nbsp;
                  </div>
                </div>
                
              </form>              
            </td>
          </tr>
        </tbody>         
      </table>
      
    </div>
  </div>
</div>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/script.js'; ?>"></script>
<script>
(function ($) {
	$('#mycompanyid').on('change', function (event) {
	
		
		jQuery(function($$){
		 // alert("called for ajax.....");
		 		var companyid = $("#mycompanyid option:selected").val();
				//alert(companyid);
				$$.ajax({
							   
					   type: "POST",
					   url: "index.php?option=com_otc&task=tradesell.getusershares",
					   data: "companyid="+companyid,
					   
					   beforeSend: function () {
							document.getElementById("mytotalshares").innerHTML = "Fetching Results...";	
					   },
					   success: function(msg){
	//					 alert( "Data Saved: " + msg );
						 document.getElementById("mytotalshares").innerHTML = msg;
					   }
			 });
	 
		 });
		 return false;
	});
}(jQuery));
</script>