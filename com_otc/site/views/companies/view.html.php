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
    
    
    
    
    private function isAuthorized() {
        $user =& JFactory::getUser();
        if ($user->authorize( 'com_content', 'edit', 'content', 'all' )) {
            return true;
        }
        
        return false;
    }
}
