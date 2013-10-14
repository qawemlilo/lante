<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');


class OtcModelTrade extends JModelItem
{
    public function getCompanies() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT company.id, company.name ";
        $query .= "FROM #__otc_companies AS company";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
    
    
    
    
    public function getMember() {
        $db =& JFactory::getDBO();
        $user =& JFactory::getUser();
        $id = $user->id;
        
        $query = "SELECT member.*, users.name, users.email ";
        $query .= "FROM #__otc_members AS member ";
        $query .= "INNER JOIN #__users AS users ON (member.userid = users.id) ";
        $query .= "WHERE member.userid={$id}";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;    
    }
}
