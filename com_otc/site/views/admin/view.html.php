<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewAdmin extends JView
{
    function display($tpl = null) {
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
