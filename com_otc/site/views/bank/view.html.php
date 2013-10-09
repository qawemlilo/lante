<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewBank extends JView
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
            case 'transaction':
                $this->members = $this->get('Members');
                $this->dropdown = $this->membersList($this->members);
            break;
            
            default:
                if (!$layout) {
                    $this->pagination = $this->get('Pagination');
                    $this->transactions = $this->get('Transactions'); 
                }
        }
        
        parent::display($tpl);
    }
    
    
    
    
    private function getUser($id) {
        $user =& JFactory::getUser($id);
        
        return $user;
    }
    
    
    
    private function membersList($list) {
        $select = '<select name="memberid" id="memberid">';
        $select .= '<option value="">Select Account Holder</option>';
        
        if(!empty($list) && count($list) > 0) {
            foreach($list as $member) {
                $select .= '<option data-accountid="' . $member->account_id . '" value="' . $member->id . '" >' . $member->name . ' ' . $member->surname . '</option>';
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
