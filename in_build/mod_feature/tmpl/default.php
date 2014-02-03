<?php 
defined('_JEXEC') or die('Restricted access'); // no direct access 

$user =& JFactory::getUser();

    function marketStatus() {
        $today = getdate();
        $status = '<span style="color:green">MARKET OPEN</span>';
        
        $hours = $today['hours'];
        $day = $today['wday'];
        
        if ($hours >= 17 || $hours < 9) {
            $status = '<span style="color:red">MARKET CLOSED</span>';   
        } 
        
        if ($day === 6 || $day === 0) {
            $status = '<span style="color:red">MARKET CLOSED</span>'; 
        }
        
        return $status;
        
    }

    function centsToRands($cents) {
        return number_format($cents/100, 2);
    }
    
    

    function formatTime($date) {
        $mydate = new DateTime($date);
        $dateString = $mydate->format("d M y H:i");
        
        return $dateString;
    }
    
    
    function myFormat($price) {
        $total = (int)$price;
        $formatted = $total;

        if ($total > 0) {
           $formatted = '<span style="color:green">'.$total.'</span>';
        }
        if ($total < 0) {
           $formatted = '<span style="color:red">'.$total.'</span>';
        }
        
        return $formatted;
    }
    
    
    function calcChange($current, $prev) {
        $change = 0;
        $current = (int)$current;
        $prev = (int)$prev;
        
        if ($current && $prev) {
            $change = ($current - $prev);
        }
        if ($change > 0) {
           $change = '<span style="color:green">'.$change.'</span>';
        }
        if ($change < 0) {
           $change = '<span style="color:red">'.$change.'</span>';
        }
        
        return $change;
    }
    
    
    
    
    function getTime($ts, $lastUpdate) {
        
        if (!$lastUpdate) {
            return formatTime($ts);
        }
        else {
            return formatTime($lastUpdate); 
        }
    }    
    
    
    
    
    function calcPChange($current, $prev) {
        $change = 0;
        $current = (int)$current;
        $prev = (int)$prev;
        
        if ($current && $prev) {
            $change = ($current - $prev);
        }
        
        $change = round(($change / $current) * 100, 2);
        
        if ($change > 0) {
           $change = '<span style="color:green">'.$change.'%</span>';
        }
        elseif ($change < 0) {
           $change = '<span style="color:red">'.$change.'%</span>';
        }
        else {
            $change = '<span>'.$change.'%</span>';
        } 
               
        return $change;
    }
    
    
    function parseUrl($url) {
        return JRoute::_($url);
    }
?>
<style>
	.listings td.borders {
		border-right:1px solid #fd7800;
		text-align:center;
	}
	.green-text {
		color:#30991c;
	} 
	.red-text {
		color:#ff0000;
	}
