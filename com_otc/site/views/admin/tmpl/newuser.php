<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="row-fluid">
<form class="form-horizontal" name="newmember" id="newmember" method="post" action="index.php?option=com_otc&task=member.createmember">
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
  <label class="control-label" for="middlename">Middle Name</label>
  <div class="controls">
    <input id="middlename" name="middlename" placeholder="Middle Name" class="input-xlarge" type="text">
    
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
  <label class="control-label" for="dob">Date of Birth</label>
  <div class="controls">
    <select id="day" name="day" class="span2" required="">
      <option value="">Day</option>
      <option value="1">01</option>
      <option value="2">02</option>
      <option value="3">03</option>
      <option value="4">04</option>
      <option value="5">05</option>
      <option value="6">06</option>
      <option value="7">07</option>
      <option value="8">08</option>
      <option value="9">09</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
    </select>
    
    <select id="month" name="month" class="span2" required="">
      <option value="">Month</option>
      <option value="Jan">Jan</option>
      <option value="Feb">Feb</option>
      <option value="Mar">Mar</option>
      <option value="Apr">Apr</option>
      <option value="May">May</option>
      <option value="Jun">Jun</option>
      <option value="Jul">Jul</option>
      <option value="Aug">Aug</option>
      <option value="Sep">Sep</option>
      <option value="Oct">Oct</option>
      <option value="Oct">Nov</option>
      <option value="Oct">Dec</option>
    </select>
    
    Year <input id="year" name="year" maxlength="4" placeholder="e.g: 1982" class="input-mini" required="" type="text">
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
    <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin'); ?>" class="btn" type="button">
      Cancel
    </a>
  </div>
</div>

<?php 
/*
    Select from a list of users from the database
*/
elseif (is_array($this->users)) :

$url = JURI::base() . 'index.php?option=com_otc&view=admin&layout=newuser&id=';
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