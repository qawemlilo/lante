<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');


class OtcControllerCompanies extends JController
{
    public function createcompany() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $company = array();
        $owner = array();
        
        $rands = JRequest::getVar('rands', '', 'post', 'int');
        $cents = JRequest::getVar('cents', '', 'post', 'int');
        $share_price = $this->randsToCents($rands, $cents);
        

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $owner['owner_name'] = JRequest::getVar('owner_name', '', 'post', 'string');
        $owner['created_by'] = $user->id;
        $owner['cell_number'] = JRequest::getVar('cell_number', 0, 'post', 'int');
        $owner['email'] = JRequest::getVar('email', '', 'post', 'string');
        
        $company['name'] = JRequest::getVar('name', '', 'post', 'string');
        $company['website'] = JRequest::getVar('website', '', 'post', 'string');
        $company['created_by'] = $user->id;
        $company['share_price'] = $share_price;
        $company['about'] = JRequest::getVar('about', '', 'post', 'string');
        $company['company_email'] = JRequest::getVar('company_email', '', 'post', 'string');
        $company['company_address'] = JRequest::getVar('company_address', '', 'post', 'string');
        $company['available_shares'] = JRequest::getVar('available_shares', 0, 'post', 'int');
        $company['og_shares'] = JRequest::getVar('available_shares', 0, 'post', 'int');
        $logo = JRequest::getVar('logo', null, 'files', 'array');
        
        if ($filename = $this->upload($logo)) {
            $company['logo'] = $filename;
        }
        
        if (!$rands || !$ownerid = $model->addOwner($owner)) {
            $application->redirect($refer, 'Database error. Failed to add owner.', 'error');             
        }
        else {
            $company['ownerid'] = $ownerid;
            
            if (!$model->addCompany($company)) {
                $application->redirect($refer, 'Database error. Failed to add company.', 'error');
            }
            else {
                $application->redirect($refer, 'New Company created!', 'success');
            }
        }
    }
    
    
    public function editcompany() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $company = array();
        $owner = array();
        
        $rands = JRequest::getVar('rands', '', 'post', 'int');
        $cents = JRequest::getVar('cents', '', 'post', 'int');
        $share_price = $this->randsToCents($rands, $cents);
        

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $ownerid = JRequest::getVar('ownerid', '', 'post', 'int');
        $owner['owner_name'] = JRequest::getVar('owner_name', '', 'post', 'string');
        $owner['cell_number'] = JRequest::getVar('cell_number', 0, 'post', 'int');
        $owner['email'] = JRequest::getVar('email', '', 'post', 'string');
        
        $companyid = JRequest::getVar('id', '', 'post', 'int');
        $company['name'] = JRequest::getVar('name', '', 'post', 'string');
        $company['website'] = JRequest::getVar('website', '', 'post', 'string');
        $company['share_price'] = $share_price;
        $company['about'] = JRequest::getVar('about', '', 'post', 'string');
        $company['company_email'] = JRequest::getVar('company_email', '', 'post', 'string');
        $company['company_address'] = JRequest::getVar('company_address', '', 'post', 'string');
        $company['available_shares'] = JRequest::getVar('available_shares', 0, 'post', 'int');
        $logo = JRequest::getVar('logo', null, 'files', 'array');
        
        if ($filename = $this->upload($logo)) {
            $company['logo'] = $filename;
        }
        
        if (!$rands || !$model->updateOwner($ownerid, $owner)) {
            $application->redirect($refer, 'Database error. Failed to update owner.', 'error');             
        }
        else {
            if (!$model->updateCompany($companyid, $company)) {
                $application->redirect($refer, 'Database error. Failed to update company.', 'error');
            }
            else {
                $application->redirect($refer, 'Company updated!', 'success');
            }
        }
    }
    
    
    
    public function removecompany() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $id = JRequest::getVar('id', '', 'post', 'int');

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        if ($model->removeCompany($id)) {
            $application->redirect($refer, 'Company permanantly deleted', 'success');   
        }
        else { 
            $application->redirect($refer, 'An error occured. Company not deleted.', 'error'); 
        }
    }
    
    
    
    public function sellshares() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $tradeModel =& $this->getModel('trade');
        $model =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $user_type = "company";
        $transaction = array();     

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }

        $expiry_date = JRequest::getVar('expiry_date', 0, 'post', 'string');
        $transaction_fee = 0;

        $transaction['companyid'] = JRequest::getVar('companyid', 0, 'post', 'int');
        $transaction['memberid'] = $transaction['companyid'];
        $transaction['selling_price'] = JRequest::getVar('selling_price', 0, 'post', 'int');
        $transaction['num_shares'] = JRequest::getVar('num_shares', 0, 'post', 'int');
        $transaction['security_tax'] = 0;
        $transaction['user_type'] = $user_type;
        $transaction['transaction_fee'] = $transaction_fee;
        $transaction['expiry_date'] = $this->createDateString($expiry_date);

        if (!$this->isPositiveNum($transaction['selling_price']) || !$this->isPositiveNum($transaction['num_shares'])) {
            $application->redirect($refer, 'Error! Your input contains some invalid values!', 'error');
        }
        else {
            $clientshares = $model->getCompanyShares($transaction['companyid']);

            if (!$clientshares || $clientshares < $transaction['num_shares']) {
                $application->redirect($refer, 'Error! That company does not have the selected number of shares!', 'error');
            }
            elseif ($tradeModel->addSale($transaction)) {
            
                $currentshares = ($clientshares - $transaction['num_shares']);
                
                $model->updateShares($transaction['companyid'], $currentshares);
                
                $application->redirect($refer, 'Your transaction has been created!', 'success');
            }
            else {
                $application->redirect($refer, 'Error! Transaction not created!', 'error');
            }  
        }
    }
    
    
    
    private function isPositiveNum($num) {
        $result = true;
        
        if ($num <= 0) {
            $result = false;
        }
        
        return $result;
    }
    
    
    
    private function randsToCents($rands = 0, $cents = 0) {
        $total = ((int)$rands * 100) + (int)$cents;
        
        return $total;
    }
    
    
    private function createDateString($rawdate) {
        list($day, $mon, $year) = explode(' ', $rawdate);
        
        $day = trim($day);
        $mon = trim($mon);
        $year = trim($year);
        
        $date = $year . '-' . $this->getMonthDigit($mon) . '-' . $day; 
        
        return $date;
    }
    
    
    private function getMonthDigit($mon) {
        $months = array (
            'Jan'=>01,
            'Feb'=>02,
            'Mar'=>03,
            'Apr'=>04,
            'May'=>05,
            'Jun'=>06,
            'Jul'=>07,
            'Aug'=>08,
            'Sep'=>09,
            'Oct'=>10,
            'Nov'=>11,
            'Dec'=>12
        ); 
        
        return $months[$mon];
    }
    
    
    private function isAuthorized() {
        $user =& JFactory::getUser();
        if ($user->authorize( 'com_content', 'edit', 'content', 'all' )) {
            return true;
        }
        
        return false;
    }
    
    
    
    
    
    private function upload($file) {
        if (!empty($file) && !empty($file['name']) && !empty($file['tmp_name'])) {
            $rawname = JFile::makeSafe($file['name']);
            $ext = strtolower(JFile::getExt($rawname));
            
            $time = time();
            $filename =  (string)$time . '.' . $ext;
            
            $path = JPATH_SITE . DS . 'media' . DS . 'com_otc' . DS . 'logos'  . DS . $filename;
                
            if (!JFile::upload($file['tmp_name'], $path)) {
                return false;
            }
            else {
                return $filename;
            }
        }
    
        return false;
    }
}
