<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewProfile extends JView
{
    function display($tpl = null) {
        $this->member = $this->get('Member');
        
        parent::display($tpl);
    }
    
    function centsToRands($cents) {
        return number_format($cents/100, 2);
    }
}
