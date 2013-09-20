<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="row-fluid">
<form class="form-horizontal" name="newcompany" id="newcompany" enctype="multipart/form-data" method="post" action="<?php echo $this->parseUrl('index.php?option=com_otc&task=companies.createcompany'); ?>">
<fieldset style="border: 1px solid #ccc; padding: 20px;">

<legend style="margin-bottom: 0px; width:180px;border: 1px solid #e5e5e5; text-align:center;padding: 0px 5px 0px 5px;">New Company</legend>

<h4>Company Details</h4>
<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="name">Company Name</label>
  <div class="controls">
    <input id="name" name="name" placeholder="Company name" class="input-xlarge" required="" value="" type="text" />
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="website">Website</label>
  <div class="controls">
    <input id="website" name="website" placeholder="Company website" class="input-xlarge" type="text">
    
  </div>
</div>

<div class="control-group">
  <label class="control-label">Share Price</label>
  <div class="controls">
    <div class="input-prepend input-append">
        <span class="add-on">R</span>
        <input class="span2" id="rands" placeholder="Rands" name="rands" type="text">
        <span class="add-on">.</span>
        <input class="span2" id="cents" placeholder="Cents" name="cents" maxlength="2" type="text">
    </div>
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="available_shares">Available Shares</label>
  <div class="controls">
    <input id="available_shares" name="available_shares" placeholder="Total Shares" value="" class="input-small" required="" type="text">
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="about">About the Company</label>
  <div class="controls">                     
    <textarea id="about" rows="3" required="" name="about"></textarea>
  </div>
</div>

<div class="control-group">
  <label class="control-label">Logo (120px X 120px)</label>
  <div class="controls">
    <input name="logo" class="input-file" type="file" />
  </div>
</div>


<h4>Owner Details</h4>

<div class="control-group">
  <label class="control-label" for="owner_name">Full Name</label>
  <div class="controls">
    <input id="owner_name" name="owner_name" placeholder="Owner Full Name" class="input-xlarge" required="" value="" type="text" />
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email">Email</label>
  <div class="controls">
    <input id="email" name="email" placeholder="Email" class="input-xlarge" value="" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="cell_number">Phone Number</label>
  <div class="controls">
    <input id="cell_number" name="cell_number" placeholder="Cellphone Number" class="input-xlarge" required="" type="text">
    
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
<script type="text/javascript">
jQuery.noConflict();

(function ($) {
    $(function () {
        $('#newcompany').on('submit', function (event) {
            var formObj = formToObject('newcompany'), result;
            
            result = isEmail(formObj.email);
            
            if (!result) {
                alert('Please check that you have entered a correct email address');
            }

            return result;
        });
        
        
        function isEmail(email) {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            
            return regex.test(email);
        }
        
        
        function formToObject(id) {
            var formObj = {}, arr = $('#' + id).serializeArray();
            
            $.each(arr, function (index, fieldObj) {
                if (fieldObj.name !== 'submit') {
                    formObj[fieldObj.name] = fieldObj.value;
                }
            });
            
            return formObj;
        }
    });
}(jQuery));
</script>
