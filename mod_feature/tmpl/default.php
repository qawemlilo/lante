<?php 
defined('_JEXEC') or die('Restricted access'); // no direct access 

?>

<div class="row">
  <div class="span6">
    <img border="0" alt="LanteOTC" style="border-radius: 3px; -moz-border-radius: 3px; -webkit-border-radius: 3px; margin-left: 10px;" src="/images/shutterstock_85769425.jpg"><br>
    <p style="color: #fd7800; margin-left: 10px;"><strong>LanteOTC is</strong> an online market place that <strong>connects Businesses with Investors</strong> through Over The Counter <strong>online trading</strong>.</p>
  </div>
  
  <div class="span6">
    <form style="padding-left: 45px; background-color: #F0F0F0; margin-right: 10px;" id="member-registration" class="well form-validate" action="/index.php/component/users/?task=registration.register" method="post">
    <h1 style="color: #fd7800;">Register for FREE</h1>
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
    </div>
            
    <div class="controls">
        <input type="password" placeholder="Re-enter Password" class="span5" autocomplete="off" value="" id="jform_password2" name="jform[password2]">
    </div>
    
    <p style="font-size: 12px; margin-top: 25px;">By clicking Sign Up, you agree to our Terms & Conditions</p>
            
    <p><button  class="btn btn-large btn-warning"  type="submit" style="padding-left: 50px; padding-right: 50px; background-color: #fd7800; background-image: -moz-linear-gradient(center top , #F89406, #fd7800)"><strong>Sign Up</strong></button></p>
    
    <input type="hidden" value="com_users" name="option">
    <input type="hidden" value="registration.register" name="task">
    <?php echo JHtml::_('form.token');?>
    </form>
  </div>
</div>
