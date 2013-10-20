<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div style="width:98%">
   <ul class="nav nav-pills" style="margin-bottom: 0px">
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=members'); ?>"><i class="icon-user"></i> Registered Members</a>
    </li>
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=companies'); ?>"><i class="icon-briefcase"></i> Listed Companies</a>
    </li>
    <li class="disabled">
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=transactions'); ?>"><i class="icon-signal"></i> Transactions</a>
    </li>
  </ul>
  <hr style="margin-top: 0px" />
  
  <div class="row-fluid">
    <ul class="thumbnails">
      <li class="span3">
        <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=bank'); ?>" class="thumbnail" style="padding-top: 10px; padding-bottom: 10px; text-align: center">
          <img src="<?php echo JRoute::_(JURI::base() . 'components/com_otc/assets/images/bank-icon.png'); ?>" alt="" style="width:48px; height: 48px;display:block; margin-bottom: 10px">
          Money Transactions
        </a>
      </li>
      <li class="span3">
        <a href="#" class="thumbnail" style="padding-top: 10px; padding-bottom: 10px; text-align: center">
          <img src="<?php echo JRoute::_(JURI::base() . 'components/com_otc/assets/images/payment-icon.png'); ?>" alt="" style="width:48px; height: 48px;display:block; margin-bottom: 10px">
          Buying Transactions
        </a>
      </li>
      <li class="span3">
        <a href="#" class="thumbnail" style="padding-top: 10px; padding-bottom: 10px; text-align: center">
          <img src="<?php echo JRoute::_(JURI::base() . 'components/com_otc/assets/images/sell-icon.png'); ?>" alt="" style="width:48px; height: 48px;display:block; margin-bottom: 10px">
          Selling Transactions
        </a>
      </li>
    </ul>
  </div>
</div>
