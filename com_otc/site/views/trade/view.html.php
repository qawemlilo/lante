<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewTrade extends JView
{
    function display($tpl = null) {
        $application =& JFactory::getApplication();
        
        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $this->companies = $this->get('Companies');
        $this->member = $this->get('Member');
        $this->companiesDropdown = $this->companiesList($this->companies);
        
        parent::display($tpl);
    }
    
    
    
    private function companiesList($list) {
        $select = '<select name="companyid" id="companyid">';
        $select .= '<option value="">Select Company</option>';
        
        if(!empty($list) && count($list) > 0) {
            foreach($list as $company) {
                $select .= '<option value="' . $company->id . '" >' . $company->name . '</option>';
            }
        }
        
        $select .= '</select>';
        
        return $select;
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
    
    
    
    
    function parseUrl($url) {
        return JRoute::_($url);
    }
}
