<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="row-fluid">
<form class="form-horizontal" name="editmember" id="editmember" method="post" action="index.php?option=com_otc&task=members.editmember">
<fieldset style="border: 1px solid #ccc; padding: 20px;">

<legend style="margin-bottom: 0px; width:180px;border: 1px solid #e5e5e5; text-align:center;padding: 0px 5px 0px 5px;">Edit Member</legend>

<!-- Form Name -->
<h4>Personal Details</h4>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="title">Title</label>
  <div class="controls">
    <select id="title" name="title" class="input-medium" required="">
      <option value="">Select</option>
      <option <?php if($this->member->title == "Mr") echo 'selected="selected"'; ?> value="Mr">Mr</option>
      <option <?php if($this->member->title == "Mrs") echo 'selected="selected"'; ?> value="Mrs">Mrs</option>
      <option <?php if($this->member->title == "Miss") echo 'selected="selected"'; ?> value="Miss">Miss</option>
      <option <?php if($this->member->title == "Ms") echo 'selected="selected"'; ?> value="Ms">Ms</option>
      <option <?php if($this->member->title == "Dr") echo 'selected="selected"'; ?> value="Dr">Dr</option>
      <option <?php if($this->member->title == "Prof") echo 'selected="selected"'; ?> value="Prof">Prof</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="name">Name</label>
  <div class="controls">
    <input id="name" name="name" placeholder="First name" class="input-xlarge" required="" value="<?php echo $this->member->name; ?>" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="middle_name">Middle Name</label>
  <div class="controls">
    <input id="middle_name" name="middle_name" placeholder="Middle Name" value="<?php echo $this->member->middle_name; ?>" class="input-xlarge" type="text">
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="surname">Surname</label>
  <div class="controls">
    <input id="surname" name="surname" placeholder="Surname" value="<?php echo $this->member->surname; ?>" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="dob">Date of Birth</label>
  
  <?php 
     list($day, $mnth, $year) = explode('-', $this->member->dob);
  ?>
  <div class="controls">
    <select id="day" name="day" class="input-small" required="">
      <option value="">Day</option>
      <option <?php if($day == "1") echo 'selected="selected"'; ?> value="1">01</option>
      <option <?php if($day == "2") echo 'selected="selected"'; ?> value="2">02</option>
      <option <?php if($day == "3") echo 'selected="selected"'; ?> value="3">03</option>
      <option <?php if($day == "4") echo 'selected="selected"'; ?> value="4">04</option>
      <option <?php if($day == "5") echo 'selected="selected"'; ?> value="5">05</option>
      <option <?php if($day == "6") echo 'selected="selected"'; ?> value="6">06</option>
      <option <?php if($day == "7") echo 'selected="selected"'; ?> value="7">07</option>
      <option <?php if($day == "8") echo 'selected="selected"'; ?> value="8">08</option>
      <option <?php if($day == "9") echo 'selected="selected"'; ?> value="9">09</option>
      <option <?php if($day == "10") echo 'selected="selected"'; ?> value="10">10</option>
      <option <?php if($day == "11") echo 'selected="selected"'; ?> value="11">11</option>
      <option <?php if($day == "12") echo 'selected="selected"'; ?> value="12">12</option>
      <option <?php if($day == "13") echo 'selected="selected"'; ?> value="13">13</option>
      <option <?php if($day == "14") echo 'selected="selected"'; ?> value="14">14</option>
      <option <?php if($day == "15") echo 'selected="selected"'; ?> value="15">15</option>
      <option <?php if($day == "16") echo 'selected="selected"'; ?> value="16">16</option>
      <option <?php if($day == "17") echo 'selected="selected"'; ?> value="17">17</option>
      <option <?php if($day == "18") echo 'selected="selected"'; ?> value="18">18</option>
      <option <?php if($day == "19") echo 'selected="selected"'; ?> value="19">19</option>
      <option <?php if($day == "20") echo 'selected="selected"'; ?> value="20">20</option>
      <option <?php if($day == "21") echo 'selected="selected"'; ?> value="21">21</option>
      <option <?php if($day == "22") echo 'selected="selected"'; ?> value="22">22</option>
      <option <?php if($day == "23") echo 'selected="selected"'; ?> value="23">23</option>
      <option <?php if($day == "24") echo 'selected="selected"'; ?> value="24">24</option>
      <option <?php if($day == "25") echo 'selected="selected"'; ?> value="25">25</option>
      <option <?php if($day == "26") echo 'selected="selected"'; ?> value="26">26</option>
      <option <?php if($day == "27") echo 'selected="selected"'; ?> value="27">27</option>
      <option <?php if($day == "28") echo 'selected="selected"'; ?> value="28">28</option>
      <option <?php if($day == "29") echo 'selected="selected"'; ?> value="29">29</option>
      <option <?php if($day == "30") echo 'selected="selected"'; ?> value="30">30</option>
      <option <?php if($day == "31") echo 'selected="selected"'; ?> value="31">31</option>
    </select>
    
    <select id="month" name="month" class="input-small" required="">
      <option value="">Month</option>
      <option <?php if($mnth == "Jan") echo 'selected="selected"'; ?> value="Jan">Jan</option>
      <option <?php if($mnth == "Feb") echo 'selected="selected"'; ?> value="Feb">Feb</option>
      <option <?php if($mnth == "Mar") echo 'selected="selected"'; ?> value="Mar">Mar</option>
      <option <?php if($mnth == "Apr") echo 'selected="selected"'; ?> value="Apr">Apr</option>
      <option <?php if($mnth == "May") echo 'selected="selected"'; ?> value="May">May</option>
      <option <?php if($mnth == "Jun") echo 'selected="selected"'; ?> value="Jun">Jun</option>
      <option <?php if($mnth == "Jul") echo 'selected="selected"'; ?> value="Jul">Jul</option>
      <option <?php if($mnth == "Aug") echo 'selected="selected"'; ?> value="Aug">Aug</option>
      <option <?php if($mnth == "Sep") echo 'selected="selected"'; ?> value="Sep">Sep</option>
      <option <?php if($mnth == "Oct") echo 'selected="selected"'; ?> value="Oct">Oct</option>
      <option <?php if($mnth == "Nov") echo 'selected="selected"'; ?> value="Nov">Nov</option>
      <option <?php if($mnth == "Dec") echo 'selected="selected"'; ?> value="Dec">Dec</option>
    </select>
    
    <input type="hidden" value="<?php echo $this->member->dob; ?>" />
    
    Year <input id="year" name="year" size="4" placeholder="e.g: 1982" value="<?php echo $year; ?>" class="input-mini" required="" type="text">
  </div>
