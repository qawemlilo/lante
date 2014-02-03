<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addStyleDeclaration('#limit {width: 60px}');
?>

<div style="width:98%">

<div>
   <ul class="nav nav-pills" style="margin-bottom: 0px">
    <li>
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=members'); ?>"><i class="icon-user"></i> Registered Members</a>
    </li>
    <li>
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=companies'); ?>"><i class="icon-briefcase"></i> Listed Companies</a>
    </li>
    <li>
      <a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=admin&layout=transactions'); ?>"><i class="icon-signal"></i> Transactions</a>
    </li>
  </ul>
  <hr style="margin-top: 0px" />
</div>

<h3>Sell Tranches</h3>

<div class="row-fluid" style="margin-bottom: 10px">
  <div class="span4">
    <form action="<?php echo $this->parseUrl('index.php?option=com_otc&view=buying'); ?>" style="margin-bottom: 0px" method="post" name="pagination-form">
    Display # <?php echo @$this->pagination->getLimitBox() ;?>
    </form>
  </div>

  <div class="span8" style="text-align:right">
  </div>
</div>
 
<div class="row-fluid"> 
  <?php
  if (is_array($this->transactions) && count($this->transactions) > 0) :
  ?>
  
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th style="text-align:center">Date/Time</th>
        <th style="text-align:center">Selling Price</th>
        <th style="text-align:center">Company</th>
        <th style="text-align:center">Account #</th>
        <th style="text-align:center">Expiry Date</th>
        <th style="text-align:center">Status</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach($this->transactions as $transaction) :
    ?>
        <tr>
          <td style="text-align:center"><?php echo $transaction->ts; ?></td>
          <td style="text-align:center">R<?php echo $this->centsToRands((int)$transaction->selling_price); ?></td>
          <td style="text-align:center"><?php echo $transaction->company; ?></td>
          <td style="text-align:center"><?php echo $transaction->account_number; ?></td>
          <td style="text-align:center"><?php echo $transaction->expiry_date; ?></td>
          <td style="text-align:center"><?php echo $this->getStatus($transaction->pending, $transaction->expiry_date); ?></td>
        </tr>
    <?php
      endforeach;
    ?>
    </tbody>
  </table>

  <?php
    endif;
  ?>
</form>
</div>
<div class="row-fluid" style="text-align: center; border-top: 0px">
    <?php echo @$this->pagination->getPagesLinks(); ?>
</div>

</div>
