<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class ModfeatureHelper
{
    public function getCompanies() {
        $db =& JFactory::getDBO();
        $query = "SELECT company.id, company.name, company.share_price, company.prev_price, company.last_updated, company.ts, (company.share_price - company.prev_price) AS movement ";
        $query .= "FROM #__otc_companies AS company ";
        $query .= "ORDER BY movement DESC LIMIT 3";

        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;       
    }
    
    
    private function lastShareForYesterday($companyid) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT sold.id, sales.share_price ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) = CURDATE()-1 AND sold.companyid = $companyid ";
        $query .= "ORDER BY sales.ts DESC LIMIT 1";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    
    public function statsForToday() {
        $db =& JFactory::getDBO();
        $query = "SELECT AVG(sales.share_price) AS price, SUM(sales.num_shares) AS volume, SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price, SUM(sales.share_price) AS value ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "WHERE DATE(ts) = CURDATE()";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    
    public function statsForYesterday() {
        $db =& JFactory::getDBO();
        
        $query = "SELECT SUM(sales.num_shares) AS volume, SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price, SUM(sales.share_price) AS value ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) = CURDATE()-1";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    
    public function statsForDB4Yesterday() {
        $db =& JFactory::getDBO();
        
        $query = "SELECT sold.id, sales.share_price ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) = CURDATE()-2 ";
        $query .= "ORDER BY sales.ts DESC LIMIT 1";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    
    public function getSummary() {
        $today = self::statsForToday();
        $yesterday = self::statsForYesterday();
        $beforeyesterday = self::statsForDB4Yesterday();
        $summary = new stdClass();
        
        $summary->price = array("today"=>$today->share_price,"prev"=>$yesterday->share_price);
        $summary->movement = array("today"=>($today->share_price - $yesterday->share_price),"prev"=>($yesterday->share_price - $beforeyesterday->share_price));
        $summary->volume = array("today"=>$today->volume,"prev"=>$yesterday->volume);
        $summary->value = array("today"=>$today->value,"prev"=>$yesterday->value);
        $summary->num_trades = array("today"=>$today->num_trades,"prev"=>$yesterday->num_trades);
        $summary->highest_price = array("today"=>$today->highest_price,"prev"=>$yesterday->highest_price);
        $summary->lowest_price = array("today"=>$today->lowest_price,"prev"=>$yesterday->lowest_price);
        
        return $summary;       
    }
	
	
	/* Saad - My Function */
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

            $pb = self::getPendingBalance($result->id);
            
            $result->pendingbalance = $result->balance - $pb;  
        }
        
        return $result;    
    }
	
	function centsToRands($cents) {
        return number_format($cents/100, 2);
    }
	public function getMemId($userid) {
	
		$db =& JFactory::getDBO();
	
		$query = "SELECT id FROM  #__otc_members WHERE userid = $userid";
		
		$db->setQuery($query);
        $result = $db->loadObject();
		
		return $result;
		
	}
	public function getMyInvestments() {
	
		$db =& JFactory::getDBO();
        $user =& JFactory::getUser();
        $id = $user->id;
        $memid = self::getMemId($id);
        
		
		$query = "SELECT ps.*, bt.companyid AS companyid, comp.name AS companyname, comp.share_price AS current_share_price, bt.bidding_price AS buying_price, bt.memberid AS memberid ";
        $query .= "FROM #__otc_processed_sales AS ps ";
        $query .= "INNER JOIN #__otc_buy_transactions AS bt ON (ps.buy_tr_id = bt.id) ";
        $query .= "INNER JOIN #__otc_companies AS comp ON (bt.companyid = comp.id) ";
		$query .= "WHERE bt.memberid=".$memid->id." ORDER BY comp.id ASC, ps.ts ASC";
		
		
        $db->setQuery($query);
        $result = $db->loadObjectList();
		
		
		/*
		$query2 = "SELECT prs.* ";
        $query2 .= "FROM #__otc_processed_sales AS prs ";
	    $query2 .= "INNER JOIN #__otc_sell_transactions AS st ON (prs.sell_tr_id = st.id) ";
		$query2 .= "INNER JOIN #__otc_companies AS comp2 ON (st.companyid = comp2.id) ";
		$query2 .= "WHERE st.memberid=".$memid->id." AND st.companyid = 18 ORDER BY prs.ts ASC";
		*/
		
		$query2 = "SELECT prs.*, comp2.id as companyid, SUM(prs.num_shares) as total_sold_shares FROM #__otc_processed_sales AS prs INNER JOIN #__otc_sell_transactions AS st ON (prs.sell_tr_id = st.id) INNER JOIN #__otc_companies AS comp2 ON (st.companyid = comp2.id) WHERE st.memberid = $memid->id GROUP BY comp2.id";
		
		$db->setQuery($query2);
        $result2 = $db->loadObjectList();
		
		
		if($result2) {
			foreach($result2 as $res2) {
				
				
				$total_sold_shares = $res2->total_sold_shares;
				
				foreach($result as $res) {	
					if($res2->companyid == $res->companyid) {
						
						if($res->num_shares >= $total_sold_shares) {
							if(($res->num_shares - $total_sold_shares) == 0) {
								$res->num_shares = 0;
							} else {
								$res->num_shares = $res->num_shares - $total_sold_shares;
							}
							break;	
						} else {
							$total_sold_shares = $total_sold_shares - $res->num_shares;
							$res->num_shares = 0;
						}
						
					}
				}
				
			}
		} 
		
		
		$query3 = "SELECT SUM(num_shares) as total_sold_shares_pending, companyid FROM #__otc_sell_transactions WHERE expiry_date >= CURDATE() AND memberid = $memid->id AND pending = 1 GROUP BY companyid";
				
		$db->setQuery($query3);
        $result3 = $db->loadObjectList();
		
		
		if($result3) {
			foreach($result3 as $res3) {
				
				
				$total_sold_shares = $res3->total_sold_shares_pending;
				
				foreach($result as $res) {	
					if($res3->companyid == $res->companyid) {
						
						if($res->num_shares >= $total_sold_shares) {
							if(($res->num_shares - $total_sold_shares) == 0) {
								$res->num_shares = 0;
							} else {
								$res->num_shares = $res->num_shares - $total_sold_shares;
							}
							break;	
						} else {
							$total_sold_shares = $total_sold_shares - $res->num_shares;
							$res->num_shares = 0;
						}
						
					}
				}
				
			}
		}
		
		
		return $result;
	
	}
	
	
	public function getMyPlannings() {
	
		$db =& JFactory::getDBO();
        $user =& JFactory::getUser();
        $id = $user->id;
        $memid = self::getMemId($id);
        /*
		$query = "SELECT trans.*, company.id AS companyid, company.name AS companyname ";
        $query .= "FROM #__otc_buy_transactions AS trans ";
        $query .= "INNER JOIN #__otc_companies AS company ON (trans.companyid = company.id) ";
        $query .= "WHERE trans.memberid=1";
        */
		
		$query = "SELECT plan.*, comp.name AS companyname ";
        $query .= "FROM #__otc_planning AS plan ";
        $query .= "INNER JOIN #__otc_companies AS comp ON (plan.companyid = comp.id) ";
		$query .= "WHERE plan.memberid=".$memid->id." AND plan.is_email_sent = 0 ORDER BY when_to_purchase ASC, companyname ASC";
		
		/*
		$query = "SELECT c.name, sum(t.num_shares) as total_shares, c.share_price as last_share_price FROM #__otc_buy_transactions t, #__otc_companies c WHERE memberid = 1 and t.companyid = c.id group by t.companyid";
		*/    
		
        $db->setQuery($query);
        $result = $db->loadObjectList();
		
		return $result;
	
	}
	
	function parseUrl($url) {
        return JRoute::_($url);
    }
	
	
	public function getAllCompanies() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT company.id, company.name, company.share_price ";
        $query .= "FROM #__otc_companies AS company ";
        $query .= "ORDER BY company.name ASC";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
	
	function savePayment($tnxid, $checksum, $parity) {
		
		$db =& JFactory::getDBO();
        $user =& JFactory::getUser();
        $id = $user->id;
        $memid = self::getMemId($id);
		
		//$tnxid = $_GET["tnxid"];
		//$checksum = $_GET["checksum"];
		//$parity = $_GET["parity"];
		
		// echo $tnxid;
		// exit;
		$merchantID = "testseller20";
		$username = "testseller20@MonsterPay.com";
		$password = "testseller";
		
		
		
		$monsterpay_string = 'method=order_synchro&identifier='. $merchantID .'&usrname='. $username .'&pwd='. $password .'&tnxid='. $tnxid .'&checksum='. $checksum .'&parity='. $parity;
		// send $monsterpay_string to MonsterPay by utilizing CURL
		$monsterpay_url = "https://www.monsterpay.com/secure/components/synchro.cfc?wsdl";
		
		// MonsterPay Synchro url
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $monsterpay_url);
		
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_HEADER,0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		// return into a variable
		curl_setopt($ch, CURLOPT_POST,1); // set POST method
		curl_setopt($ch, CURLOPT_POSTFIELDS, $monsterpay_string); 
		
		$monsterpay_result = curl_exec($ch);
		if(curl_errno($ch)) {
			$sCurlError = curl_error($ch); 
			echo "error" . $sCurlError ."<br>";
		} else {
			$sCurlError = '';
		}
		curl_close($ch);
		
		$monsterpay_wddx = trim($monsterpay_result);
		$monsterpay_xml = wddx_deserialize($monsterpay_wddx);
		$order_synchro = simplexml_load_string($monsterpay_xml);
		
		$tnx_status = (string)$order_synchro->outcome->status;
		$tnx_id = (string)$order_synchro->outcome->order->id;
		$funds_avail = $order_synchro->outcome->order->funds_available;
		
		//error details
		$error_code = (string)$order_synchro->outcome->error_code;
		$error_desc = $order_synchro->outcome->error_desc;
		$error_solution = $order_synchro->outcome->error_solution;
		
		//seller details
		$seller_ref = $order_synchro->seller->reference;
		$seller_email = (string)$order_synchro->seller->username;
		
		//buyer details
		$buyer_ref = (string)$order_synchro->buyer->reference;
		$buyer_uname = (string)$order_synchro->buyer->username;
		$buyer_title = (string)$order_synchro->buyer->billing_address->title;
		$buyer_fname = (string)$order_synchro->buyer->billing_address->firstname;
		$buyer_lname = (string)$order_synchro->buyer->billing_address->lastname;
		$buyer_email = (string)$order_synchro->buyer->billing_address->email_address;
		$buyer_street1 = (string)$order_synchro->buyer->billing_address->street1;
		$buyer_street2 = (string)$order_synchro->buyer->billing_address->street2;
		$buyer_city = (string)$order_synchro->buyer->billing_address->city;
		$buyer_state = (string)$order_synchro->buyer->billing_address->state;
		$buyer_zip = (string)$order_synchro->buyer->billing_address->zip;
		$buyer_country = (string)$order_synchro->buyer->billing_address->country;
		$buyer_cnumber = (string)$order_synchro->buyer->billing_address->contact_number;
		
		//payment details
		$pmt_type = (string)$order_synchro->payment_instrument->type;
		
		//financial details
		$tnx_amount = $order_synchro->financial->amount_total;
		$currency = $order_synchro->financial->currency;
		
		$tnx_amount = self::getCurrency($tnx_amount,$currency);
		
		
		
		
		// echo $tnx_status . " " . $tnx_id . " " . $funds_avail;
		
		

		
		if($error_code == '0' && $tnx_status == 'Complete' && $tnx_id && $memid->id) {
			$payment = new stdClass();
			$payment->id = NULL;
			$payment->memberid = $memid->id;
			$payment->error_code = $error_code;
			$payment->seller_email = $seller_email;
			$payment->buyer_ref = $buyer_ref;
			$payment->buyer_uname = $buyer_uname;
			$payment->buyer_title = $buyer_title;
			$payment->buyer_fname = $buyer_fname;
			$payment->buyer_lname = $buyer_lname;
			$payment->buyer_email = $buyer_email;
			$payment->buyer_street1 = $buyer_street1;
			$payment->buyer_street2 = $buyer_street2;
			$payment->buyer_city = $buyer_city;
			$payment->buyer_state = $buyer_state;
			$payment->buyer_zip = $buyer_zip;
			$payment->buyer_country = $buyer_country;
			$payment->buyer_cnumber = $buyer_cnumber;
			
			$payment->payment_type = $pmt_type;
			$payment->amount = $tnx_amount;
			$payment->currency = (string)$currency;
			
			$payment->tnx_id = $tnx_id;
			$payment->status = $tnx_status;
			// print_r($payment);
			if($db->insertObject( '#__otc_payments', $payment, 'id' )) {
				// echo "Data Inserted";
				$returned_string = '<div style="margin: 10px 0px 10px10px" class="alert-success message alert">Your Tansaction is successful. The funds may take up-to 48 hours to reflect subject to clearing houses</div>';
			} else {
				// echo "Duplicate Entry";
				$returned_string = '<div style="margin: 10px 0px 10px10px" class="alert-error message alert">Duplicate Entry</div>';
			}
		} elseif($error_code != '0' && $tnx_status == 'ERROR' && $memid->id) {
			// echo "Error hai bhai";
			$returned_string = '<div style="margin: 10px 0px 10px10px" class="alert-error message alert">There is an error. The system is unable to complete the transaction. Please retry</div>';
		} else {
			// echo "Kuch nahi hai";
			$returned_string = '';
		}
		
		// print_r($table);
		return $returned_string;
	}
	
	
	/* public function getTable($type = 'Payment', $prefix = 'OtcTable', $config = array()) {
        	return JTable::getInstance($type, $prefix, $config);
     } */
    
	
	function getCurrency($amt, $cur) {
		if(strlen($cur) > 0) {
			switch(strtoupper($cur)) {
				case 'ZAR' :
					$cur_sym = 'R';
				break;
				case 'GBP' :
					$cur_sym = '£';
				break;
				case 'USD' :
				$cur_sym = '$';
				break;
				case 'EUR' :
				$cur_sym = 'E';
				break;
				default :
				$cur_sym ='';
			}
		} else {
			$cur_sym = '';
		}
		if($amt < 0) { 
			$amt = abs($amt);
			$new_amt = '-' . number_format(($amt /100),2,'.','');
		} else {
			$new_amt = number_format(($amt /100),2,'.','');
		}	
		
		return $new_amt;
	}
	
	
	
}
