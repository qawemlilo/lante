<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'bank.php');


class OtcModelBank extends JModelItem
{
    private $_total = null;    
    private $_pagination = null;   
    
    
    function __construct() {
        parent::__construct();
 
        $mainframe = JFactory::getApplication();
 
        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', 5, 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
        
        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }
    
    
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
    
    
    
    private function _buildQuery() {
        $query = "SELECT transaction.ts, transaction.amount, transaction.transaction_type, user.name AS created_by, member.account_id AS account_number ";
        $query .= "FROM #__otc_bank AS transaction ";
        $query .= "INNER JOIN #__users AS user ";
        $query .= "ON transaction.created_by=user.id ";
        $query .= "INNER JOIN #__otc_members AS member ";
        $query .= "ON transaction.memberid=member.id";
        
        return $query;        
    }
    
    
    
    
    private function getTotal() {
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
 	    $this->_total = $this->_getListCount($query);	
 	}
        
        return $this->_total;
    }
    
    
    public function getPagination() {
 	$total = $this->getTotal();
 	    
 	if (empty($this->_pagination)) {
 	    jimport('joomla.html.pagination');
 	    $this->_pagination = new JPagination($total, $this->getState('limitstart'), $this->getState('limit') );
        }
 	
        return $this->_pagination;
    }
    
    
    public function getTransactions() {
        $query = $this->_buildQuery();
        $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        
        return $this->_data;   
    }
    
    
    public function getMembers() {
        $db =& JFactory::getDBO();
        
        $query = "SELECT members.*, users.name, users.email ";
        $query .= "FROM #__otc_members AS members ";
        $query .= "INNER JOIN #__users AS users ON members.userid=users.id";
        
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
}
