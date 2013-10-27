<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'sell.php');


class OtcModelSelling extends JModelItem {
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
    
    
    public function getTable($type = 'Sell', $prefix = 'OtcTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }
 
 
 
 
    private function _buildQuery() {
        $query = "SELECT transaction.ts, transaction.selling_price, transaction.pending, transaction.expiry_date, company.name AS company, member.account_id AS account_number ";
        $query .= "FROM #__otc_sell_transactions AS transaction ";
        $query .= "INNER JOIN #__otc_companies AS company ";
        $query .= "ON transaction.companyid=company.id ";
        $query .= "INNER JOIN #__otc_members AS member ";
        $query .= "ON transaction.memberid=member.id ";
        $query .= "ORDER BY transaction.ts DESC";
        
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
}
