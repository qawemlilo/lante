<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$me =& JFactory::getUser();
?>

<h5>Identification Details</h5>
<dl class="dl-horizontal">
  <dt>Title</dt>
  <dd>...</dd>
  
  <dt>Name</dt>
  <dd><?php echo $user->name; ?></dd>

  <dt>Middle Name</dt>
  <dd>...</dd>
  
  <dt>Surname</dt>
  <dd>...</dd>
  
  <dt>Date of birth</dt>
  <dd>...</dd>
</dl>
  