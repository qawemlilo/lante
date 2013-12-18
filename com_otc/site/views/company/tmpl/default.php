<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addStyleDeclaration('.media-body p {margin-bottom: 2px; font-size:13px}');
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
        <p><strong style="color:#fd7800">Company Owner:</strong> <?php echo $this->company->owner_name; ?></p>
        <p><strong style="color:#fd7800">Contact Us:</strong> <a href="mailto:<?php echo $this->company->company_email; ?>" target="_blank"><?php echo $this->company->company_email; ?></a></p>
        <p><strong style="color:#fd7800">Company Location:</strong> <?php echo $this->company->company_address; ?></p>  
      </div>
    </div>
    <p style="margin-top:10px"><a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=trade'); ?>" class="btn btn-success" style="margin-left:10px">Buy Shares</a></p>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="3">
              Top 5 bids to buy
            </th>
          </tr>
          <tr>
            <th class="text-center">#</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price (c)</th>
          </tr>
        </thead>
        <tbody>
        <?php
          foreach($this->buybids as $buybid) :
        ?>
          <tr>
            <td class="text-center">1</td>
            <td class="text-center"><?php echo $buybid->num_shares; ?></td>
            <td class="text-center"><?php echo $buybid->bidding_price; ?></td>
          </tr>
       <?php
        endforeach;
       ?>
       </tbody>      
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="3">
              Top 5 offers to sell
            </th>
          </tr>
           <tr>
            <th class="text-center">#</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price (c)</th>
          </tr>
        </thead> 
        <tbody>
        <?php
          foreach($this->sellbids as $sellbid) :
        ?>
          <tr>
            <td class="text-center">1</td>
            <td class="text-center"><?php echo $sellbid->num_shares; ?></td>
            <td class="text-center"><?php echo $sellbid->selling_price; ?></td>
          </tr>
       <?php
        endforeach;
       ?>
       </tbody>     
      </table>
    </div>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="3">
              Market Info
            </th>
          </tr>
        </thead>
        
        <tbody>
          <tr>
            <td class="listings-header">&nbsp;</td>
            <td class="listings-header">Today</td>
            <td class="listings-header">Previous close</td>
          </tr>
          <tr>
            <td>Price (c)</td>
            <td><?php echo $this->myFormat($this->summary->share_price); ?></td>
            <td><?php echo $this->myFormat($this->summary->price["prev"]); ?></td>
          </tr>
          <tr>
            <td>Movement (c)</td>
            <td><?php echo $this->myFormat($this->summary->movement["today"]); ?></td>
            <td><?php echo $this->myFormat($this->summary->movement["prev"]); ?></td>
          </tr>
          <tr>
            <td>Movement %</td>
            <td><?php if($this->summary->movement["today"] && $this->summary->price["today"]) echo $this->myFormat(($this->summary->movement["today"] / $this->summary->price["today"]) * 100); else echo '0'; ?>%</td>
            <td><?php if($this->summary->movement["prev"] && $this->summary->price["prev"]) echo $this->myFormat(($this->summary->movement["prev"] / $this->summary->price["prev"]) * 100); else echo '0'; ?>%</td>
          </tr>
          <tr>
            <td>Value</td>
            <td><?php echo $this->myFormat($this->summary->value["today"]); ?></td>
            <td><?php echo $this->myFormat($this->summary->value["prev"]); ?></td>
          </tr>                
          <tr>
            <td>No. of Trades</td>
            <td><?php echo $this->myFormat($this->summary->num_trades["today"]); ?></td>
            <td><?php echo $this->myFormat($this->summary->num_trades["prev"]); ?></td>
          </tr>
          <tr>
            <td>Low Price (c)</td>
            <td ><?php echo $this->myFormat($this->summary->lowest_price["today"]); ?></td>
            <td ><?php echo $this->myFormat($this->summary->lowest_price["prev"]); ?></td>
          </tr>      
          <tr>
            <td>High Price (c)</td>
            <td><?php echo $this->myFormat($this->summary->highest_price["today"]); ?></td>
            <td><?php echo $this->myFormat($this->summary->highest_price["prev"]); ?></td>
          </tr>  
        </tbody>        
      </table>
      
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="2">
              Market Stats
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>12 Month Low Price (c)</td>
            <td><?php echo $this->stats->lowest_price; ?></td>
          </tr>
          <tr>
            <td>12 Month High Price (c)</td>
            <td><?php echo $this->stats->highest_price; ?></td>
          </tr> 
          <tr>
            <td>Shares in Issue</td>
            <td><?php echo $this->summary->shares_in_issue; ?></td>
          </tr>
          <tr>
            <td>Market Cap</td>
            <td>R<?php echo $this->centsToRands($this->summary->shares_in_issue * $this->summary->share_price); ?></td>
          </tr>           
        </tbody>           
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="4">
              Last 10 Trades
            </th>
          </tr>
          <tr>
            <th class="text-center">Date</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Price (c)</th>
            <th class="text-center">Value (R)</th>
          </tr>
        </thead>
        <tbody>
        <?php
          foreach($this->trades as $trade) :
        ?>
          <tr>
            <td class="text-center"><?php echo $this->formatTime($trade->ts); ?></td>
            <td class="text-center"><?php echo $trade->num_shares; ?></td>
            <td class="text-center"><?php echo $trade->share_price; ?></td>
            <td class="text-center">R<?php echo $this->centsToRands($trade->num_shares * $trade->share_price); ?></td>
          </tr>
       <?php
        endforeach;
       ?>
       </tbody>       
      </table>
    </div>
  </div>
</div>
