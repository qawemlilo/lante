<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$style = '
  .pdetails {
    margin-bottom: 0px;
  }
  .pdetails .control-group {
    padding-top: 10px;
  }
  .pdetails .control-group label {
    width: 90px;
    margin-left: 5px;
    font-size:14px;
    font-color:#333;
  }
  
  .pdetails .control-group .controls {
    text-align: right;
  }
  
  .pdetails .control-group .controls input[type=text], .pdetails .control-group .controls textarea {
    margin-right: 5px;
  }
  
  .pdetails .control-group {
    background-color: #fff;
  }
  
  .table tbody {
    background-color:#f5f5f5;
  }
';
$document->addStyleDeclaration($style);
?>

<div style="width:98%;">
  <div id="breadcrumbs" style="margin-bottom: 10px">
    <div class="module">
      <div class="breadcrumbs">
        <a href="/" class="pathway">Home</a> 
        &nbsp;<i class="icon-caret-right"></i>&nbsp; 
        <span>Personal Profile</span>
      </div>
    </div>
  </div>

  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Personal Details
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr>
            <td>
              <form class="pdetails">
                <div class="control-group">
                  <label class="control-label" for="title">Title:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->title) echo $this->member->title; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="name">Name:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->name) echo $this->member->name; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="middle_name">Middle Name:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->middle_name) echo $this->member->middle_name; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="surname">Surname:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->surname) echo $this->member->surname; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="dob">Date of Birth:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->dob) echo $this->member->dob; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
              </form>
            </td>
          </tr>
        </tbody>
      </table>
      
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Banking Details
            </th>
          </tr>
        </thead> 

        <tbody>
          <tr>
            <td>
              <form class="pdetails">
                <div class="control-group">
                  <label class="control-label" for="account_name">Acc. Name:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->account_name) echo $this->member->account_name; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="bank_name">Bank Name:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->bank_name) echo $this->member->bank_name; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="account_number">Acc. Number:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->account_number) echo $this->member->account_number; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="branch_name">Branch Name:</label>
                  <div class="controls">
                    <input readonly="readonly" value="<?php if($this->member->branch_name) echo $this->member->branch_name; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="branch_code">Branch Code:</label>
                  <div class="controls"  style="text-align:left">
                    <input readonly="readonly" value="<?php if($this->member->branch_code) echo $this->member->branch_code; ?>" class="input-small" type="text">
                  </div>
                </div>
              </form>
            </td>
          </tr>
        </tbody>        
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Contact Details
            </th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              <form class="pdetails">
                <div class="control-group">
                  <label class="control-label">Communication:</label>
                  <div class="controls">
                    SMS <input type="radio" name="contact_method" value="sms"> Email <input type="radio" name="contact_method" value="email">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="cell_number">Cell Number:</label>
                  <div class="controls">
                    <input id="cell_number" name="cell_number" value="<?php if($this->member->cell_number) echo '0' . $this->member->cell_number; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="work_number">Work Number:</label>
                  <div class="controls">
                    <input id="work_number" name="work_number" value="<?php if($this->member->work_number) echo '0' . $this->member->work_number; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="email">Email:</label>
                  <div class="controls">
                    <input id="email" name="email" value="<?php if($this->member->email) echo $this->member->email; ?>" class="input-xlarge" type="text">
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="address">Physical Add:</label>
                  <div class="controls">
                     <textarea id="address" readonly="readonly" rows="3" required="" class="input-xlarge" name="address"><?php echo $this->member->address; ?></textarea>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="address_code">Code:</label>
                  <div class="controls"  style="text-align:left">
                     <input readonly="readonly" value="<?php if($this->member->address_code) echo $this->member->address_code; ?>" class="input-small" type="text">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="postal_address">Postal Add:</label>
                  <div class="controls">
                     <textarea readonly="readonly" rows="3" required="" class="input-xlarge"><?php echo $this->member->postal_address; ?></textarea>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="postal_code">Postal Code:</label>
                  <div class="controls" style="text-align:left">
                     <input readonly="readonly" value="<?php if($this->member->postal_code) echo $this->member->postal_code; ?>" class="input-small" type="text">
                  </div>
                </div>
              </form>
              
              <p><a href="#myModal" role="button" data-toggle="modal">I want to change may login password. Click here</a></p>
              <!-- Modal -->
              <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 id="myModalLabel">Change Password</h3>
                </div>
                <div class="modal-body">
              <form class="form-horizontal">
                <div class="control-group">
                  <label class="control-label" for="cell_number">Old Password:</label>
                  <div class="controls">
                    <input id="cell_number" name="cell_number" value="" class="input-xlarge" type="password">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="work_number">New Password:</label>
                  <div class="controls">
                    <input id="work_number" name="work_number" value="" class="input-xlarge" type="password">
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="email">Re-type New Password:</label>
                  <div class="controls">
                    <input id="email" name="email" value="" class="input-xlarge" type="password">
                  </div>
                </div>
              </form>
                </div>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                  <button class="btn btn-primary">Save changes</button>
                </div>
              </div>
              

            </td>
          </tr>
        </tbody>         
      </table>
      
      <p>Should you wish to update your contact details kindly contact us and send us supporting documents.</p>
    </div>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>
            My Investment
          </th>
        </tr>
      </thead> 
      <tbody>
        <tr>
          <td>
            <p><strong class="pull-left" style="color:#fd7800">Buying Balance</strong> <strong class="pull-right">R10,000.00<strong></p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/bootstrap.min.js'; ?>"></script>
<script type="text/javascript">
jQuery.noConflict();

(function ($) {
  $('#myModal').modal({
      keyboard: false,
      show: false
  });
}(jQuery));
</script>
  