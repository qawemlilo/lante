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
        $query .= "WHERE transaction.companyid = $companyid ";
        //$query .= "AND transaction.pending = 1 AND transaction.expiry_date >= CURDATE() ";
        $query .= "ORDER BY selling_price ASC, expiry_date DESC LIMIT 5";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;    
    }
    
    
    
    public function getBidsTobuy() {
        $db =& JFactory::getDBO();
        $companyid = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT transaction.id, transaction.num_shares, transaction.bidding_price ";
        $query .= "FROM #__otc_buy_transactions AS transaction ";
        $query .= "WHERE transaction.companyid = $companyid ";
        //$query .= "AND transaction.pending = 1 AND transaction.expiry_date >= CURDATE() ";
        $query .= "ORDER BY bidding_price DESC, expiry_date DESC LIMIT 5";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;
    } 
    
    
    
    public function getLastTrades() {
        $db =& JFactory::getDBO();
        $companyid = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT transaction.id, transaction.num_shares, transaction.share_price, transaction.ts ";
        $query .= "FROM #__otc_processed_sales AS transaction ";
        $query .= "INNER JOIN #__otc_sell_transactions AS sell ON (transaction.sell_tr_id = sell.id) ";
        $query .= "WHERE sell.companyid = $companyid ";
        $query .= "ORDER BY ts DESC LIMIT 10";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;
    }        
      
}
