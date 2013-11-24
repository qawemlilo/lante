<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
 
class ModfeatureHelper
{
    public function getCompanies() {
        $db =& JFactory::getDBO();
        $query = "SELECT company.id, company.name, company.share_price, company.prev_price, company.last_updated, company.ts ";
        $query .= "FROM #__otc_companies AS company ";
        $query .= "ORDER BY share_price DESC LIMIT 3";
              
        $db->setQuery($query);
        $result = $db->loadObjectList();
        
        return $result;       
    }
}
