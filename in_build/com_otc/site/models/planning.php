<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

require_once(dirname(__FILE__) . DS . 'tables' . DS . 'planning.php');


class OtcModelPlanning extends JModelItem {

		
		
		public function getTable($type = 'Planning', $prefix = 'OtcTable', $config = array()) {
        	return JTable::getInstance($type, $prefix, $config);
    	}
    
    
    
    
    
    
    public function addPlanningRecord($arr = array()) {

		$table = $this->getTable();
		
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
    
   
    public function updatePlanningRecord($id, $arr = array()) {
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
    
    
   
    
    public function sendReminderEmail() {
		
		$db =& JFactory::getDBO();
        
        $query = "SELECT plan.*, user.name AS username, user.email, comp.name ";
        $query .= "FROM #__otc_planning AS plan ";
        $query .= "INNER JOIN #__users AS user ON (plan.userid = user.id) ";
		$query .= "INNER JOIN #__otc_companies AS comp ON (plan.companyid = comp.id) ";
		$query .= "WHERE is_email_sent = 0 ORDER BY plan.when_to_purchase ASC";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
		
		$today = date("Y-m-d");
		$today_timestamp = strtotime($today);

		foreach ($result as $res) {
			
			$plan_timestamp = strtotime($res->when_to_purchase);
			
			if ($plan_timestamp == $today_timestamp) {  
				// echo "Send mail <br />";
				$headers = "From: LanteOTC reminder <ss@veriqual.com>\r\n";
				$headers .= "Reply-To: ss@veriqual.com \r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				$to  = $res->email;
			
				$body = "
				<div><b>Good day $res->username </b></div><br />
				<div>This is a kind reminder that you plan to buy shares in $res->name today. On behalf of $res->name we thank you in advance for your support in small businesses and await your transaction.</div>
				<br /><br />
				<div>Yours sincerely.</div>
				<div>LanteOTC admin</div>
				";
			
				if(mail($to, "LanteOTC reminder", $body, $headers)) {
					
					$query2 = "UPDATE #__otc_planning ";
					$query2 .= "SET is_email_sent = 1 ";
					$query2 .= "WHERE id = $res->id";
						  
					$db->setQuery($query2);
					$result2 = $db->query();
					
				}
				
				
			}
		} 
		exit;
	}
    
    
   
    public function getPlanning() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT * from #__otc_planning where id = $id";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;    
    }
    
    
    public function getUserPlannings() {
        $db =& JFactory::getDBO();

		$user =& JFactory::getUser();
        $userid = $user->id;
        
        $query = "SELECT * from #__otc_planning where userid = $userid";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
   
    
    
    
    
    
    public function getCompanies() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT company.id, company.name, company.share_price ";
        $query .= "FROM #__otc_companies AS company ";
        $query .= "ORDER BY company.name ASC";
              
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
    
    
    
    public function getPendingBalance($memberid) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT transaction.num_shares, transaction.bidding_price ";
        $query .= "FROM #__otc_buy_transactions AS transaction ";
        $query .= "WHERE transaction.memberid={$memberid} AND transaction.expiry_date >= CURDATE()";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        $total = 0;
        
        if ($result) {
            foreach($result as $bid)
            $total += ($bid->num_shares * $bid->bidding_price);    
        }
        return $total;    
    }
    
    
    
    public function getBidsTobuy($companyid, $sellingprice) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT transaction.id, transaction.num_shares, transaction.bidding_price, transaction.memberid ";
        $query .= "FROM #__otc_buy_transactions AS transaction ";
        $query .= "WHERE transaction.companyid = $companyid AND transaction.bidding_price >= $sellingprice ";
        $query .= "AND transaction.pending = 1 AND transaction.expiry_date >= CURDATE() ";
        $query .= "ORDER BY bidding_price DESC, expiry_date DESC LIMIT 1";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;    
    }
    
    
    
    
    public function updateBalance($id, $money, $action) {
        $db =& JFactory::getDBO();
        
        $query = "UPDATE #__otc_members ";
        
        if ($action == 'add') {
            $query .= "SET balance=balance + $money ";
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
        
        if ($result) {
            $pb = $this->getPendingBalance($result->id);
            
            $result->pendingbalance = $result->balance - $pb;  
        }
        
        return $result;    
    }
		
		
   
}
