<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewCompanies extends JView
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
            case 'newcompany':
                $this->pagination = false;
            break;
            
            case 'editcompany':
                $this->company = $this->get('Company');
                $this->pagination = false;
            break;
            
            case 'sell':
                $this->companies = $this->get('Comps');
            break;
            
            default:
                if (!$layout) {
                    $this->pagination = $this->get('Pagination');
                    $this->companies = $this->get('Companies'); 
                }
        }
        
        parent::display($tpl);
    }
    
    
    
    
    private function getUser($id) {
        $user =& JFactory::getUser($id);
        
        return $user;
    }
    
    
    
    
    public function companiesList($id, $name) {
        $select = '<select id="' . $id . '" name="' . $name . '">';
        $select .= '<option value="">Select Company</option>';
        
        if(!empty($this->companies) && count($this->companies) > 0) {
            foreach($this->companies as $company) {
                $select .= '<option data-shareprice="' . $company->share_price . '" data-shares="' . $company->available_shares . '" value="' . $company->id . '" >' . $company->name . '</option>';
            }
        }
        
        $select .= '</select>';
        
        return $select;
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
