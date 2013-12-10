<?php 
defined('_JEXEC') or die('Restricted access'); // no direct access 

$user =& JFactory::getUser();

    function marketStatus() {
        $today = getdate();
        $status = "MARKET OPEN";
        
        $hours = $today['hours'];
        $day = $today['wday'];
        
        if ($hours >= 17 || $hours < 9) {
            $status = "MARKET CLOSED";   
        } 
        
        if ($day === 6 || $day === 0) {
            $status = "MARKET CLOSED";   
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

<div class="row">
  <div class="span6">
  
    <div id="q-slides" style="margin-left: 10px;">
      <img border="0" alt="LanteOTC" src="/images/Lante-Slider3.png" class="q-active">
      <img border="0" alt="LanteOTC" src="/images/Lante-Slider1.jpg">
      <img border="0" alt="LanteOTC" src="/images/Lante-Slider2.jpg">
      <img border="0" alt="LanteOTC" src="/images/Lante-Slider4.jpg">
    </div>
    
    
    <p style="color: #fd7800; margin-left: 10px;"><strong>LanteOTC is</strong> a market place that <strong>connects Investors with Small-Medium Businesses</strong> in South Africa. Our system is very Easy to use and is Free, register now.</p>

  <table class="table table-striped listings" style="margin-left: 10px;">
              <thead>
                <tr>
                  <th colspan="5">Top performers</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="listings-header">Company</td>
                  <td class="listings-header">Last</td>
                  <td class="listings-header">Change</td>
                  <td class="listings-header">%Change</td>
                  <td class="listings-header">Time</td>
                </tr>
                <?php
                  foreach($companies as $company) :
                ?>
                <tr>
                  <td><a href="<?php echo parseUrl('index.php?option=com_otc&view=company&id=' .$company->id); ?>"><?php echo $company->name; ?></a></td>
                  <td class="text-center"><?php echo $company->share_price; ?></td>
                  <td class="text-center"><?php echo calcChange($company->share_price, $company->prev_price); ?></td>
                  <td class="text-center"><?php echo calcPChange($company->share_price, $company->prev_price); ?></td>
                  <td class="text-center"><?php echo getTime($company->ts, $company->last_updated); ?></td>
                </tr>
               <?php
                 endforeach;
               ?>
                <tr>
                  <td class="listings-header"><?php echo marketStatus(); ?></td>
                  <td colspan="4"><small>* Market open times: 09:00 to 17:00  Weekdays, Excluding Public Holidays</small></td>
                </tr>
              </tbody>
            </table>
            <p></p>
  </div>
  
  <div class="span6">
  <?php 
    if ($user->guest) {
  ?>
    <form style="padding-left: 40px; background-color: #F0F0F0; margin-right: 10px;" autocomplete="off" id="custom-reg-form" class="well" action="/index.php/component/users/?task=registration.register" method="post">
    <h1 style="color: #fd7800; font-size: 2em;">Register for FREE as an INVESTOR</h1>
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
                  <td class="listings-header">Today</td>
                  <td class="listings-header">Previous close</td>
                </tr>
                <tr>
                  <td>Price (c)</td>
                  <td><?php echo myFormat($summary->price["today"]); ?></td>
                  <td><?php echo myFormat($summary->price["prev"]); ?></td>
                </tr>
                <tr>
                  <td>Movement (c)</td>
                  <td><?php echo myFormat($summary->movement["today"]); ?></td>
                  <td><?php echo myFormat($summary->price["prev"]); ?></td>
                </tr>
                <tr>
                  <td>Volume</td>
                  <td><?php echo myFormat($summary->volume["today"]); ?></td>
                  <td><?php echo myFormat($summary->volume["prev"]); ?></td>
                </tr>
                <tr>
                  <td>Value</td>
                  <td><?php echo myFormat($summary->value["today"]); ?></td>
                  <td><?php echo myFormat($summary->value["prev"]); ?></td>
                </tr>                
                <tr>
                  <td>No. of Trades</td>
                  <td><?php echo myFormat($summary->num_trades["today"]); ?></td>
                  <td><?php echo myFormat($summary->num_trades["prev"]); ?></td>
                </tr>
                <tr>
                  <td>Low Price (c)</td>
                  <td ><?php echo myFormat($summary->lowest_price["today"]); ?></td>
                  <td ><?php echo myFormat($summary->lowest_price["prev"]); ?></td>
                </tr>      
                <tr>
                  <td>High Price (c)</td>
                  <td><?php echo myFormat($summary->highest_price["today"]); ?></td>
                  <td><?php echo myFormat($summary->highest_price["prev"]); ?></td>
                </tr>  
              </tbody>
            </table>
    <?php
    }
    ?>   
    
    <div style="color: #fd7800;">
      <p>You can use LanteOTC to:</p>
      <ul>
        <li>Buy Shares from registered companies</li>
        <li>Sell your shares</li>
        <li>View trading history of listed company</li>
        <li>View company information</li>
        <li>Register or update your details as an investor</li>
      </ul>
    </div>
  </div>
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
