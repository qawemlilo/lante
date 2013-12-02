<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewCompany extends JView
{
    function display($tpl = null) {
        $application =& JFactory::getApplication();
        
        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $this->company = $this->get('Company');
        $this->sellbids = $this->get('BidsToSell');
        $this->buybids = $this->get('BidsTobuy');
        $this->trades = $this->get('LastTrades');
        $this->summary = $this->get('Summary');
        $this->stats = $this->get('BigStats');
        
        parent::display($tpl);
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
    
    

    function formatTime($date) {
        $mydate = new DateTime($date);
        $dateString = $mydate->format("d M y H:i");
        
        return $dateString;
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
    
    
    function myFormat($price) {
        $total = (int)$price;
        $formatted = $total;

        if ($total > 0) {
           $formatted = '<span style="color:green">'.$total.'</span>';
        }
        if ($total < 0) {
           $formatted = '<span style="color:red">'.$total.'</span>';
        }
        
        return $formatted;
    }
}
