<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

require_once(dirname(__FILE__) . DS . 'tables' . DS . 'payments.php');


class OtcModelPayments extends JModelItem {

	private $_total = null;    
    private $_pagination = null;
	
	function __construct() {
        parent::__construct();
 
        $mainframe = JFactory::getApplication();
 
        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', 10, 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
        
        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }	
		
	public function getTable($type = 'Payments', $prefix = 'OtcTable', $config = array()) {
       	return JTable::getInstance($type, $prefix, $config);
   	}
    
    
    /*
    public function getPayments() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT payment.* ";
        $query .= "FROM #__otc_payments AS payment ";
        $query .= "ORDER BY payment.id ASC";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
    */
    
	public function getPayment() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
		$query = "SELECT payment.*, member.surname, member.cell_number, member.account_number, member.account_id, user.name, user.email ";
        $query .= "FROM #__otc_payments AS payment ";
		$query .= "INNER JOIN #__otc_members AS member ON (payment.memberid=member.id) ";
		$query .= "INNER JOIN #__users AS user ON (member.userid=user.id) ";
        $query .= "WHERE payment.id = $id";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;    
    }
	
	public function getPayments() {
        $query = $this->_buildQuery();
        $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        
        return $this->_data;        
    }
	
	private function _buildQuery() {
        $query = "SELECT payment.*, member.surname, member.cell_number, member.account_number, member.account_id, user.name ";
        $query .= "FROM #__otc_payments AS payment ";
		$query .= "INNER JOIN #__otc_members AS member ON (payment.memberid=member.id) ";
		$query .= "INNER JOIN #__users AS user ON (member.userid=user.id) ";
		$query .= "ORDER BY payment.id DESC";
        
        return $query;        
    }
    
    
	public function getPagination() {
 	    $total = $this->getTotal();
 	    
        // Load the content if it doesn't already exist
 	    if (empty($this->_pagination)) {
 	        jimport('joomla.html.pagination');
 	        $this->_pagination = new JPagination($total, $this->getState('limitstart'), $this->getState('limit') );
        }
 	
        return $this->_pagination;
    }	
	private function getTotal() {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
 	        $this->_total = $this->_getListCount($query);	
 	    }
        
        return $this->_total;
    }	
   
}
