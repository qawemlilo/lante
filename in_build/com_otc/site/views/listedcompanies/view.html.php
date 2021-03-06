<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');



class OtcViewListedcompanies extends JView
{
    function display($tpl = null) {
        $application =& JFactory::getApplication();
        
        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $this->companies = $this->get('Companies');
        $this->pagination = $this->get('Pagination');
        
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
    
    

    function formatTime($date) {
        $mydate = new DateTime($date);
        $dateString = $mydate->format("d M y H:i");
        
        return $dateString;
    }
    
    
    function calcChange($current, $prev) {
        $change = 0;
        $current = (int)$current;
        $prev = (int)$prev;
        
        if ($current && $prev) {
            $change = ($current - $prev);
        }
        if ($change > 0) {
           $change = '<span style="color:green">'.$change.'</span>';
        }
        if ($change < 0) {
           $change = '<span style="color:red">'.$change.'</span>';
        }
        
        return $change;
    }
    
    
    
    
    function getTime($ts, $lastUpdate) {
        
        if (!$lastUpdate) {
            return $this->formatTime($ts);
        }
        else {
            return $this->formatTime($lastUpdate); 
        }
    }    
    
    
    
    
    function calcPChange($current, $prev) {
        $change = 0;
        $current = (int)$current;
        $prev = (int)$prev;
        
        if ($current && $prev) {
            $change = ($current - $prev);
        }
        
        $change = round(($change / $current) * 100, 2);
        
        if ($change > 0) {
           $change = '<span style="color:green">'.$change.'%</span>';
        }
        elseif ($change < 0) {
           $change = '<span style="color:red">'.$change.'%</span>';
        }
        else {
            $change = '<span>'.$change.'%</span>';
        } 
               
        return $change;
    }
    
    
    
    
    function parseUrl($url) {
        return JRoute::_($url);
    }
}
