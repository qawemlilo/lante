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
              <input type="checkbox" id="buyshares" value="buyshares" style="margin:0px;"> I Want To Buy Shares 
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr>
            <td>
                
              <form class="pdetails" name="buysharesform" id="buysharesform" action="" method="post" >

                <div class="control-group" style="background-color:#fd7800; color:#fff; padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="name" style="width:180px;">Cash Amount Available</label>
                  <div class="controls">
                    <strong>R<?php if($this->member->balance) echo $this->centsToRands($this->member->balance); else echo '0.00' ?></strong>
                  </div>
                </div>
                                
                <div class="control-group">
                  <label class="control-label" for="companyid">Select Company:</label>
                  <div class="controls">
                    <?php echo $this->companiesList('companyid', 'companyid'); ?> &nbsp;
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="num_shares">Number of Shares:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="num_shares" name="num_shares" required="" />
                  </div>
                </div>
                
                
                <div class="control-group" style="padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="bidding_rands">Bidding Price:</label>
                  <div class="controls">
                    <div class="input-prepend input-append" style="width:400px">
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
                
                <div class="control-group" style="background-color:#fd7800; color:#fff; padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="investment_charge">Investment Charge:</label>
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
              <form class="pdetails" name="sellsharesform" id="sellsharesform" action="" method="post" >
              
                <div class="control-group">
                  <label class="control-label" for="companyid">Select Company:</label>
                  <div class="controls">
                    <?php echo $this->companiesList('mycompanyid', 'companyid'); ?> &nbsp;
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="numshares">Number of Shares:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="numshares" name="num_shares" required="" />
                  </div>
                </div>
                
                
                <div class="control-group" style="padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="trading_rands">Trading Price:</label>
                  <div class="controls">
                    <div class="input-prepend input-append" style="width:400px">
                        <span class="add-on">R</span>
                        <input class="span2" id="trading_rands" placeholder="Rands" name="rands" required="" type="text">
                        <span class="add-on">.</span>
                        <input class="span2" id="trading_cents" placeholder="Cents" name="cents" maxlength="2" required="" type="text">
                    </div>
                  </div>
                </div>
                
                <hr style="margin: 5px 0px; height:5px; background-color:#fd7800;" />
                
                <div class="control-group">
                  <label class="control-label" for="subtotal">Sub Total:</label>
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
                  <label class="control-label" for="securityfee">Security Fee:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="securityfee">&nbsp;</div>
                  </div>
                </div>
                
                <div class="control-group" style="background-color:#fd7800; color:#fff; padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="security_fee">Total Payout:</label>
                  <div class="controls">
                    <div style="width: 100%; font-weight:bold;font-size:12px; padding-top:5px; padding-bottom: 5px" id="investment_charge">&nbsp;</div>
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

<script type="text/javascript">
jQuery.noConflict();

