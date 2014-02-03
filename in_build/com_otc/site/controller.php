<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');
class OtcController extends JController
{
	function display() {
        $view = JRequest::getVar('view');
        if(!$view || $view == "members") {
            JRequest::setVar('view', 'members');
        }
                parent::display();    }}
