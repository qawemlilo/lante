<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewSelling extends JView {
    function display($tpl = null) {
        $application =& JFactory::getApplication();
        
        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $this->pagination = $this->get('Pagination');
        $this->transactions = $this->get('Transactions'); 
        
        parent::display($tpl);
    }
    
    
    
    
    private function isAuthorized() {
        $user =& JFactory::getUser();
        if ($user->authorize( 'com_content', 'edit', 'content', 'all' )) {
            return true;
        }
        
        return false;
    }
    
    
    
    
    function centsToRands($cents) {
        return number_format($cents/100, 2);
    }
    
    
    
    
    function getStatus($pending, $date) {
        $status = '';
        $today = new DateTime('today');
        $expiry_date = new DateTime($date);
        
        if (!$pending) {
            $status = 'Matched';
        }
        elseif ($pending && $expiry_date < $today) {
            $status = 'Expired';
        }
        else {
            $status = 'Pending';
        }
        
        return $status;
    }
    
    
    
    
    function parseUrl($url) {
        return JRoute::_($url);
    }
}
