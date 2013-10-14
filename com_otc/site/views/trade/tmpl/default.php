<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access'); 

$document =& JFactory::getDocument();
$style = '
  .pdetails {
    margin-bottom: 0px;
  }
  .pdetails .control-group {
    padding-top: 5px;
  }
  .pdetails .control-group label {
    width: 120px;
    margin-left: 5px;
    font-size:12px;
    font-color:#333;
    font-weight: bold;
  }
  
  .pdetails .control-group .controls {
    text-align: right;
  }
  
  .pdetails .control-group .controls input[type=text], .pdetails .control-group .controls textarea, .pdetails .control-group .controls strong {
    margin-right: 5px;
  }
  
  .pdetails .control-group {
    background-color: #fff;
  }
  
  .table tbody {
    background-color:#f5f5f5;
  }
  
  table .text-center {text-align: center}
';
$document->addStyleDeclaration($style);
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
              I Want To Buy Shares <input type="checkbox" id="buyshares" value="" class="pull-right">
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr>
            <td>
                
              <form class="pdetails">

                <div class="control-group" style="background-color:#fd7800; color:#fff">
                  <label class="control-label" for="name" style="width:180px; margin-bottom:10px">Cash Amount Available</label>
                  <div class="controls">
                    <strong>R<?php if($this->member->balance) echo $this->centsToRands($this->member->balance); else echo '0.00' ?></strong>
                  </div>
                </div>
                                
                <div class="control-group">
                  <label class="control-label" for="name">Select Company:</label>
                  <div class="controls">
                    <?php echo $this->companiesDropdown; ?>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="middle_name">Number of Shares:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" name="num_shares">
                  </div>
                </div>
                
                
                <div class="control-group">
                  <label class="control-label" for="surname">Bidding Price:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" name="bidding_price">
                  </div>
                </div>
                
                <hr style="margin: 5px 0px; height:5px; background-color:#fd7800;" />
                
                <div class="control-group">
                  <label class="control-label" for="surname">Matched Price:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="matched_price" name="matched_price">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="surname">Transaction Fee:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="matched_price" name="matched_price">
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="surname">Security Fee:</label>
                  <div class="controls">
                    <input value="" class="input-large" type="text" id="matched_price" name="matched_price">
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
              I want To Sell My Shares <input type="checkbox" id="buyshares" value="" class="pull-right">
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
