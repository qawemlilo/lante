<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addStyleDeclaration('.media-body p {margin-bottom: 2px}');
?>

<div style="width:98%;">
  <div id="breadcrumbs" style="margin-bottom: 10px">
    <div class="module">
      <div class="breadcrumbs">
        <a href="/" class="pathway">Home</a> 
        &nbsp;<i class="icon-caret-right"></i>&nbsp; 
        <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=listedcompanies'); ?>" class="pathway">Listed Companies</a> 
        &nbsp;<i class="icon-caret-right"></i>&nbsp; 
        <span><?php echo $this->company->name?></span>
      </div>
    </div>
  </div>
  
  <div class="row-fluid">
    <div class="media">
      <a class="pull-left" href="<?php echo $this->parseUrl('index.php?option=com_otc&view=company&id=' . $this->company->id);?>" style="margin-right: 10px">
       <img class="media-object img-polaroid" style="width:120px; height: 120px;" src="<?php if (!empty($this->company->logo)) echo 'media/com_otc/logos/' . $this->company->logo; else echo 'http://placehold.it/120&text=Logo+Here'; ?>">
      </a>
      <div class="media-body">
        <h4 class="media-heading" style="margin-bottom:0px;"><?php echo $this->company->name?></h4>
        <p><strong style="color:#fd7800">Website:</strong> <a href="<?php echo $this->company->website; ?>" target="_blank"><?php echo $this->company->website; ?></a></p>
        <p><strong style="color:#fd7800">About Company:</strong> <?php echo $this->company->about; ?></p>
        <p style="margin-bottom:10px;"><strong style="color:#fd7800">Company Owner:</strong> <?php echo $this->company->owner_name; ?></p>
        <p><button class="btn btn-success">Buy Shares</button></p>
      </div>
    </div>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Top 5 bids to buy
            </th>
          </tr>
        </thead>      
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Top 5 bids to sell
            </th>
          </tr>
        </thead>      
      </table>
    </div>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Share Price
            </th>
          </tr>
        </thead>      
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Last 10 Trades
            </th>
          </tr>
        </thead>      
      </table>
    </div>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Market Info
            </th>
          </tr>
        </thead>      
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Market Stats
            </th>
          </tr>
        </thead>      
      </table>
    </div>
  </div>
</div>