<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'member.php');


class OtcModelProfile extends JModelItem
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
    
    
    
    public function updateMember($id, $arr = array()) {
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
    
    
    
    public function removeMember($id) {
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
