<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'member.php');


class OtcModelAdmin extends JModelItem
{
    public function getTable($type = 'Member', $prefix = 'OtcTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    
    
    
    public function addMember($arr = array()) {
        
        if (is_array($arr) && count($arr) > 0) {
            $table = $this->getTable();
            
            if (!$table->bind( $arr )) {
                JError::raiseWarning( 500, $table->getError() );
                return false;
            }
            if (!$table->store( $arr )) {
                JError::raiseWarning( 500, $table->getError() );
                return false;
            }
                
            return $table->id;
        }
        
        return false;
    }
    
    
    
    
    public function updateMember($arr = array()) {
        
        if (is_array($arr) && count($arr) > 0) {
            $table = $this->getTable();
            
            if (!$table->bind( $arr )) {
                JError::raiseWarning( 500, $table->getError() );
                return false;
            }
            if (!$table->store( $arr )) {
                JError::raiseWarning( 500, $table->getError() );
                return false;
            }
                
            return $table->id;
        }
        
        return false;
    }


    
    
    public function getUsers() {
        $db =& JFactory::getDBO();
        
        $query = "SELECT users.id, users.name, users.email ";
        $query .= "FROM #__users AS users ";
        $query .= "LEFT OUTER JOIN #__otc_members AS members ON (users.id = members.userid) ";
        $query .= "WHERE members.userid IS NULL ";
        $query .= "ORDER BY name ASC";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
    
    
    
    public function getMembers() {
        $db =& JFactory::getDBO();
        
        $query = "SELECT members.id, members.surname, members.cell_number, members.work_number, users.name, users.email ";
        $query .= "FROM #__otc_members AS members ";
        $query .= "INNER JOIN #__users AS users ON (members.userid = users.id) ";
        $query .= "ORDER BY id ASC";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result; 
    }

    
    
    public function getCompanies() {
        $db =& JFactory::getDBO();
        
        $query = "SELECT company.id, company.name, company.share_price, company.website, company.about ";
        $query .= "FROM #__otc_companies AS company ";
        $query .= "ORDER BY name ASC";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
}