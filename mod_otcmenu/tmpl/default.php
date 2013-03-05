<?php 
defined('_JEXEC') or die('Restricted access'); // no direct access 

?>

<ul class="nav nav-pills pull-right" style="margin-top: 10px; margin-right: 10px">
   <li class="active"><a href="<?php echo JURI::base(); ?>">Home</a></li>
   <li><a href="#">All Listed Companies</a></li>
   <li><a href="#">Buy / Sell Shares</a></li>
   <li>
    <form class="form-horizontal" method="post" action="/index.php/component/users/?task=user.logout" style="margin-top: 20px">
      <button class="button btn btn-primary" type="submit">Log out</button>
      <input type="hidden" value="<?php echo base64_encode('/index.php'); ?>" name="return">
	  <?php echo JHtml::_('form.token'); ?>
	</form>
   </li>
</ul>