(function ($) {
    $(function () {
        /*
           Global variables
        */  
        
        var cents = $("#bidding_cents"), 
            rands = $("#bidding_rands"),
            shares = $("#num_shares"),
            company = $("#companyid"),
            buysharesform = $("#buysharesform"),
            tcents = $("#trading_cents"), 
            trands = $("#trading_rands"),
            numshares = $("#numshares"),
            mycompany = $("#mycompanyid"),
            sellsharesform = $("#sellsharesform"),
            sellshares = $("#sellshares"),
            buyshares = $("#buyshares"),
            total = 0;
            
         
        /*
           Helper functions
        */ 
        
        function switchForms(formname, flag) {
            var form = document.forms[formname],
                i;
                
            for(i = 0; i < form.elements.length; i++) {
                form.elements[i].disabled = flag;
            }
            
            // if disabled is false - meaning the form is active
            if (!flag) {
                form.reset();
            }
        }

        
        
        sellshares.on('click', function (e) {
             if (buyshares.prop('checked')) {
                 buyshares.prop('checked', false);
                 switchForms('buysharesform', true);
             }

             switchForms('sellsharesform', false);
             
             return true;
        });
        
        buyshares.on('click', function (e) {

             if (sellshares.prop('checked')) {
                 sellshares.prop('checked', false);
                 switchForms('sellsharesform', true);
             }
             
             switchForms('buysharesform', false);
             
             return true;
        });
        
               
        function calc(e) {
            var c = parseInt(cents.val() || 0, 10);
            var r = parseInt(rands.val() || 0, 10) * 100;
            var shareprice = $("#companyid option:selected").attr("data-shareprice");
            var biddingprice = c + r;
            var numshares = parseInt(shares.val() || 0, 10);
            
            shareprice = parseInt(shareprice || 0, 10);

            if (!shareprice || !numshares) {
                return false;
            }

            updateUI(shareprice, numshares);
        }
        
        
        function centsToRands(cents) {
            var rands = parseFloat(cents / 100).toFixed(2);
            
            return "R " + rands + " &nbsp;";
        }
        
        
        function updateUI(shareprice, numshares) {
            var bidValue, 
                investmentCharge, 
                transactionFee = 0, 
                security = 0.25,
                securityFee,
                securityFeeDiv = $("#security_fee");
                bidValueDiv = $("#bid_value"), 
                investmentChargeDiv = $("#investment_charge"), 
                transactionFeeDiv = $("#transaction_fee");
            
            bidValue = shareprice * numshares;
            securityFee = bidValue * security;
            investmentCharge = bidValue + transactionFee + securityFee;
            
            
            securityFeeDiv.html(centsToRands(securityFee));
            transactionFeeDiv.html(centsToRands(transactionFee));
            bidValueDiv.html(centsToRands(bidValue));
            investmentChargeDiv.html(centsToRands(investmentCharge));
        }

        
        function invalidBid(shareprice, biddingprice) {
            var max, min, diff;
            
            shareprice = parseInt(shareprice || 0, 10);
            diff = shareprice * 0.15;
            max = shareprice + diff;
            min = shareprice - diff;
            
            if (biddingprice > max || biddingprice < min) {
                return {max: max, min: min};    
            }
            else {
                return false;
            }
        }
            
            
        
        company.on('change', function (e) {
            cents.val('');
            rands.val('');
            shares.val('');
        });
        
        shares.on('focus', function (e) {
            if (!company.val()) {
                company.focus();
            }
        })
        .on('keyup', calc);
        
        
        rands.on('focus', function (e) {
            if (!company.val()) {
                company.focus();
            }
            else if (!shares.val()) {
                shares.focus();
            }
        })        
        .on('blur', function (e) {
            var c = parseInt(cents.val() || 0, 10),
                r = parseInt(rands.val() || 0, 10) * 100,
                shareprice = $("#companyid option:selected").attr("data-shareprice"),
                biddingprice = c + r,
                
                invalid = invalidBid(shareprice, biddingprice);
            
            if (invalid && shares.val()) {
                alert("You Bidding Price is either too high or too low.\nYour Bidding Price should be between " + centsToRands(invalid.min) + ' and ' + centsToRands(invalid.max));
            }        
        });
        
        
        cents.on('focus', function (e) {
            if (!company.val()) {
                company.focus();
            }
            else {
                if (!shares.val()) {
                  shares.focus();
                }
                else if (!rands.val()) {
                  rands.focus();
                }
            }
        })
        .on('blur', function (e) {
            var c = parseInt(cents.val() || 0, 10),
                r = parseInt(rands.val() || 0, 10) * 100,
                shareprice = $("#companyid option:selected").attr("data-shareprice"),
                biddingprice = c + r,
                
                invalid = invalidBid(shareprice, biddingprice);
            
            if (invalid && r && shares.val()) {
                alert("You Bidding Price is either too high or too low.\nYour Bidding Price should be between " + centsToRands(invalid.min) + ' and ' + centsToRands(invalid.max));
            }                 
        });
        
        
        buysharesform.on("submit", function (e) {
            return false;
        });
        
        
        
        
            
        mycompany.on('change', function (e) {
            tcents.val('');
            trands.val('');
            numshares.val('');
        });

        numshares.on('focus', function (e) {
            if (!mycompany.val()) {
                mycompany.focus();
            }
        });

        trands.on('focus', function (e) {
            if (!mycompany.val()) {
                mycompany.focus();
            }
            else if (!numshares.val()) {
                numshares.focus();
            }
        });

        tcents.on('focus', function (e) {
            if (!mycompany.val()) {
                mycompany.focus();
            }
            else {
                if (!numshares.val()) {
                  numshares.focus();
                }
                else if (!trands.val()) {
                  trands.focus();
                }
            }
        })        
            
        sellsharesform.on("submit", function (e) {
            return false;
        });
        
        switchForms('buysharesform', true);
        switchForms('sellsharesform', true);
     
    });
}(jQuery));
</script>