</div>


<h4>Contact Details</h4>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email">Email</label>
  <div class="controls">
    <input id="email" name="email" placeholder="Email" class="input-xlarge" value="<?php echo $this->member->email; ?>" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="cell_number">Cell Number</label>
  <div class="controls">
    <input id="cell_number" name="cell_number" value="<?php echo $this->member->cell_number; ?>" placeholder="Cellphone Number" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="work_number">Work Number</label>
  <div class="controls">
    <input id="work_number" value="<?php echo $this->member->work_number; ?>" name="work_number" placeholder="Work Number" class="input-xlarge" type="text">
    
  </div>
</div>


<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="address">Physical Address</label>
  <div class="controls">                     
    <textarea id="address" rows="3" required="" name="address"><?php echo $this->member->address; ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="address_code">Code</label>
  <div class="controls">
    <input id="address_code" name="address_code" placeholder="Code" value="<?php echo $this->member->address_code; ?>"class="input-mini" required="" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="postal_address">Postal Address</label>
  <div class="controls">                     
    <textarea id="postal_address" required="" rows="3" name="postal_address"><?php echo $this->member->postal_address; ?></textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="postal_code">Code</label>
  <div class="controls">
    <input id="postal_code" name="postal_code" placeholder="Code" value="<?php echo $this->member->address_code; ?>" class="input-mini" required="" type="text">
    
  </div>
</div>

<h4>Bank Details</h4>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="bank_name">Bank Name</label>
  <div class="controls">
    <input id="bank_name" name="bank_name" placeholder="Bank name" value="<?php echo $this->member->bank_name; ?>" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="account_name">Account Name</label>
  <div class="controls">
    <input id="account_name" name="account_name" placeholder="Name of your account" value="<?php echo $this->member->account_name; ?>" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="account_number">Account Number</label>
  <div class="controls">
    <input id="account_number" name="account_number" placeholder="Account Number" value="<?php echo $this->member->account_number; ?>" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="branch_name">Branch Name</label>
  <div class="controls">
    <input id="branch_name" name="branch_name" placeholder="Branch Name" value="<?php echo $this->member->branch_name; ?>" class="input-xlarge" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="branch_code">Branch Code</label>
  <div class="controls">
    <input id="branch_code" name="branch_code" placeholder="Branch code" value="<?php echo $this->member->branch_code; ?>" class="input-xlarge" type="text">
  </div>
</div>

<input type="hidden" name="userid" value="<?php echo $this->member->userid; ?>" />
<input type="hidden" name="id" value="<?php echo $this->member->id; ?>" />
<?php echo JHtml::_('form.token'); ?>

<!-- Button (Double) -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
    <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=members'); ?>" class="btn" type="button">
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
        $('#editmember').on('submit', function (event) {
            var formObj = formToObject('editmember'), result;
            
            result = (isEmail(formObj.email) && formObj.title);
            
            if (!result) {
                alert('Please check that you have entered all details correctly');
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