</style>
<div class="row">


    	<div>
    <?php 
    	if ($user->guest) {
  	?>
    
    
    <div class="span6">
  
    <div id="q-slides" style="margin-left: 10px;">
      <img border="0" alt="LanteOTC" src="<?php echo JURI::base(); ?>/images/Lante-Slider3.png" class="q-active">
      <img border="0" alt="LanteOTC" src="<?php echo JURI::base(); ?>/images/Lante-Slider1.jpg">
      <img border="0" alt="LanteOTC" src="<?php echo JURI::base(); ?>/images/Lante-Slider2.jpg">
      <img border="0" alt="LanteOTC" src="<?php echo JURI::base(); ?>/images/Lante-Slider4.jpg">
    </div>
    
    
    <p style="color: #fd7800; margin-left: 10px;"><strong>LanteOTC</strong> is a market place that <strong>connects Investors with Small-Medium Businesses</strong> in South Africa. LanteOTC is the most efficient method to Support small business. LanteOTC system is easy to use and free, sign-up now.</p>
    

  <table class="table table-striped listings" style="margin-left: 10px;">
              <thead>
                <tr>
                  <th colspan="5">Top performers</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="listings-header">Company</td>
                  <td class="listings-header" style="text-align:center">(c)Last</td>
                  <td class="listings-header" style="text-align:center">Change</td>
                  <td class="listings-header" style="text-align:center">%Change</td>
                  <td class="listings-header" style="text-align:center">Time</td>
                </tr>
                
                <?php
                  foreach($companies as $company) :
                ?>
                <tr>
                  <td><a href="<?php echo parseUrl('index.php?option=com_otc&view=company&id=' .$company->id); ?>"><?php echo $company->name; ?></a></td>
                  <td class="text-center" style="text-align:center"><?php echo $company->share_price; ?></td>
                  <td class="text-center" style="text-align:center"><?php echo calcChange($company->share_price, $company->prev_price); ?></td>
                  <td class="text-center" style="text-align:center"><?php echo calcPChange($company->share_price, $company->prev_price); ?></td>
                  <td class="text-center" style="text-align:center"><?php echo getTime($company->ts, $company->last_updated); ?></td>
                </tr>
               <?php
                 endforeach;
               ?>
                <tr>
                  <td class="listings-header"><?php echo marketStatus(); ?></td>
                  <td colspan="4"><small>* Operating from: 09:00 to 17:00 Weekdays, excluding holidays</small></td>
                </tr>
              </tbody>
            </table>
            <p></p>
  </div>
    
   <div class="span6">
  <?php 
    if ($user->guest) {
  ?>
    <form style="padding-left: 40px; background-color: #F0F0F0; margin-right: 10px;" autocomplete="off" id="custom-reg-form" class="well" action="<?php echo parseUrl('index.php/component/users/?task=registration.register'); ?>" method="post">
    <h1 style="color: #fd7800; font-size: 2em;">Sign-up for FREE as an INVESTOR</h1>
    <div class="controls controls-row">
        <input type="text" placeholder="Full Name" id="jform_name" name="jform[name]" class="span3" required="" />
        <input type="text" placeholder="Username" class="span2" id="jform_username" name="jform[username]">
    </div>
            
    <div class="controls">
        <input type="email" pattern="[^ @]*@[^ @]*" placeholder="Email Address"  name="jform[email1]" id="jform_email1" class="span5" required="" >
    </div>

    <div class="controls">
        <input type="text" placeholder="Re-enter Email Address" class="span5" id="jform_email2" name="jform[email2]" required="" >
    </div>
            
    <div class="controls">
        <input type="password" placeholder="Password" class="span5" autocomplete="off" value="" id="jform_password1" name="jform[password1]" required="">
        <input type="text" class="span5" autocomplete="off" value="Password" id="fake_password1" style="display:none">
    </div>
            
    <div class="controls">
        <input type="password" placeholder="Re-enter Password" class="span5" autocomplete="off" value="" id="jform_password2" name="jform[password2]" required="">
        <input type="text" class="span5" autocomplete="off" value="Re-enter Password" id="fake_password2" style="display:none">
    </div>
    
    <p style="font-size: 12px; margin-top: 10px;">By clicking Sign Up, you agree to our <a href="http://www.lanteotc.co.za/index.php/terms-conditions" target="_blannk">Terms & Conditions</a></p>
            
    <p><button  class="btn btn-large btn-warning"  type="submit" style="padding-left: 50px; padding-right: 50px; background-color: #fd7800; background-image: -moz-linear-gradient(center top , #F89406, #fd7800)"><strong>Sign Up</strong></button></p>
    
    <input type="hidden" value="com_users" name="option">
    <input type="hidden" value="registration.register" name="task">
    <?php echo JHtml::_('form.token');?>
    </form>
  <?php
    }
    else {
  ?>
  <table class="table table-striped listings" style="width: 98%;">
              <thead>
                <tr>
                  <th colspan="5">Market Info</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="listings-header">&nbsp;</td>
                  <td class="listings-header" style="text-align:center">Today</td>
                  <td class="listings-header" style="text-align:center">Previous close</td>
                </tr>
                <tr>
                  <td>Price (c)</td>
                  <td style="text-align:center"><?php echo myFormat($summary->price["today"]); ?></td>
                  <td style="text-align:center"><?php echo myFormat($summary->price["prev"]); ?></td>
                </tr>
                <tr>
                  <td>Movement (c)</td>
                  <td style="text-align:center"><?php echo myFormat($summary->movement["today"]); ?></td>
                  <td style="text-align:center"><?php echo myFormat($summary->price["prev"]); ?></td>
                </tr>
                <tr>
                  <td>Movement (%)</td>
                  <td style="text-align:center"><?php echo myFormat($summary->movement["today"]); ?></td>
                  <td style="text-align:center"><?php echo myFormat($summary->price["prev"]); ?></td>
                </tr>
                <tr>
                  <td>Value</td>
                  <td style="text-align:center"><?php echo myFormat($summary->value["today"]); ?></td>
                  <td style="text-align:center"><?php echo myFormat($summary->value["prev"]); ?></td>
                </tr>                
                <tr>
                  <td>No. of Trades</td>
                  <td style="text-align:center"><?php echo myFormat($summary->num_trades["today"]); ?></td>
                  <td style="text-align:center"><?php echo myFormat($summary->num_trades["prev"]); ?></td>
                </tr>
                <tr>
                  <td>Low Price (c)</td>
                  <td style="text-align:center"><?php echo myFormat($summary->lowest_price["today"]); ?></td>
                  <td style="text-align:center"><?php echo myFormat($summary->lowest_price["prev"]); ?></td>
                </tr>      
                <tr>
                  <td>High Price (c)</td>
                  <td style="text-align:center"><?php echo myFormat($summary->highest_price["today"]); ?></td>
                  <td style="text-align:center"><?php echo myFormat($summary->highest_price["prev"]); ?></td>
                </tr>  
              </tbody>
            </table>
    <?php
    }
    ?>   
    
    <div style="color: #fd7800;">
      <p>You can use LanteOTC to:</p>
      <ul>
        <li>Bring small businesses to life</li>
        <li>Buy preference shares from small-medium businesses</li>
        <li>Sell your shares</li>
        <li>Create jobs and stimulate economy</li>
        <li>View periodic audit and management reports</li>
        <li>Monitor and Evaluate progress of businesses</li>
        <li>Early stage investment platform</li>
      </ul>
    </div>
  </div> 
    
    <?php } else { 
					// echo 'User name: ' . $user->username . '<br />';
				  // echo 'Real name: ' . $user->name . '<br />';
				  // echo 'User ID  : ' . $user->id . '<br />';
				  
	if($savepayment) {
		echo "<div>" .$savepayment. "</div>";
	}

	?>
    <div >
    <div style="font-size:16px; padding:15px 15px 0px 0px;">Hi <b><?php echo $user->name; ?></b>, Welcome to LanteOTC! Where you can invest directly in small businesses</div>
    <br />
    
    <div>
    	<table width="100%" class="table table-striped listings" style="border:1px solid #fd7800;" border="0" cellpadding="0" cellspacing="0">
          <thead>
            <tr>
    	        <th colspan="7">My Investments</th>
            </tr>
          </thead>
          <tr>
          	<td style="background:#dfdfdf;" colspan="5"><?php echo "<div>Cash Amount available to buy: R" . centsToRands($member->pendingbalance) . "</div>"; ?></td>
            <td style="background:#dfdfdf;" colspan="2"><?php echo "<div>Account Number: " . $member->account_id . "</div>"; ?></td>
          </tr>
          <tr>
            <td class="listings-header borders">My stocks</td>
            <td class="listings-header borders">Shares</td>
            <td class="listings-header borders">Last(c)</td>
            <td class="listings-header borders">Buy Price(c)</td>
            <td class="listings-header borders">Growth</td>
            <td class="listings-header borders">Value(R)</td>
            <td class="listings-header borders">Date of buying</td>
          </tr>
          
          <?php foreach($investments as $investment) { 
		  	$growth = number_format((($investment->current_share_price - $investment->buying_price)/$investment->buying_price) * 100,2);
			$value = number_format($investment->num_shares * centsToRands($investment->current_share_price),2);
			
			$pdatetime = explode(' ',$investment->ts);
			$pdate = explode('-',$pdatetime[0]);
			$ptime = explode(':',$pdatetime[1]);
			
			//$purchase_date = date("n/j/Y H:i", mktime($ptime[0], $ptime[1], $ptime[2], $pdate[1], $pdate[2], $pdate[0]));
			$purchase_date = date("j M Y H:i", mktime($ptime[0], $ptime[1], $ptime[2], $pdate[1], $pdate[2], $pdate[0]));
			if($investment->num_shares) {
		  ?>
          <tr>
            <td class="borders"><a href="<?php echo parseUrl('index.php?option=com_otc&view=company&id=' . $investment->companyid);?>"><?php echo $investment->companyname; ?></a></td>
            <td class="borders"><?php echo $investment->num_shares; ?></td>
            <td class="borders"><?php echo $investment->current_share_price; ?></td>
            <td class="borders"><?php echo $investment->buying_price; ?></td>
            <td class="borders"><div <?php if($growth < 0) { ?> class="red-text" <?php } else { ?> class="green-text" <?php } ?> ><?php echo $growth; ?>%</div></td>
            <td class="borders"><?php echo $value; ?></td>
            <td class="borders"><?php echo $purchase_date; ?></td>
          </tr>
          <?php } } ?>
        </table>
    </div>
    
    <br />
    	<div>
    	<table width="100%" class="table table-striped listings" style="border:1px solid #fd7800;" border="0" cellpadding="0" cellspacing="0">
          <thead>
            <tr>
    	        <th colspan="2">Increase your buying balance in 3 simple options</th>
            </tr>
          </thead>
          <tr>
          	<td style="background:#dfdfdf;" colspan="2">The funds may take up-to 48 hours to reflect subject to clearing houses. Please note that you are liable for bank charges incurred. </td>
          </tr>
          <tr>
          	<td width="55%" valign="top">
            	
            	<div>
                	<div><b>OPTION 1</b></div>
                	EFT transfare to the following bank account:<br />			
                    FNB<br />			
                    Account Number &nbsp;&nbsp;&nbsp;&nbsp; 62425472066	<br />
                    Branch code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 250117<br />	
                    Reference &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $member->account_id; ?>
                </div>
                <br />
                <div>
                	<div><b>OPTION 2</b></div>
                	Bank cash deposit (R5 000 max limit)
                </div>
            </td>
            <td width="45%" valign="top">
            	<div><b>OPTION 3<br />Pay with Monster Pay</b></div>
            	<div>
                    <form action="https://www.monsterpay.com/secure/index.cfm" method="POST" enctype="APPLICATION/X-WWW-FORM-URLENCODED">
                    
                    <input type="text" name="FirstName" style="width:230px;" value="" placeholder="First Name" />
                    <input type="text" name="LastName" style="width:230px;" value="" placeholder="Last Name" />
                    <input type="text" name="Email" value="" style="width:230px;" placeholder="Email" />
                    <input type="text" name="MobileNumber" value="" style="width:230px;" placeholder="Mobile Number" /><br />
                    R <input type="text" name="LIDPrice" value="" style="width:218px;" placeholder="Amount to Transfer (in Rand)" />
                    <input type="hidden" name="ButtonAction" value="buynow" />
                    <input type="hidden" name="MerchantIdentifier" value="SCOEHJQKJS" /> 
                    <input type="hidden" name="LIDDesc" value="LanteOTC Online Transfer" />
                    <input type="hidden" name="LIDSKU" value="LanteOTC Online Transfer" /> 
                    <input type="hidden" name="LIDQty" value="1" /> 
                    <input type="hidden" name="CurrencyAlphaCode" value="ZAR" />
                    <input type="hidden" name="ShippingRequired" value="0" /> 
                    <input type="hidden" name="KeepShopping" value="http://198.199.92.239/lante/" /> 
                    <input type="hidden" name="MerchRef" />
                    <input type="image" src="<?php echo JURI::base(); ?>/images/pay-with-monsterpay-button.jpg" /> 
                    </form>
                </div>
            
            </td>
          </tr>
          </table>
        </div>
    
    <br />
    <div>
    	<table width="100%" border="0" cellpadding="0" cellspacing="0">
        	<tr>
            	<td>
                	<table width="100%" class="table table-striped listings" style="border:1px solid #fd7800;" border="0" cellpadding="0" cellspacing="0">
                        <thead>
                        <tr>
                            <th colspan="4">Planning</th>
                        </tr>
                        </thead>
                      <tr>
                          <td colspan="4">This section allows you to set your future investment plans. We will Only send you an email reminder on the day of your commitment</td>
                      </tr>
                      <tr>
                        <td class="listings-header borders">Company</td>
                        <td class="listings-header borders">Number of Shares</td>
                        <td class="listings-header borders">When</td>
                        <td class="listings-header borders">&nbsp;</td>
                      </tr>
                      <?php foreach($plannings as $planning) { 
                        
                        $plandatear = explode('-',$planning->when_to_purchase);
                        $plan_date = date("n/j/Y", mktime(0, 0, 0, $plandatear[1], $plandatear[2], $plandatear[0]));

						$caldate = date("j M Y", mktime(0, 0, 0, $plandatear[1], $plandatear[2], $plandatear[0]));
						
						$todays_date = date("Y-m-d");
						$todays_timestamp = strtotime($todays_date);
						$planning_timestamp = strtotime($planning->when_to_purchase);
						if ($planning_timestamp > $todays_timestamp) {  
                      ?>
                      <tr id="plan_row_<?php echo $planning->id; ?>">
                        <td class="borders"><?php echo $planning->companyname; ?> <span class="comp_id" style="visibility:hidden;"><?php echo $planning->companyid; ?></span></td>
                        <td class="borders"><span class="num_shares"><?php echo $planning->num_shares; ?></span></td>
                        <td class="borders"><?php echo $caldate; ?> <span class="plan_date" style="visibility:hidden;"><?php echo $caldate; ?></span></td>
                        <!-- <td><a href="<?php // echo parseUrl('index.php?option=com_otc&view=planning&layout=editplanning&id='. $planning->id);?>">Edit</a></td> -->
                        <td class="borders"><a href="#myModal2" role="button" data-toggle="modal" class="editPlan" id="<?php echo $planning->id; ?>">Edit</a></td>
                       <?php } } ?>
                      </tr>
                      
                      <tr>
                      	<td colspan="4">
                        	<div align="right"><a href="#myModal" class="btn btn-primary" role="button" data-toggle="modal">Create Reminder</a></div>
                            
                            <!-- Modal -->
                            <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header" style="background-color:#fd7800">
                                  <h3 id="myModalLabel" style="color:#fff">Set Your Target Plan</h3>
                                </div>
                                <div class="modal-body">
                                
                                
                                  <form class="form-horizontal" id="addTargetPlan" method="post" action="index.php?option=com_otc&task=planning.whentopurchase">
                                  	<input type="hidden" name="memberid" value="<?php echo $member->id; ?>" />
                                    <input type="hidden" name="userid" value="<?php echo $user->id; ?>" />
                                    <input type="hidden" name="share_price" id="share_price" value="" />
                                    <input type="hidden" name="company_name" id="company_name" value="" />
                                    <div id="validationerrors" style="display:none; color:#ff0000;"></div>
                                    <div id="progress" class="passprogress progress progress-striped active" style="display:none">
                                      <div class="bar" style="width: 100%;"></div>
                                    </div>
                                    
                                    <div id="responseD" class="passresponse alert" style="display:none">
                                    </div> 
                                    
                                    <div class="control-group">
                                      <label class="control-label" for="currentpassword">Select Company:</label>
                                     
                                      <div class="controls">
                                        <select id="companyid" name="companyid">
                                            <option value="">Select Company</option>
                                            
                                            <?php 
                                            if(!empty($allcompanies) && count($allcompanies) > 0) {
                                                foreach($allcompanies as $allcompany) {
                                            ?>	
                                                    <option data-shareprice="<?php echo $allcompany->share_price; ?>" value="<?php echo $allcompany->id; ?>" ><?php echo $allcompany->name; ?></option>
                                            <?php        
                                                }
                                            }
                                            ?>
                                            
                                         </select>
                                      </div>
                                    </div>
                                
                                    <div class="control-group">
                                      <label class="control-label" for="newpassword">Number of Shares:</label>
                                      
                                      <div class="controls">
                                        <input value="" class="input-large" type="text" id="num_shares" name="num_shares" required="" autocomplete="off" />
                                      </div>
                                    </div>
                                
                                
                                    <div class="control-group">
                                      <label class="control-label" for="newpassword2">When:</label>
                                      
                                      <div class="controls">
                                        <input value="" class="input-large" type="text" id="expiry_date" name="when_date" required="" autocomplete="off" />
                                      </div>
                                    </div>
                                    
                                    <?php echo JHtml::_('form.token'); ?>
                                  </form>
                                </div>
                                
                                <div class="modal-footer">
                                  <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
                                  <button class="btn btn-primary" id="savereminder">Save Reminder</button>
                                </div>
                              </div>
                              
                              
                              
                              <!-- Edit modal -->
                              <div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-header" style="background-color:#fd7800">
                                  <h3 id="myModalLabel" style="color:#fff">Edit Your Plan</h3>
                                </div>
                                <div class="modal-body">
                                
                                
                                  <form class="form-horizontal" id="editTargetPlan" method="post" action="index.php?option=com_otc&task=planning.edittargetplan">
                                  	<input type="hidden" name="memberid" value="<?php echo $member->id; ?>" />
                                    <input type="hidden" name="userid" value="<?php echo $user->id; ?>" />
                                    <input type="hidden" id="plan_id2" name="id" value="" />
                                    <div id="validationerrors2" style="display:none; color:#ff0000;"></div>
                                    <div id="progress2" class="passprogress2 progress progress-striped active" style="display:none">
                                      <div class="bar" style="width: 100%;"></div>
                                    </div>
                                    
                                    <div id="responseD2" class="passresponse2 alert" style="display:none">
                                    </div> 
                                    
                                    <div class="control-group">
                                      <label class="control-label">Select Company:</label>
                                     
                                      <div class="controls">
                                        <select id="companyid2" name="companyid">
                                            <option value="">Select Company</option>
                                            
                                            <?php 
                                            if(!empty($allcompanies) && count($allcompanies) > 0) {
                                                foreach($allcompanies as $allcompany) {
                                            ?>	
                                                    <option data-shareprice="<?php echo $allcompany->share_price; ?>" value="<?php echo $allcompany->id; ?>" ><?php echo $allcompany->name; ?></option>
                                            <?php        
                                                }
                                            }
                                            ?>
                                            
                                         </select>
                                      </div>
                                    </div>
                                
                                    <div class="control-group">
                                      <label class="control-label" for="newpassword">Number of Shares:</label>
                                      
                                      <div class="controls">
                                        <input value="" class="input-large" type="text" id="num_shares2" name="num_shares" required="" autocomplete="off" />
                                      </div>
                                    </div>
                                
                                
                                    <div class="control-group">
                                      <label class="control-label" for="newpassword2">When:</label>
                                      
                                      <div class="controls">
                                        <input value="" class="input-large" type="text" id="expiry_date2" name="when_date" required="" autocomplete="off" />
                                      </div>
                                    </div>
                                    
                                    <?php echo JHtml::_('form.token'); ?>
                                  </form>
                                </div>
                                
                                <div class="modal-footer">
                                  <!-- <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
                                  <button class="btn btn-primary" id="savereminder2">Save Reminder</button>
                                </div>
                              </div>
                        </td>
                      </tr>
                      
                    </table>
                </td>
                <?php // if(count($plannings) < 5) { ?>
                <!-- <td align="right">
                <a href="<?php // echo parseUrl('index.php?option=com_otc&view=planning');?>"><img border="0" alt="Set Goals" src="http://localhost/lante-site/images/set-goals.jpg" border="0"></a></td> -->
                <?php // } ?>
            </tr>
        </table>
    	
    </div>
     </div>
   
    
	<?php } ?>
                
         



	
   
    

     
     
     
     
    </div>
    
 
    
    
    
  
  
  

