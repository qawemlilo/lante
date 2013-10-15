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
$document->addStyleDeclaration($style);
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
        The calculation below assist you to obtain accurate values to either sell or buy your shares. Please note we will only process your transaction after a match is made and communication will be sent to you using your preferred method of notification.
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
              I Want To Buy Shares <input type="checkbox" id="buyshares" value="" class="pull-right">
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr>
            <td>
                
              <form class="pdetails">

                <div class="control-group" style="background-color:#fd7800; color:#fff; padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="name" style="width:180px;">Cash Amount Available</label>
                  <div class="controls">
                    <strong>R<?php if($this->member->balance) echo $this->centsToRands($this->member->balance); else echo '0.00' ?></strong>
                  </div>
                </div>
                                
                <div class="control-group">
                  <label class="control-label" for="companyid">Select Company:</label>
                  <div class="controls">
                    <?php echo $this->companiesDropdown; ?>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="num_shares">Number of Shares:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="num_shares" name="num_shares" required="" />
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="bidding_rands">Bidding Price:</label>
                  <div class="controls">
                    <div class="input-prepend input-append">
                        <span class="add-on">R</span>
                        <input class="span2" id="bidding_rands" placeholder="Rands" name="rands" required="" type="text">
                        <span class="add-on">.</span>
                        <input class="span2" id="bidding_cents" placeholder="Cents" name="cents" maxlength="2" required="" type="text">
                    </div>
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
                  <label class="control-label" for="security_fee">Security Fee:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="security_fee">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="security_fee">Investment Charge:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="investment_charge">&nbsp;</div>
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
              I want To Sell My Shares <input type="checkbox" id="buyshares" value="" class="pull-right">
            </th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              

            </td>
          </tr>
        </tbody>         
      </table>
      
    </div>
  </div>
</div>

<script type="text/javascript">
jQuery.noConflict();

(function ($) {
    $(function () {
        var cents = $("#bidding_cents"), 
            rands = $("#bidding_rands"),
            shares = $("#num_shares"),
            company = $("#companyid"),
            total = 0;
        
        cents.on('focus', function (e) {
            if (!company.val()) {
                company.focus();
            }
            else if (!shares.val()) {
                shares.focus();
            }
            else if (!rands.val()) {
                rands.focus();
            }
        })
        /*
        .on('keyup', function (e) {
            var c = parseInt(cents.val(), 10);
            var r = parseInt(rands.val(), 10) * 100;
            var shareprice = $("#companyid option:selected").attr("data-shareprice");
            
            total = c + r;
            
            

        })*/
        .on('keyup', function (e) {
            var c = parseInt(cents.val() || 0, 10);
            var r = parseInt(rands.val() || 0, 10) * 100;
            var shareprice = $("#companyid option:selected").attr("data-shareprice");
            var biddingprice = c + r;
            var numshares = parseInt(shares.val() || 0, 10);
            
            shareprice = parseInt(shareprice || 0, 10);

            if (!shareprice || !biddingprice || !numshares) {
                return false;
            }
            
            if (!verifyBiddingPrice(shareprice, biddingprice)) {
                alert('You Bidding Price is either too high or too low');
                return rands.focus();
            }
            
            updateUI(shareprice, biddingprice, numshares);
        });
        
        rands.on('focus', function (e) {
            if (!company.val()) {
                company.focus();
            }
            else if (!shares.val()) {
                shares.focus();
            }
        })        
        .on('keyup', function (e) {
            var c = parseInt(cents.val() || 0, 10);
            var r = parseInt(rands.val() || 0, 10) * 100;
            var shareprice = $("#companyid option:selected").attr("data-shareprice");
            var biddingprice = c + r;
            var numshares = parseInt(shares.val() || 0, 10);
            
            shareprice = parseInt(shareprice || 0, 10);

            if (!shareprice || !biddingprice || !numshares) {
                return false;
            }
            
            if (!verifyBiddingPrice(shareprice, biddingprice)) {
                alert('You Bidding Price is either too high or too low');
                return rands.focus();
            }
            
            updateUI(shareprice, biddingprice, numshares);
        });
        
        shares.on('focus', function (e) {
            if (!company.val()) {
                company.focus();
            }
        });
        
        function centsToRands(cents) {
            var rands = parseFloat(Math.round(cents / 100)).toFixed(2);
            
            return 'R ' + rands;
        }
        
        
        function updateUI(shareprice, biddingprice, numshares) {
            var bidValue, 
                investmentCharge, 
                transactionFee = 0, 
                securityFee = 0;
                securityFeeDiv = $("#security_fee");
                bidValueDiv = $("#bid_value"), 
                investmentChargeDiv = $("#investment_charge"), 
                transactionFeeDiv = $("#transaction_fee");
            
            bidValue = shareprice * numshares;
            investmentCharge = bidValue + transactionFee;
            
            securityFeeDiv.html(centsToRands(securityFee));
            transactionFeeDiv.html(centsToRands(transactionFee));
            bidValueDiv.html(centsToRands(bidValue));
            investmentChargeDiv.html(centsToRands(investmentCharge));
        }

        
        function verifyBiddingPrice(shareprice, biddingprice) {
            var max, min, diff;
            
            shareprice = parseInt(shareprice || 0, 10);
            diff = shareprice * 0.15;
            max = shareprice + diff;
            min = shareprice - diff;
            
            if (biddingprice > max || biddingprice < min) {
                return false;    
            }
            else {
                return true;
            }
        }
    });
}(jQuery));
</script>
