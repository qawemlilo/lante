<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'bank.php');


class OtcModelBank extends JModelItem
{
    public function getTable($type = 'Bank', $prefix = 'OtcTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    
    public function addRecord($arr = array()) {
        
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
    
    
    
    public function updateRecord($id, $arr = array()) {
        $table = $this->getTable();
        
        if (!$table->load($id)) {
            JError::raiseWarning(500, $table->getError());
            return false;
        }
        
        if (!$table->bind($arr)) {
            JError::raiseWarning(500, $table->getError());
            return false;
        }
        
        if (!$table->store($arr)) {
            JError::raiseWarning(500, $table->getError());
            return false;
        }
                
        return true;
    }
    
    
    
    public function removeRecord($id) {
        $table =& $this->getTable();
        
        if (!$table->load($id)) {
            JError::raiseWarning( 500, $table->getError());
            return false;
        }
        
        if (!$table->delete($id)) {
            JError::raiseWarning( 500, $table->getError());
            return false;
        }
                
        return true;
    }
    
    
    
    private function getTotal() {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
 	        $this->_total = $this->_getListCount($query);	
 	    }
        
        return $this->_total;
    }
    
    
    public function getMembers() {
        $db =& JFactory::getDBO();
        
        $query = "SELECT members.*, users.name ";
        $query .= "FROM #__otc_members AS members ";
        $query .= "INNER JOIN #__users AS users ON members.userid=users.id";
        
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
}
