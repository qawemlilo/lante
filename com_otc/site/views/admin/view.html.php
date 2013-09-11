<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewAdmin extends JView
{
    function display($tpl = null) {
        $application =& JFactory::getApplication();
        $layout = JRequest::getVar('layout', '', 'get', 'string');
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        /*
            Check if user is authorized to view this page
        */
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        /*
           Newuser layout
           If no user has been selected from the #__users database, 
           fetch a list from the database to chose from
        */
        if ($layout == 'newuser' && $id) {
            $this->user = $this->getUser($id);
            $this->users = false;
        }
        
        elseif ($layout == 'newuser') {
            $this->user = false;
            $this->users = $this->get('Users');        
        }
        
        elseif ($layout == 'companies') {
            $this->companies = $this->get('Companies');        
        }
        
        elseif (!$layout) {
            $this->members = $this->get('Members');
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
