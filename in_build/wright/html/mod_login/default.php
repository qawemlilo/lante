<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');
?>
<?php if ($type == 'logout') : ?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form">
<?php if ($params->get('greeting')) : ?>
	<div class="login-greeting">
	<?php if($params->get('name') == 0) : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
	} else : {
		echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
	} endif; ?>
	</div>
<?php endif; ?>
	<div class="logout-button">
		<input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" />
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
<?php else : ?>

<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" class="qawe form-inline" id="login-form" >

  <?php if ($params->get('pretext')): ?>
    <div class="pretext row-fluid">
		<p><?php echo $params->get('pretext'); ?></p>
	</div>
  <?php endif; ?>
    
  <div class="row-fluid">
    <div id="form-login-username" class="span5">
      <label class="strong" for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
      <input id="modlgn-username" type="text" name="username" class="inputbox">
    </div>
    
    <div id="form-login-password" class="span5">
      <label class="strong" for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
      <input id="modlgn-passwd" type="password" name="password" class="inputbox">
    </div>
    
    <div class="span2">
        <input type="submit" name="Submit" class="button" value="" />
    </div>    
  </div>
  
  <div class="row-fluid f-links">
    <?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
      <div class="span5">
        <input id="modlgn-remember" type="checkbox" name="remember" class="inputbox" value="yes"/> <?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?>
      </div>
    <?php endif; ?>
      <div class="span6">
        <a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>"> 
          <?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?>
        </a>
      </div>
  </div>
    
	<input type="hidden" name="option" value="com_users" />
	<input type="hidden" name="task" value="user.login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHtml::_('form.token'); ?>
	</fieldset>
    <!--
	<ul>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
		</li>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
			<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
		</li>
		<?php
		$usersConfig = JComponentHelper::getParams('com_users');
		if ($usersConfig->get('allowUserRegistration')) : ?>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">
				<?php echo JText::_('MOD_LOGIN_REGISTER'); ?></a>
		</li>
		<?php endif; ?>
	</ul>
    -->
	<?php if ($params->get('posttext')): ?>
		<div class="posttext row-fluid">
		<p><?php echo $params->get('posttext'); ?></p>
		</div>
	<?php endif; ?>
</form>
<?php endif; ?>
