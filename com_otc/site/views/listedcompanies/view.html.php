<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewListedcompanies extends JView
{
    function display($tpl = null) {
        $application =& JFactory::getApplication();
        
        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $this->companies = $this->get('Companies');
        $this->pagination = $this->get('Pagination');
        
        parent::display($tpl);
    }
    
    
    
    
    private function isAuthorized() {
        $user =& JFactory::getUser();
        if (!$user->guest) {
            return true;
        }
        
        return false;
    }
    
    
    
    function centsToRands($cents) {
        return number_format($cents/100, 2);
    }
    
    
    function formatTime($cents) {
        return number_format($cents/100, 2);
    }
    
    
    
    
    function parseUrl($url) {
        return JRoute::_($url);
    }
}