<script style="text/javascript">
(function () {
  var input = document.createElement('input');
  
  if (typeof jQuery !== 'undefined' && !('placeholder' in input)) {
    jQuery(function () {
        var $ = jQuery,
            name = $('#jform_name'),
            username = $('#jform_username'),
            email = $('#jform_email1'),
            email2 = $('#jform_email2'),
            password = $('#jform_password1'),
            password2 = $('#jform_password2'),
            fakepassword = $('#fake_password1'),
            fakepassword2 = $('#fake_password2');
            
    
        name.val('Full Name');
        username.val('Username');
        email.val('Email Address');
        email2.val('Re-enter Email Address');
        password.css({display: 'none'});
        password2.css({display: 'none'});
        fakepassword.css({display: 'block'});
        fakepassword2.css({display: 'block'});
        
        
        name.focus(function () {
            name.val('');  
        })
        .blur(function () {
            if (!name.val()) {
                name.val('Full Name');
            }
        });
        
        
        username.focus(function () {
            username.val('');  
        })
        .blur(function () {
            if (!username.val()) {
                username.val('Username');
            }
        });
        
        
        email.focus(function () {
            email.val('');  
        })
        .blur(function () {
            if (!email.val()) {
                email.val('Email Address');
            }
        });
        
        
        email2.focus(function () {
            email2.val('');  
        })
        .blur(function () {
            if (!email2.val()) {
                email2.val('Re-enter Email Address');
            }
        });
        
        
        fakepassword.focus(function () {
            fakepassword.css({display: 'none'});
            password.val('').css({display: 'block'}).focus(); 
        });
        
        password.blur(function () {
            if (!password.val()) {
                password.css({display: 'none'});
                fakepassword.css({display: 'block'});
            }
        });
        
        
        fakepassword2.focus(function () {
            fakepassword2.css({display: 'none'});
            password2.val('').css({display: 'block'}).focus();                
        })
        password2.blur(function () {
            if (!password2.val()) {
                password2.css({display: 'none'});
                fakepassword2.css({display: 'block'});
            }
        });
    });
  }
    
    
  jQuery(function () {
        setInterval(function () {
            var $active = jQuery('#q-slides img.q-active');

            if ( $active.length === 0 ) {
               $active = $('#q-slides img:last');
            }

            // use this to pull the images in the order they appear in the markup
            var $next =  $active.next().length ? $active.next() : jQuery('#q-slides img:first');

            $active.addClass('last-active');

            $next.css({opacity: 0.0})
            .addClass('q-active')
            .animate({opacity: 1.0}, 1000, function() {
                $active.removeClass('q-active last-active');
            });
      }, 7000 );
  });
})();
</script>
<?php
$document =& JFactory::getDocument();

