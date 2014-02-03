jQuery.noConflict();

(function ($) {
    accounting.settings = {
    	currency: {
    		symbol : "R",   // default currency symbol is '$'
    		format: "%s %v", // controls output: %s = symbol, %v = value/number (can be object: see below)
    		decimal : ".",  // decimal point separator
    		thousand: ",",  // thousands separator
    		precision : 2   // decimal places
    	},
    	number: {
    		precision : 0,  // default precision on numbers is 0
    		thousand: ",",
    		decimal : "."
    	}
    };
    
    $(function () {
    
/*
           Global variables
----------------------------------------------------------------------
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
---------------------------------------------------------------------------
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

        $( "#expirydate, #expiry_date").datepicker({
            dateFormat: 'd M yy',
            minDate: 0,
            maxDate: +30
        });
        
        sellshares.on('click', function (e) {
            if (buyshares.prop('checked')) {
                buyshares.prop('checked', false);
                switchForms('buysharesform', true);
            }

            if (this.checked) {
                switchForms('sellsharesform', false);
            }
            else {
                switchForms('sellsharesform', true);
            }
             
            return true;
        });
        
        buyshares.on('click', function (e) {

            if (sellshares.prop('checked')) {
                 sellshares.prop('checked', false);
                 switchForms('sellsharesform', true);
            }
             
            if (this.checked) {
                switchForms('buysharesform', false);
            }
            else {
                switchForms('buysharesform', true);
            }
             
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

            updateUI(biddingprice, numshares);
        }
        
        
        function calcSale(e) {
            var c = parseInt(tcents.val() || 0, 10);
            var r = (parseInt(trands.val() || 0, 10) * 100);
            var sellingprice = c + r;
            var numberofshares = parseInt(numshares.val() || 0, 10);
            var payout = 0;
            var securityTax = 0;
            var transactionFee;
            var sellValue = 0;
            
            var sellValueDiv = $("#subtotal");
            var securityTaxDiv = $("#securityfee");
            var transactionFeeDiv = $("#transactionfee");
            var payoutDiv = $("#payout");
            
            sellValue = sellingprice * numberofshares;
            transactionFee = calcTransactionFee(sellValue);
            payout = sellValue - (transactionFee + securityTax);

            sellValueDiv.html(centsToRands(sellValue) + " &nbsp;");
            securityTaxDiv.html(centsToRands(securityTax) + " &nbsp;");
            transactionFeeDiv.html(centsToRands(transactionFee) + " &nbsp;");
            payoutDiv.html(centsToRands(payout) + " &nbsp;");
        }
        
        
        function isPositiveNum(num) {
            var result = true;
            
            num = parseInt(num, 10);
            
            if (num < 0) {
                result = false;
            }
            
            $result;
        }
        
        
        function calcTransactionFee(sellValue) {
            var transactionRate = 0.0175,
                fee = sellValue * transactionRate;
            
            return Math.round(fee);
        }
        
        
        function centsToRands(cents) {
            var rands = parseFloat(cents / 100).toFixed(2);
            
            return  accounting.formatMoney(rands);
        }
        
        
        function updateUI(shareprice, numshares) {
            var bidValue, 
                investmentCharge, 
                transactionFee = 0, 
                security = 0.0025,
                securityFee,
                securityFeeDiv = $("#security_fee");
                bidValueDiv = $("#bid_value"), 
                investmentChargeDiv = $("#investment_charge"), 
                transactionFeeDiv = $("#transaction_fee");
            
            bidValue = shareprice * numshares;
            securityFee = Math.round(bidValue * security);
            investmentCharge = bidValue + transactionFee + securityFee;
            
            
            securityFeeDiv.html(centsToRands(securityFee) + " &nbsp;");
            transactionFeeDiv.html(centsToRands(transactionFee) + " &nbsp;");
            bidValueDiv.html(centsToRands(bidValue) + " &nbsp;");
            investmentChargeDiv.html(centsToRands(investmentCharge) + " &nbsp;");
        }

        
        function invalidBid(shareprice, biddingprice) {
            var max, min, diff;
            
            shareprice = parseInt(shareprice || 0, 10);
            diff = shareprice * 0.15;
            
            max = shareprice + Math.floor(diff);
            min = shareprice - Math.ceil(diff);
            
            if (biddingprice > max || biddingprice < min) {
                return {max: max, min: min};    
            }
            else {
                return false;
            }
        }
            
            
/*
        Buy shares actions
------------------------------------------------------------------------------------------------------------------------
*/
        
        company.on('change', function (e) {
            var shareprice = $("#companyid option:selected").attr("data-shareprice"), 
                companyname = $("#companyid option:selected").text();
            
            cents.val('');
            rands.val('');
            shares.val('');
            
            $("#share_price").val(shareprice);
            $("#company_name").val(companyname);
        });
        
        shares.on('focus', function (e) {
            if (!company.val()) {
                company.focus();
            }
        })
        .on('keyup', function (e) {
            var c = parseInt(cents.val(), 10);
            var r = parseInt(rands.val(), 10) * 100;
            var biddingprice = c + r;
            
            if (biddingprice) {
                calc(e);
            }
        });
        
        
        rands.on('focus', function (e) {
            if (!company.val()) {
                company.focus();
            }
            else if (!shares.val()) {
                shares.focus();
            }
        })
        .on('keyup', calc);
        
        
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
        .on('keyup', calc);
        
        
        buysharesform.on('submit', function (e) {
            var c = parseInt(cents.val(), 10),
                r = parseInt(rands.val(), 10) * 100,
                shareprice = $("#companyid option:selected").attr("data-shareprice"),
                biddingprice = c + r,
                
                invalid = invalidBid(shareprice, biddingprice);
            
            if (invalid) {
                alert("You Bidding Price is either too high or too low. Your Bidding Price should be between " + centsToRands(invalid.min) + ' and ' + centsToRands(invalid.max));
            }

            return !invalid;            
        });
        
        
/*
       Sell share acions
-------------------------------------------------------------------------------------------------------------------------
*/
     
        mycompany.on('change', function (e) {
            var shareprice = $("#mycompanyid option:selected").attr("data-shareprice"),
                companyname = $("#mycompanyid option:selected").text();
            
            tcents.val('');
            trands.val('');
            numshares.val('');
            
            $("#shareprice").val(shareprice);
            $("#companyname").val(companyname);
        });

        numshares.on('focus', function (e) {
            if (!mycompany.val()) {
                mycompany.focus();
            }
        })
        .on('keyup', function (e) {
            if (trands.val()) {
                calcSale(e);
            }
        });

        trands.on('focus', function (e) {
            if (!mycompany.val()) {
                mycompany.focus();
            }
            else if (!numshares.val()) {
                numshares.focus();
            }
        })
        .on('keyup', calcSale); 

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
        .on('keyup', calcSale);  

        sellsharesform.on('submit', function (e) {
            var c = parseInt(tcents.val() || 0, 10),
                r = parseInt(trands.val() || 0, 10) * 100,
                shareprice = $("#mycompanyid option:selected").attr("data-shareprice"),
                sellingprice = c + r,
                invalid = invalidBid(shareprice, sellingprice);
            
            if (invalid) {
                alert("You Selling Price is either too high or too low. Your Selling Price should be between " + centsToRands(invalid.min) + ' and ' + centsToRands(invalid.max));
            }

            return !invalid;            
        });
/*
        Actions triggered immediatly
------------------------------------------------------------------------------------
*/      
        
        switchForms('buysharesform', true);
        switchForms('sellsharesform', true);
     
    });
}(jQuery));
