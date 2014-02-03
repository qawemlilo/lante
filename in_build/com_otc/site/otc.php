<?php
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed by Otc
$controller = JController::getInstance('Otc');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();
