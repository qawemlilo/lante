<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewPayments extends JView
{
    function display($tpl = null) {
        $application =& JFactory::getApplication();
		$layout = JRequest::getVar('layout', '', 'get', 'string');
        $id = JRequest::getVar('id', 0, 'get', 'int');
        //Check if user is authorized to view this page
        
		
		if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
		
		
		switch ($layout) {
           
            
            case 'paymentdetail':
                $this->paymentdetail = $this->get('Payment');
            break;
            
            
            default:
                if (!$layout) {
					$this->pagination = $this->get('Pagination');
                    $this->payments = $this->get('Payments');
                }
        }
		
        
//        $this->companies = $this->get('Companies');
//        $this->member = $this->get('Member');
        
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
    
    
    
    
    function parseUrl($url) {
        return JRoute::_($url);
    }
}
