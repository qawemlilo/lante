<?php
defined('_JEXEC') or die('Restricted access');


// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'company.php');
require_once(dirname(__FILE__) . DS . 'tables' . DS . 'owner.php');


class OtcModelCompanies extends JModelItem
{
    private $_total = null;    
    private $_pagination = null;   
    
    
    function __construct() {
        parent::__construct();
 
        $mainframe = JFactory::getApplication();
 
        // Get pagination request variables
        $limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', 5, 'int');
        $limitstart = JRequest::getVar('limitstart', 0, '', 'int');
        
        // In case limit has been changed, adjust it
        $limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
        $this->setState('limit', $limit);
        $this->setState('limitstart', $limitstart);
    }
    
    
    public function getTable($type = 'Company', $prefix = 'OtcTable', $config = array()) {
        return JTable::getInstance($type, $prefix, $config);
    }
    
    
    public function addCompany($arr = array()) {
        
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
    
    
    public function addOwner($arr = array()) {
        
        if (is_array($arr) && count($arr) > 0) {
            $table = $this->getTable('Owner');
            
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
    
    
    
    public function removeCompany($id) {
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
    
    
    private function removeOwner($id) {
        $table =& $this->getTable('Owner');
        
        if (!$table->load($id)) {
            JError::raiseWarning( 500, $table->getError());
            return false;
        }
        
        if (!$table->delete($id)) {
            JError::raiseWarning( 500, $table->getError());
            return false;
        }
                
        return true;
    }
    
    
    
    public function updateCompany($id, $arr = array()) {
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
    
    
    
    public function updateOwner($id, $arr = array()) {
        $table = $this->getTable('Owner');
        
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
    
    
    private function _buildQuery() {
        $query = "SELECT company.id, company.name, company.share_price, company.website, company.about ";
        $query .= "FROM #__otc_companies AS company";
        
        return $query;        
    }
    
    
    
    
    private function getTotal() {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
 	        $this->_total = $this->_getListCount($query);	
 	    }
        
        return $this->_total;
    }
    
    
    
    
    public function getCompanies() {
        $query = $this->_buildQuery();
        $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
        
        return $this->_data;        
    }
    
    
    
    public function getCompany() {
        $db =& JFactory::getDBO();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        
        $query = "SELECT company.id, company.ownerid, company.name, company.share_price, company.website, company.about, owner.owner_name, owner.email, owner.cell_number ";
        $query .= "FROM #__otc_companies AS company ";
        $query .= "INNER JOIN #__otc_owners AS owner ON (company.ownerid = owner.id) ";
        $query .= "WHERE company.id = $id";
              
        $db->setQuery($query);
        $result = $db->loadObject();
        
        return $result;    
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
}
