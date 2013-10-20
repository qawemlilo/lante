<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');


class OtcControllerTrade extends JController {
    public function sellshares() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('trade');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $transaction = $this->getClientForm('selling'); 

        if (!$this->isPositiveNum($transaction['selling_price']) || !$this->isPositiveNum($transaction['num_shares'])) {
            $application->redirect($refer, 'Error! Your input contains some invalid values!', 'error');
        }
        else {
            $clientshares = $model->getClientShares($transaction['companyid'], $transaction['memberid'] );

            if (!$clientshares || $clientshares < $transaction['num_shares']) {
                $application->redirect($refer, 'Error! You do not hold any or enough shares from the chosen company!', 'error');
            }
            elseif ($model->addSale($transaction)) {
                $currentshares = ($clientshares - $transaction['num_shares']);
                $charges = ($transaction['transaction_fee'] + $transaction['security_tax']);
                
                $model->updateShares($transaction['memberid'], $transaction['companyid'], $currentshares);
                $this->createBankRecord($transaction['memberid'], $charges, 'sfees');
                
                // trigger transaction email
                
                $application->redirect($refer, 'Your shares have been been put up for sale and you will be notified once a match has been made.', 'success');
            }
            else {
                $application->redirect($refer, 'Error! Transaction not created!', 'error');
            }  
        }
    }
    
    
    
    
    public function buyshares() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('trade');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $transaction = $this->getClientForm('buying');

        if (!$this->isPositiveNum($transaction['bidding_price']) || !$this->isPositiveNum($transaction['num_shares'])) {
            $application->redirect($refer, 'Error! Your input contains some invalid values!', 'error');
        }
        else {
            $transactionCost = $this->calcTotal($transaction['share_price'], $transaction['num_shares'], $transaction['security_tax']);
            $clientBalance = $model->getBalance($transaction['memberid']);

            if ($clientBalance < $transactionCost) {
                $application->redirect($refer, 'Error! You do not have enough money to buy those shares!', 'error'); // trigger to deposit money
            }
            elseif ($model->addBuy($transaction)) {
                $charges = ($transaction['transaction_fee'] + $transaction['security_tax']);
                
                $model->updateBalance($transaction['memberid'], $charges);
                $this->createBankRecord($transaction['memberid'], $charges, 'bfees');
                
                // trigger transaction email
                
                $application->redirect($refer, 'Your bid has been created and you will be notified once a match has been made.', 'success');
            }
            else {
                $application->redirect($refer, 'Error! Transaction not created!', 'error');
            }  
        }
    }
    
    
    
    
    private function getClientForm($type) {
        $rands = JRequest::getVar('rands', '', 'post', 'int');
        $cents = JRequest::getVar('cents', '', 'post', 'int');
        
        $price = $this->randsToCents($rands, $cents);
        $num_shares = JRequest::getVar('num_shares', 0, 'post', 'int');
        $expiry_date = JRequest::getVar('expiry_date', 0, 'post', 'string');
        
        $transaction['memberid'] = JRequest::getVar('memberid', 0, 'post', 'int');
        $transaction['companyid'] = JRequest::getVar('companyid', 0, 'post', 'int');
        $transaction['num_shares'] = $num_shares;
        
        if ($type == 'selling') {
            $transaction['selling_price'] = $price;
            
            $transaction_fee = $transaction_fee = $this->calcTransactionFee($price * $num_shares);
            $security_tax = 0;
        }
        elseif($type == 'buying') {
            $transaction['share_price'] = JRequest::getVar('share_price', 0, 'post', 'int');;
            $transaction['bidding_price'] = $price;
        
            $transaction_fee = 0;
            $security_tax = $this->calcSecurityTax($transaction['share_price'] * $num_shares);          
        }   
        
        $transaction['expiry_date'] = $this->createDateString($expiry_date);
        $transaction['security_tax'] = $security_tax;
        $transaction['transaction_fee'] = $transaction_fee;
        $transaction['user_type'] = "user";
        
        
        return $transaction;
    }
    
    
    
    
    private function createBankRecord($id, $amount, $type) {
        $bank =& $this->getModel('bank');
        $bankrecord = array();
        
        $bankrecord['memberid'] = $id;
        $bankrecord['amount'] = $amount;
        $bankrecord['created_by'] = JRequest::getVar('userid', '', 'post', 'int');
        $bankrecord['transaction_type'] = $type;
        
        $result = $bank->addRecord($bankrecord); 
        
        return $result;
    }
    
    
    
    
    private function isPositiveNum($num) {
        $result = true;
        
        if ($num <= 0) {
            $result = false;
        }
        
        return $result;
    }
    
    
    
    
    private function calcTransactionFee($sellvalue) {
        $rate = 0.0175;
        
        $fee = round($sellvalue * $rate);
        
        return $fee;
    }
    
    
    
    
    private function calcSecurityTax($bidvalue) {
        $rate = 0.0025;
        
        $fee = round($bidvalue * $rate);
        
        return $fee;
    }
    
    
    
    private function calcTotal($sharepice, $numshares, $secTax, $transFee = 0) {
        $total = ($sharepice * $numshares) + $secTax + $transFee;
        
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
    
    
    
    
    private function randsToCents($rands = 0, $cents = 0) {
        $total = ((int)$rands * 100) + (int)$cents;
        
        return $total;
    }
    
    
    
    
    private function isAuthorized() {
        $user =& JFactory::getUser();
        if (!$user->guest) {
            return true;
        }
        
        return false;
    }
}
