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
        $query = "SELECT AVG(sales.share_price) AS price, SUM(sales.num_shares) AS volume, SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price, SUM(sales.share_price) AS value ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "WHERE DATE(ts) = CURDATE()-1";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    
    private function statsForYesterday($companyid) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT SUM(sales.num_shares) AS volume, SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price, SUM(sales.share_price) AS value ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) = CURDATE()-1";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    
    private function statsForToday($companyid) {
        $db =& JFactory::getDBO();
        
        $query = "SELECT AVG(sales.share_price) AS price, SUM(sales.num_shares) AS volume, SUM(sales.num_shares) AS num_trades, MIN(sales.share_price) AS lowest_price, MAX(sales.share_price) AS highest_price, SUM(sales.share_price) AS value ";
        $query .= "FROM #__otc_processed_sales AS sales ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sold ON (sold.id=sales.sell_tr_id) ";
        $query .= "WHERE DATE(sales.ts) = CURDATE()";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;       
    }
    
    
    private function statsForDB4Yesterday() {
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
}
