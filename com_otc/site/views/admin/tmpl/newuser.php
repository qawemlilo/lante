<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div class="row-fluid">
<form class="form-horizontal">
<fieldset style="border: 1px solid #ccc; padding: 20px;">

<legend style="margin-bottom: 0px">Add New Member</legend>

<!-- Form Name -->
<h4>Personal Details</h4>

<!-- Select Basic -->
<div class="control-group">
  <label class="control-label" for="Title">Title</label>
  <div class="controls">
    <select id="Title" name="Title" class="input-medium">
      <option>Select</option>
      <option>Mr.</option>
      <option>Mrs.</option>
      <option>Miss</option>
      <option>Ms</option>
      <option>Dr.</option>
      <option>Prof.</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="name">Name</label>
  <div class="controls">
    <input id="name" name="name" placeholder="First name" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="middlename">Middle Name</label>
  <div class="controls">
    <input id="middlename" name="middlename" placeholder="Middle Name" class="input-xlarge" required="" type="text">
    
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
    <input id="dob" name="dob" placeholder="e.g: 01 Aug 1982" class="input-xlarge" required="" type="text">
    
  </div>
</div>


<h4>Contact Details</h4>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email">Email</label>
  <div class="controls">
    <input id="email" name="email" placeholder="Email" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="cell">Cell Number</label>
  <div class="controls">
    <input id="cell" name="cell" placeholder="Cellphone Number" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="worknumber">Work Number</label>
  <div class="controls">
    <input id="worknumber" name="worknumber" placeholder="Work Number" class="input-xlarge" required="" type="text">
    
  </div>
</div>


<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="address">Physical Address</label>
  <div class="controls">                     
    <textarea id="address" name="address"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="code">Code</label>
  <div class="controls">
    <input id="code" name="code" placeholder="Code" class="input-mini" required="" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="control-group">
  <label class="control-label" for="postaladdress">Postal Address</label>
  <div class="controls">                     
    <textarea id="postaladdress" name="postaladdress"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="postalcode">Code</label>
  <div class="controls">
    <input id="postalcode" name="postalcode" placeholder="Code" class="input-mini" required="" type="text">
    
  </div>
</div>

<h4>Bank Details</h4>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="bank">Bank Name</label>
  <div class="controls">
    <input id="bank" name="bank" placeholder="Bank name" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="accountname">Account Name</label>
  <div class="controls">
    <input id="accountname" name="accountname" placeholder="Name of your account" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="accountnumber">Account Number</label>
  <div class="controls">
    <input id="accountnumber" name="accountnumber" placeholder="Account Number" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="branch">Branch Name</label>
  <div class="controls">
    <input id="branch" name="branch" placeholder="Branch Name" class="input-xlarge" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="branchnumber">Branch Number</label>
  <div class="controls">
    <input id="branchnumber" name="branchnumber" placeholder="Branch number" class="input-xlarge" required="" type="text">
    
  </div>
</div>

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

</fieldset>
</form>

</div>