<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
 
// import Joomla table library
jimport('joomla.database.table');
 

 

class OtcTableSell extends JTable
{
    function __construct(&$db) 
    {
        parent::__construct('#__otc_sell_transactions', 'id', $db);
    }
}