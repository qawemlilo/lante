<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'company.php');


class OtcModelCompany extends JModelItem
{
    public function getCompany() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT company.id, company.ownerid, company.name, company.share_price, company.available_shares, company.website, company.company_address, company.company_email, company.about, company.logo, owner.owner_name, owner.email, owner.cell_number ";
        $query .= "FROM #__otc_companies AS company ";
        $query .= "INNER JOIN #__otc_owners AS owner ON (company.ownerid = owner.id) ";
        $query .= "WHERE company.id = $id";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;    
    }
    
    
    
    public function getBidsToSell() {
        $db =& JFactory::getDBO();
        $companyid = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT transaction.id, transaction.num_shares, transaction.selling_price ";
        $query .= "FROM #__otc_sell_transactions AS transaction ";
        $query .= "WHERE transaction.companyid = $companyid AND transaction.num_shares > 0 ";
        $query .= "AND transaction.pending = 1 AND DATE(transaction.expiry_date) >= CURDATE() ";
        $query .= "ORDER BY transaction.selling_price ASC, transaction.expiry_date DESC LIMIT 5";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
    
    
    
    public function getBidsTobuy() {
        $db =& JFactory::getDBO();
        $companyid = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT transaction.id, transaction.num_shares, transaction.bidding_price ";
        $query .= "FROM #__otc_buy_transactions AS transaction ";
        $query .= "WHERE transaction.companyid = $companyid AND transaction.num_shares > 0 ";
        $query .= "AND transaction.pending = 1 AND transaction.expiry_date >= CURDATE() ";
        $query .= "ORDER BY transaction.bidding_price DESC, transaction.expiry_date DESC LIMIT 5";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;
    } 
    
    
    
    public function getLastTrades() {
        $db =& JFactory::getDBO();
        $companyid = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT transaction.id, transaction.num_shares, transaction.share_price, transaction.ts ";
        $query .= "FROM #__otc_buy_transactions AS buy ";
        $query .= "INNER JOIN #__otc_processed_sales AS transaction ON buy.id = transaction.buy_tr_id ";
        $query .= "WHERE buy.companyid = $companyid ";
        $query .= "ORDER BY ts DESC LIMIT 10";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;
    }
    
    
    private function statsForToday($companyid) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT AVG(sales.share_price) AS price, SUM(sales.num_shares) AS volume, SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price, SUM(sales.share_price) AS value ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) = CURDATE() AND sold.companyid = $companyid";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    private function statsForYesterday($companyid) {
        $db =& JFactory::getDBO();
        
        
        $query = "SELECT AVG(sales.share_price) AS price, SUM(sales.num_shares) AS volume, SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price, SUM(sales.share_price) AS value ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) = CURDATE()-1 AND sold.companyid = $companyid";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    private function statsForDB4Yesterday($companyid) {
        $db =& JFactory::getDBO();
        
        
        $query = "SELECT AVG(sales.share_price) AS price, SUM(sales.num_shares) AS volume, SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price, SUM(sales.share_price) AS value ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) = CURDATE()-2 AND sold.companyid = $companyid";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    public function getBigStats() {
        $db =& JFactory::getDBO();
        $companyid = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) > DATE_SUB(CURDATE(), INTERVAL 12 MONTH) AND sold.companyid = $companyid";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    
    
    public function getSummary() {
        $companyid = JRequest::getVar('id', 0, 'get', 'int');
        
        $today = $this->statsForToday($companyid);
        $yesterday = $this->statsForYesterday($companyid);
        $beforeyesterday = $this->statsForDB4Yesterday($companyid);

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
      
}
