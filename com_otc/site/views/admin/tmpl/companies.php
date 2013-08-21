<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>

<div>
   <ul class="nav nav-pills" style="margin-bottom: 0px">
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin'); ?>"><i class="icon-user"></i> Registered Members</a>
    </li>
    <li  class="disabled">
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=companies'); ?>"><i class="icon-briefcase"></i> Listed Companies</a>
    </li>
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=transactions'); ?>"><i class="icon-signal"></i> Transactions</a>
    </li>
  </ul>
  <hr style="margin-top: 0px" />
</div>