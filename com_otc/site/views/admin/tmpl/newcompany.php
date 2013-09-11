<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="row-fluid">
<form class="form-horizontal" name="newmember" id="newmember" method="post" action="index.php?option=com_otc&task=admin.createcompany">
<fieldset style="border: 1px solid #ccc; padding: 20px;">

<legend style="margin-bottom: 0px; width:180px;border: 1px solid #e5e5e5; text-align:center;">Add New Company</legend>

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
  <label class="control-label" for="share_price">Share Price (Rands)</label>
  <div class="controls">
    <input id="share_price" name="share_price" placeholder="R" class="input-mini" required="" type="text">
    
  </div>
</div>

<div class="control-group">
  <label class="control-label" for="about">About the Company</label>
  <div class="controls">                     
    <textarea id="about" rows="3" required="" name="about"></textarea>
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
    <input id="email" name="email" placeholder="Email" class="input-xlarge" value="<?php echo $this->user->email; ?>" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="cell_number">Cell Number</label>
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
    <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=companies'); ?>" class="btn" type="button">
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
        $('#newmember').on('submit', function (event) {
            var formObj = formToObject('newmember'), result;
            
            result = (dobIsValid(formObj.dob) && isEmail(formObj.email) && formObj.title);
            
            if (!result) {
                alert('Please check that you have entered all details correctly');
            }

            return result;
        });
        
        function dobIsValid(dob) {
            var cleanDob = trim(dob)
                dobArr = cleanDob.split(' ');
                
            if (!(dobArr.length === 3)) {
                return false;
            }
            
            var day = parseInt(dobArr[0], 10);
            
            if (day < 1 || day > 31) {
                return false;
            }
            
            if (!isValidMonth(dobArr[1])) {
                return false;
            }
 
            if (!(dobArr[2].length === 4)) {
                return false;
            }
            
            return true;
        }
        
        
        function trim(str) {
            return str.replace(/^\s+|\s+$/g, '');
        }
        
        
        function isValidMonth(month) {
            var months = {'jan': 1, 'feb': 1, 'mar': 1, 'apr': 1, 'may': 1, 'jun': 1, 'jul': 1, 'aug': 1, 'sep': 1, 'oct': 1, 'nov': 1, 'dec': 1};
            
            month = month.toLowerCase();
            
            if (months.hasOwnProperty(month)) {
                return true;
            }
            
            return false;
        }
        
        
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