$document->addStyleSheet(JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
$document->addStyleDeclaration($style);
?>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/bootstrap.min.js'; ?>"></script>
<script type="text/javascript">
function chkNumeric(strString)
   //  check for valid numeric strings	
   {
   var strValidChars = "0123456789";
   var strChar;
   var blnResult = true;

   if (strString.length == 0) return false;

   //  test strString consists of valid characters listed above
   for (i = 0; i < strString.length && blnResult == true; i++)
      {
      strChar = strString.charAt(i);
      if (strValidChars.indexOf(strChar) == -1)
         {
         blnResult = false;
         }
      }
   return blnResult;
   }
   
jQuery.noConflict();

(function ($) {
    $('#myModal').modal({
        keyboard: false,
        show: false
    });
	
	/*$('#myModal').on('hidden.bs.modal', function (e) {
  		location.reload();
	})
	*/
	/*
	$('#myModal2').on('hidden.bs.modal', function (e) {
  		location.reload();
	})
	*/

    
    function handleForm(event, opts) {
        var self = opts.form,
            progress = $('.' + opts.progress),
            response = $('.' + opts.response);
            
        progress.slideDown(function () {
            $.post(opts.action, $(self).serialize() + '&t=' + (new Date().getTime()) , 'text')
            
            .done(function(res) {
                if (typeof res === 'object') {
                    res = res.responseText
                }
                
                progress.slideUp(function () {
                    response.addClass('alert-success').html($('<strong>' + res + '</strong>')).slideDown('slow');
                });
                  
                window.setTimeout(function () { 
                    response.slideUp(function () {
                        response.removeClass('alert-success');
						location.reload();
                    }); 
                }, 3 * 1000);
            })
            
            .fail(function(res) {
                if (typeof res === 'object') {
                    res = res.responseText
                }
                
                progress.slideUp(function () {
                    response.addClass('alert-error').html($('<strong>' + res + '</strong>')).slideDown('slow');
                });
                  
                window.setTimeout(function () { 
                    response.slideUp(function () {
                        response.removeClass('alert-error');
						location.reload();
                    }); 
                }, 3 * 1000);
            });
        });
            
        return false;
    }
    
    
    var addTargetPlan = $('#addTargetPlan');
	var editTargetPlan = $('#editTargetPlan');
    
    $('#savereminder').on('click', function (event) {
        
		var errors = 0;
		$("#validationerrors").html("");

		
		if($("#companyid").val() == ''){
		    $("#validationerrors").append("<div>Please Select Company</div>");
			errors = 1;
		}
		if($("#num_shares").val() == ''){
		    $("#validationerrors").append("<div>Please enter number of shares</div>");
			errors = 1;
		}
		if(chkNumeric($("#num_shares").val()) == false) {
		 $("#validationerrors").append("<div>Please Enter only numeric values number of shares</div>");
		 errors = 1;
		}
		if($("#expiry_date").val() == ''){
		    $("#validationerrors").append("<div>Please select date</div>");
			errors = 1;
		}
		
		  
		
		if(errors == 0) {
		  addTargetPlan.submit();
		  $("#savereminder").hide();
		} else {
		  $("#validationerrors").show();
		  return flase;
		}
		  
    });
	
	
	$('#savereminder2').on('click', function (event) {

		var errors2 = 0;
		$("#validationerrors2").html("");

		
		if($("#companyid2").val() == ''){
		    $("#validationerrors2").append("<div>Please Select Company</div>");
			errors2 = 1;
		}
		if($("#num_shares2").val() == ''){
		    $("#validationerrors2").append("<div>Please enter number of shares</div>");
			errors2 = 1;
		}
		if(chkNumeric($("#num_shares2").val()) == false) {
		 $("#validationerrors2").append("<div>Please Enter only numeric values number of shares</div>");
		 errors2 = 1;
		}
		if($("#expiry_date2").val() == ''){
		    $("#validationerrors2").append("<div>Please select date</div>");
			errors2 = 1;
		}
		
		  
		
		if(errors2 == 0) {
		  editTargetPlan.submit();
		  $("#savereminder2").hide();
		} else {
		  $("#validationerrors2").show();
		  return flase;
		}
		  
    });
	
    
    addTargetPlan.on('submit', function (event) {
        
		return handleForm(event, {
            form: this,
            progress: 'passprogress',
            response: 'passresponse',
            action: 'index.php?option=com_otc&task=planning.whentopurchase'
        });
    });
	
	editTargetPlan.on('submit', function (event) {
		
        return handleForm(event, {
            form: this,
            progress: 'passprogress2',
            response: 'passresponse2',
            action: 'index.php?option=com_otc&task=planning.edittargetplan'
        });
    });
    
	
	$( "#expirydate, #expiry_date , #expiry_date2").datepicker({
            dateFormat: 'd M yy',
            minDate: 1,
            maxDate: +30
     });
	 
	 $(".editPlan").click(function(){
	 	id = $(this).attr("id");
		comp_id = $("#plan_row_"+id+" .comp_id").html();
		num_shares = $("#plan_row_"+id+" .num_shares").html();
		plan_date = $("#plan_row_"+id+" .plan_date").html();

		$("#editTargetPlan input#plan_id2").val(id);
		$("#editTargetPlan select#companyid2").val(comp_id);
		$("#editTargetPlan input#num_shares2").val(num_shares);
		$("#editTargetPlan input#expiry_date2").val(plan_date);
		
	 });
	
}(jQuery));
</script>
