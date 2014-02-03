<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewMembers extends JView
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
            case 'newuser':
                if ($id) {
                    $this->user = $this->getUser($id);
                    $this->users = false;
                }
                else {
                    $this->users = $this->get('Users');
                    $this->user = false;
                }
            break;
            
            case 'edituser':
                    $this->member = $this->get('Member');
            break;
            
            default:
                if (!$layout) {
                    $this->members = $this->get('Members');
                    $this->pagination = $this->get('Pagination');
                }
        }
        
        parent::display($tpl);
    }
    
    
    
    
    private function getUser($id) {
        $user =& JFactory::getUser($id);
        
        return $user;
    }
    
    
    
    function parseDate($date) {
        $mydate = new DateTime($date);
        $dateString = $mydate->format("d,M,Y");
        $dateArr = explode(',', $dateString);
        
        $dob = new stdClass;
        
        $dob->day = $dateArr[0];
        $dob->month = $dateArr[1];
        $dob->year = $dateArr[2];
        
        return $dob;
    }
    
    
    
    
    private function isAuthorized() {
        $user =& JFactory::getUser();
        if ($user->authorize( 'com_content', 'edit', 'content', 'all' )) {
            return true;
        }
        
        return false;
    }
    
    
    
    function parseUrl($url) {
        return JRoute::_($url);
    }
}
