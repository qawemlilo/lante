<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

require_once(dirname(__FILE__) . DS . 'tables' . DS . 'sell.php');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'buy.php');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'sales.php');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'shares.php');


class OtcModelTrade extends JModelItem {

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
    
    
    
    
    public function addCompletedSale($arr = array()) {
        $table = $this->getTable('Sales');
        
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
    
    
    
    
    public function addShares($arr = array()) {
        $table = $this->getTable('Shares');
        
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
    
    
    
    
    public function getBalance($memberid) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT member.balance ";
        $query .= "FROM  #__otc_members AS member ";
        $query .= "WHERE member.id = $memberid";
              
        $db->setQuery($query);
        $result = $db->loadResult();
        
        return $result;    
    }
    
    
    
    
    public function updateShares($memberid, $companyid, $num_shares) {
        $db =& JFactory::getDBO();
        
        $query = "UPDATE #__otc_shares ";
        $query .= "SET num_shares=$num_shares, last_update=NOW() ";
        $query .= "WHERE memberid = $memberid AND companyid = $companyid";
              
        $db->setQuery($query);
        $result = $db->query();
        
        return $result;    
    }
    
    
    
    public function getClientShares($companyid, $memberid) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT shares.num_shares ";
        $query .= "FROM #__otc_shares AS shares ";
        $query .= "WHERE shares.companyid = $companyid AND shares.memberid = $memberid";
              
        $db->setQuery($query);
        $result = $db->loadResult();
        
        return $result;    
    }
    
    
    
    public function getSharesOnSale($companyid, $biddingprice) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT transaction.id, transaction.num_shares, transaction.selling_price, transaction.user_type, transaction.memberid ";
        $query .= "FROM #__otc_sell_transactions AS transaction ";
        $query .= "WHERE transaction.companyid = $companyid AND transaction.selling_price <= $biddingprice ";
        $query .= "AND transaction.pending = 1 AND transaction.expiry_date >= CURDATE() ";
        $query .= "ORDER BY selling_price ASC, expiry_date DESC LIMIT 1";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;    
    }
    
    
    
    
    public function updateBalance($id, $money, $action) {
        $db =& JFactory::getDBO();
        
        $query = "UPDATE #__otc_members ";
        
        if ($action == 'add') {
            $query .= "SET balance =balance + $money ";
        }
        
        elseif ($action == 'minus') {
            $query .= "SET balance=balance - $money ";
        }

        $query .= "WHERE id=$id";
              
        $db->setQuery($query);
        $result = $db->query();
        
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
