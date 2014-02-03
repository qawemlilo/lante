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
$document->addStyleSheet(JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/css/ui-lightness/jquery-ui-1.10.3.custom.min.css');
$document->addStyleDeclaration($style);
$document->addScript(JURI::base() . 'components/com_otc/assets/js/accounting.min.js');
?>

<div style="width:98%;">

  <div id="breadcrumbs" style="margin-bottom: 10px">
    <div class="module">
      <div class="breadcrumbs">
        <a href="/" class="pathway">Home</a> 
        &nbsp;<i class="icon-caret-right"></i>&nbsp; 
        <span>Planning</span>
      </div>
    </div>
  </div>
  
  
 
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <input type="checkbox" id="buyshares" value="buyshares" style="margin:0px;"> I want to make changes in my target plan 
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr>
            <td>
               
              <form class="pdetails" name="buysharesform" id="buysharesform" action="index.php?option=com_otc&task=planning.edittargetplan" method="post" >
                
                

                <?php echo JHtml::_('form.token'); ?>
                <input type="hidden" name="memberid" value="<?php echo $this->planning->memberid; ?>" />
                <input type="hidden" name="userid" value="<?php echo $this->planning->userid; ?>" />
                <input type="hidden" name="share_price" id="share_price" value="" />
                <input type="hidden" name="company_name" id="company_name" value="" />
                <input type="hidden" name="id" value="<?php if($this->planning && $this->planning->id) echo $this->planning->id; ?>" />                
                <div class="control-group">
                  <label class="control-label" for="companyid">Select Company:</label>
                  <div class="controls">
                    
                    <select id="companyid" name="companyid">
					<option value="">Select Company</option>
                    
					<?php 
					if(!empty($this->companies) && count($this->companies) > 0) {
						foreach($this->companies as $company) {
					?>	
							<option <?php if($this->planning->companyid == $company->id) { ?> selected="selected" <?php } ?> data-shareprice="<?php echo $company->share_price; ?>" value="<?php echo $company->id; ?>" ><?php echo $company->name; ?></option>
                    <?php        
						}
					}
					?>
					
                    </select>
					
					
					
					<?php // echo $this->companiesList('companyid', 'companyid'); ?> &nbsp;
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="num_shares">Number of Shares:</label>
                  <div class="controls">
                    <input value="<?php if($this->planning->num_shares) echo $this->planning->num_shares; else echo 0;?>" class="input-large" type="text" id="num_shares" name="num_shares" required="" autocomplete="off" />
                  </div>
                </div>
                
               
                
                <div class="control-group">
                  <label class="control-label" for="expiry_date">When:</label>
                  <div class="controls">
                  	<?php $dbdate = explode("-", $this->planning->when_to_purchase); 
						$wdate = date("j M Y", mktime(0, 0, 0, $dbdate[1], $dbdate[2], $dbdate[0]));
					?>
                    <input value="<?php if($wdate) echo $wdate; else echo "";?>" class="input-large" type="text" id="expiry_date" name="when_date" required="" autocomplete="off" />
                  </div>
                </div>
                
                <hr style="margin: 5px 0px; height:5px; background-color:#fd7800;" />
                
            
                
          
                
                <div class="control-group" style="padding-top: 5px;padding-bottom:5px;">
                  <label class="control-label" for="submit">&nbsp;</label>
                  <div class="controls">
                    <input value="Submit" class="btn btn-primary" style="font-weight:bold; color:#fff" type="submit" name="submit" />  &nbsp;
                  </div>
                </div>
                
              </form>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    
    
  </div>
</div>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/libs/jquery-ui/js/jquery-ui-1.10.3.custom.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo JURI::base() . 'components/com_otc/assets/js/script-planning.js'; ?>"></script>
