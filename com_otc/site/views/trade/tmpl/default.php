<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access'); 
$document =& JFactory::getDocument();
$document->addStyleDeclaration('table .text-center {text-align: center}');
?>

<div style="width:98%;">
  <div id="breadcrumbs" style="margin-bottom: 10px">
    <div class="module">
      <div class="breadcrumbs">
        <a href="/" class="pathway">Home</a> 
        &nbsp;<i class="icon-caret-right"></i>&nbsp; 
        <span>Buy / Sell Shares</span>
      </div>
    </div>
  </div>
  
  <div class="row-fluid">
  <table class="table table-bordered">
   <thead>
    <tr>
      <th>
        Buy-Sell Shares
      </th>
    </tr>
  </thead>
  
  <tbody style="background-color:#f5f5f5;">
    <tr>
      <td>
        The calculation below assist you to obtain accurate values to either sell or buy your shares. Please note we will only process your transaction after a match is made and communication will be sent to you using your preferred method of notification.
      </td>
    </tr>
  </tbody>
 </table>
 </div>
 
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              I Want To Buy Shares
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr>
            <td>
            <!-- <?php /*
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
              */ ?> -->
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
              I want To Sell My Shares
            </th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>
              

            </td>
          </tr>
        </tbody>         
      </table>
      
    </div>
  </div>
</div>