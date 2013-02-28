<?php 
defined('_JEXEC') or die('Restricted access'); // no direct access 

?>

<div class="row">
  <div class="span6">
  
    <div id="q-slides" style="margin-left: 10px;">
      <img border="0" alt="LanteOTC" style="border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;" src="/images/invest.png" class="q-active">
      <img border="0" alt="LanteOTC" style="border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;" src="/images/charts.png">
      <img border="0" alt="LanteOTC" style="border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;" src="/images/bulb.png">
      <img border="0" alt="LanteOTC" style="border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px;" src="/images/invest.png">
    </div>
    
    
    <p style="color: #fd7800; margin-left: 10px;"><strong>LanteOTC is</strong> an online market place that <strong>connects Businesses with Investors</strong> through Over The Counter <strong>online trading</strong>.</p>

  <table class="table table-striped listings" style="margin-left: 10px;">
              <thead>
                <tr>
                  <th colspan="5">New Listings</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="listings-header">Stock</td>
                  <td class="listings-header">Last</td>
                  <td class="listings-header">CHG</td>
                  <td class="listings-header">%CHG</td>
                  <td class="listings-header">Time</td>
                </tr>
                <tr>
                  <td>AFRISH</td>
                  <td>10.00</td>
                  <td>0</td>
                  <td>0</td>
                  <td>1 Jan</td>
                </tr>
                <tr>
                  <td>Masters Tour</td>
                  <td>10.00</td>
                  <td>+0.50</td>
                  <td>0.52</td>
                  <td>9:30</td>
                </tr>
                <tr>
                  <td>TribalAff</td>
                  <td>5.00</td>
                  <td>0</td>
                  <td>0</td>
                  <td>1 Jan</td>
                </tr>
                <tr>
                  <td colspan="5" class="listings-header">Market Open</td>
                </tr>
              </tbody>
            </table>
  </div>
  
  <div class="span6">
    <form style="padding-left: 40px; background-color: #F0F0F0; margin-right: 10px;" id="custom-reg-form" class="well" action="/index.php/component/users/?task=registration.register" method="post">
    <h1 style="color: #fd7800; font-size: 2em;">Register for FREE as an INVESTOR</h1>
    <div class="controls controls-row">
        <input type="text" placeholder="Full Name" id="jform_name" name="jform[name]" class="span3">
        <input type="text" placeholder="Username" class="span2" id="jform_username" name="jform[username]">
    </div>
            
    <div class="controls">
        <input type="text" placeholder="Email Address"  name="jform[email1]" id="jform_email1" class="span5">
    </div>

    <div class="controls">
        <input type="text" placeholder="Re-enter Email Address" class="span5" id="jform_email2" name="jform[email2]">
    </div>
            
    <div class="controls">
        <input type="password" placeholder="Password" class="span5" autocomplete="off" value="" id="jform_password1" name="jform[password1]">
        <input type="text" class="span5" autocomplete="off" value="Password" id="fake_password1" style="display:none">
    </div>
            
    <div class="controls">
        <input type="password" placeholder="Re-enter Password" class="span5" autocomplete="off" value="" id="jform_password2" name="jform[password2]">
        <input type="text" class="span5" autocomplete="off" value="Re-enter Password" id="fake_password2" style="display:none">
    </div>
    
    <p style="font-size: 12px; margin-top: 10px;">By clicking Sign Up, you agree to our <a href="http://www.lanteotc.co.za/index.php/terms-conditions" target="_blannk">Terms & Conditions</a></p>
            
    <p><button  class="btn btn-large btn-warning"  type="submit" style="padding-left: 50px; padding-right: 50px; background-color: #fd7800; background-image: -moz-linear-gradient(center top , #F89406, #fd7800)"><strong>Sign Up</strong></button></p>
    
    <input type="hidden" value="com_users" name="option">
    <input type="hidden" value="registration.register" name="task">
    <?php echo JHtml::_('form.token');?>
    </form>
    
<div style="color: #fd7800;">
<p>You can use LanteOTC to:</p>
<ul>
<li>Buy Shares from a listed company</li>
<li>Sell your shares</li>
<li>View trading history of listed company</li>
<li>View trading value or worth</li>
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