<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewPlanning extends JView
{
    function display($tpl = null) {
        $application =& JFactory::getApplication();
		$layout = JRequest::getVar('layout', '', 'get', 'string');
        
        //Check if user is authorized to view this page
        $this->userplannings = $this->get('UserPlannings');
		
		if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
		if($this->isMaxTranches()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
		
		
		
		
		
		switch ($layout) {
           
            
            case 'editplanning':
                $this->planning = $this->get('Planning');
                $this->companies = $this->get('Companies');
       			$this->member = $this->get('Member');
            break;
            
            
            default:
                if (!$layout) {
                    $this->companies = $this->get('Companies');
       				$this->member = $this->get('Member');
                }
        }
		
        
//        $this->companies = $this->get('Companies');
//        $this->member = $this->get('Member');
        
        parent::display($tpl);
    }
    
    
    
    public function companiesList($id, $name) {
        $select = '<select id="' . $id . '" name="' . $name . '">';
        $select .= '<option value="">Select Company</option>';
        
        if(!empty($this->companies) && count($this->companies) > 0) {
            foreach($this->companies as $company) {
                $select .= '<option data-shareprice="' . $company->share_price . '" value="' . $company->id . '" >' . $company->name . '</option>';
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
	
	
	public function isMaxTranches() {
		if(!empty($this->userplannings) && count($this->userplannings) > 5) {
			return true;
		} else {
			return false;
		}
        
    }
    
    
    
    function centsToRands($cents) {
        return number_format($cents/100, 2);
    }
    
    
    
    
    function parseUrl($url) {
        return JRoute::_($url);
    }
}
