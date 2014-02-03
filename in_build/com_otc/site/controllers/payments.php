<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');


class OtcControllerPayments extends JController
{
	function display() {
		$application =& JFactory::getApplication();
        $model =& $this->getModel('payments');
        $view->display();
    }
	
	
}