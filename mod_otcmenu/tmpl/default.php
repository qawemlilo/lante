<?php 
defined('_JEXEC') or die('Restricted access'); // no direct access 
$view = JRequest::getVar('view');
?>

<ul class="nav nav-pills pull-right" style="margin-top: 10px; margin-right: 10px">
   <li <?php if ($view == 'featured') echo 'class="active"'; ?>><a href="<?php echo JURI::base(); ?>">Home</a></li>
   <li <?php if ($view == 'companies') echo 'class="active"'; ?>><a href="<?php echo JRoute::_('index.php?option=com_otc&view=companies'); ?>">All Listed Companies</a></li>
   <li <?php if ($view == 'trade') echo 'class="active"'; ?>><a href="<?php echo JRoute::_('index.php?option=com_otc&view=trade'); ?>">Buy / Sell Shares</a></li>
   <li <?php if ($view == 'profile') echo 'class="active"'; ?>><a href="<?php echo JRoute::_('index.php?option=com_otc&view=profile'); ?>">My Profile</a></li>
   <li>
    <form class="form-horizontal" method="post" action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" style="margin-top: 20px">
      <button class="btn btn-primary" style="margin-left: 10px" type="submit"><i class="icon-lock icon-white"></i> Logout</button>
      <input type="hidden" value="<?php echo base64_encode('/index.php'); ?>" name="return">
	  <?php echo JHtml::_('form.token'); ?>
	</form>
   </li>
</ul>
