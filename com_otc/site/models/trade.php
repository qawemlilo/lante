<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

require_once(dirname(__FILE__) . DS . 'tables' . DS . 'sell.php');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'buy.php');


class OtcModelTrade extends JModelItem
{
    public function getTable($type = 'Sell', $prefix = 'OtcTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    
    public function addSale($arr = array()) {
        
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
    
    
    public function removeSale($id) {
        $table =& $this->getTable();
        
        if (!$table->load($id)) {
            JError::raiseWarning( 500, $table->getError());
            return false;
        }
        
        $ownerid = $table->ownerid;
        
        if (!$table->delete($id)) {
            JError::raiseWarning( 500, $table->getError());
            return false;
        }
        
        $result = $this->removeOwner($ownerid);
        
        return $result;
    }
    
    
    public function updateSale($id, $arr = array()) {
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
    
    
    public function addBuy($arr = array()) {
        $table = $this->getTable('Buy');
        
        if (is_array($arr) && count($arr) > 0) {
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
    
    
    public function removeBuy($id) {
       $table = $this->getTable('Buy');
        
        if (!$table->load($id)) {
            JError::raiseWarning( 500, $table->getError());
            return false;
        }
        
        $ownerid = $table->ownerid;
        
        if (!$table->delete($id)) {
            JError::raiseWarning( 500, $table->getError());
            return false;
        }
        
        $result = $this->removeOwner($ownerid);
        
        return $result;
    }
    
    
    public function updateBuy($id, $arr = array()) {
        $table = $this->getTable('Buy');
        
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
    
    
    
    public function getCompanies() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT company.id, company.name, company.share_price ";
        $query .= "FROM #__otc_companies AS company";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
    
    
    
    
    public function getMember() {
        $db =& JFactory::getDBO();
        $user =& JFactory::getUser();
        $id = $user->id;
        
        $query = "SELECT member.*, users.id AS userid, users.name, users.email ";
        $query .= "FROM #__otc_members AS member ";
        $query .= "INNER JOIN #__users AS users ON (member.userid = users.id) ";
        $query .= "WHERE member.userid={$id}";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;    
    }
}
