<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
?>

<div class="row-fluid">
<form class="form-horizontal" name="newmember" id="newmember" method="post" action="index.php?option=com_otc&task=members.createmember">
<fieldset style="border: 1px solid #ccc; padding: 20px;">

<legend style="margin-bottom: 0px; width:180px;border: 1px solid #e5e5e5; text-align:center;padding: 5px;">Add New Member</legend>

<?php 
/*
    Prefill some fields with user data currently available
*/
  if ($this->user) :
?>
<!-- Form Name -->
<h4>Personal Details</h4>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="title">Title</label>
  <div class="controls">
    <select id="title" name="title" class="span2" required="">
      <option value="">Select</option>
      <option value="Mr">Mr</option>
      <option value="Mrs">Mrs</option>
      <option value="Miss">Miss</option>
      <option value="Ms">Ms</option>
      <option value="Dr">Dr</option>
      <option value="Prof">Prof</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="name">Name</label>
  <div class="controls">
    <input id="name" name="name" placeholder="First name" class="input-xlarge" required="" value="<?php echo $this->user->name; ?>" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="middle_name">Middle Name</label>
  <div class="controls">
    <input id="middle_name" name="middle_name" placeholder="Middle Name" class="input-xlarge" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="surname">Surname</label>
  <div class="controls">
    <input id="surname" name="surname" placeholder="Surname" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="expiry_date">Date of Birth</label>
  <div class="controls">
    <input value="" class="input-xlarge" type="text" id="expiry_date" name="expiry_date" required="" />
  </div>
</div>


<h4>Contact Details</h4>

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

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="work_number">Work Number</label>
  <div class="controls">
    <input id="work_number" name="work_number" placeholder="Work Number" class="input-xlarge" type="text">
    
  </div>
</div>


<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="address">Physical Address</label>
  <div class="controls">                     
    <textarea id="address" rows="3" required="" name="address"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="address_code">Code</label>
  <div class="controls">
    <input id="address_code" name="address_code" placeholder="Code" class="input-mini" required="" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="postal_address">Postal Address</label>
  <div class="controls">                     
    <textarea id="postal_address" required="" rows="3" name="postal_address"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="postal_code">Code</label>
  <div class="controls">
    <input id="postal_code" name="postal_code" placeholder="Code" class="input-mini" required="" type="text">
    
  </div>
</div>

<h4>Bank Details</h4>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="bank_name">Bank Name</label>
  <div class="controls">
    <input id="bank_name" name="bank_name" placeholder="Bank name" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="account_name">Account Name</label>
  <div class="controls">
    <input id="account_name" name="account_name" placeholder="Name of your account" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="account_number">Account Number</label>
  <div class="controls">
    <input id="account_number" name="account_number" placeholder="Account Number" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="branch_name">Branch Name</label>
  <div class="controls">
    <input id="branch_name" name="branch_name" placeholder="Branch Name" class="input-xlarge" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="branch_code">Branch Number</label>
  <div class="controls">
    <input id="branch_code" name="branch_code" placeholder="Branch number" class="input-xlarge" type="text">
  </div>
</div>

<input type="hidden" name="userid" value="<?php echo $this->user->id; ?>" />
<?php echo JHtml::_('form.token'); ?>

<!-- Button (Double) -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
    <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=members'); ?>" class="btn" type="button">
      Cancel
    </a>
  </div>
</div>

<?php 
/*
    Select from a list of users from the database
*/
elseif (is_array($this->users)) :

$url = JURI::base() . 'index.php?option=com_otc&view=members&layout=newuser&id=';
?>
<p>
  <strong>Select user from database:</strong> <select id="Title" name="Title" onchange="location.href='<?php echo $url ?>' + this.value;">
    <option value="">Select User</option>
    <?php foreach($this->users as $user) { ?>
      <option value="<?php echo $user->id; ?>"><?php echo $user->name . ' (' . $user->email . ')'; ?></option>
    <?php } ?>
  </select>
</p>
<?php  
endif; 
?>

    </fieldset>
  </form>
</div>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script type="text/javascript">
jQuery.noConflict();

(function ($) {
    $(function () {
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
        
        
        $('#newmember').on('submit', function (event) {
            var formObj = formToObject('newmember'), result;
            
            result = (isEmail(formObj.email) && formObj.title);
            
            if (!result) {
                alert('Please check that you have entered all details correctly');
            }

            return result;
        });
        
        $( "#expiry_date").datepicker({
            dateFormat: 'd M yy'
        });
    });
}(jQuery));
</script>
