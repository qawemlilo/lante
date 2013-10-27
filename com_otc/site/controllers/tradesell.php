<?php
// No direct access to this file  getClientShares
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

date_default_timezone_set('Africa/Johannesburg');

class OtcControllerTradesell extends JController {

    public function sellshares() {
    
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('trade');
        $bank =& $this->getModel('bank');
        $companies =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $userid = JRequest::getVar('userid', '', 'post', 'int');
        $companyname = JRequest::getVar('company_name', '', 'post', 'string');

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $transaction = $this->getClientForm('selling'); 

        if (!$this->isPositiveNum($transaction['selling_price']) || !$this->isPositiveNum($transaction['num_shares']) || !$this->isValidPrice($transaction['selling_price'], $transaction['share_price'])) {
            $application->redirect($refer, 'Error! Your input contains some invalid values!', 'error');
        }
        else {
        
            // check if the user holds shares in that company
            $clientshares = $model->getClientShares($transaction['companyid'], $transaction['memberid']);

            if (!$clientshares || $clientshares < $transaction['num_shares']) {
                $application->redirect($refer, 'Error! You do not hold any or enough shares from the chosen company!', 'error');
            }
            elseif ($saleId = $model->addSale($transaction)) {
                
                $currentshares = ($clientshares - $transaction['num_shares']);
                $charges = ($transaction['transaction_fee'] + $transaction['security_tax']);
                
                // deduct share from that I am selling
                $model->updateShares($transaction['memberid'], $transaction['companyid'], $currentshares);

                // deduct charges
                $model->updateBalance($transaction['memberid'], $charges, 'minus');
                                
                // record transaction
                $bank->addRecord(array(
                    'memberid'=>$transaction['memberid'],
                    'amount'=>$charges,
                    'created_by'=>$userid,
                    'transaction_type'=>'sfees'
                ));
                
                // notify user via email that tranche has been created
                $fshareprice = number_format($transaction['selling_price'] / 100, 2);
                $this->sellTrancheMail($userid, $transaction['num_shares'],$companyname,'R'.$fshareprice,$transaction['expiry_date'],$saleId);
                
                // check if there are any bids to buy shares
                // is less or equal to this bidding price
                $availablebid = $model->getBidsTobuy($transaction['companyid'], $transaction['selling_price']);
                
                // if the buyer wants more or equal shares to what I'm selling
                if ($availablebid && $availablebid->num_shares >= $transaction['num_shares']) {
                    
                    $numToSell = $transaction['num_shares'];
                    $totalToPay = ($numToSell * $transaction['selling_price']);
                    
                    // calculate how many share will remain
                    $remainingshares = ($availablebid->num_shares - $numToSell);
                    
                    
                    $buyerform = array('num_shares'=>$remainingshares);
                    
                    // Close the buy tranche if no more shares are left
                    if ($remainingshares == 0) {
                        $buyerform = array('pending'=>0);
                    }
                    else {
                        $buyerform = array('num_shares'=>$remainingshares);
                    }
                    
                    // update the buy tranche
                    $model->updateBuy($availablebid->id, $buyerform);
                    
                    //check if the buyer already holds shares in this company
                    $buyershares = $model->getClientShares($transaction['companyid'], $availablebid->memberid);
                    
                    // if buyer already holds some shares perform update
                    if ($buyershares) {
                        $model->updateShares($availablebid->memberid, $transaction['companyid'], ($buyershares + $numToSell));
                    }
                    // otherwise create new record
                    else {
                        $form = $this->createShareForm($availablebid->memberid, $transaction['companyid'], $numToSell);
                        $model->addShares($form);
                    }
                    
                    // update values for the sale tranche
                    $sellerform = array('pending'=>0);
                    
                    // close the sell tranche
                    $model->updateSale($saleId, $sellerform); 
                    
                    
                    // deduct share value from buyer account
                    $model->updateBalance($availablebid->memberid, $totalToPay, 'minus');
                    
                    // add share value to seller account
                    $model->updateBalance($transaction['memberid'], $totalToPay, 'add');
                    
                    // add share value to seller account
                    $model->addCompletedSale(array(
                        'buy_tr_id'=>$availablebid->id,
                        'sell_tr_id'=>$saleId,
                        'num_shares'=> $numToSell,
                        'share_price'=>$transaction['selling_price'],
                        'prev_price'=>$transaction['share_price']
                    ));
                    
                    $today = new DateTime();
                    $timestamp = $today->format('Y-m-d H:i:s');
                    
                    // update company share price
                    $companies->updateCompany($transaction['companyid'], array(
                        'share_price'=>$transaction['selling_price'], 
                        'prev_price'=>$transaction['share_price'],
                        'last_updated'=>$timestamp
                    ));
                    
                    // record transaction
                    $bank->addRecord(array(
                        'memberid'=>$transaction['memberid'],
                        'amount'=>$totalToPay,
                        'created_by'=>$userid,
                        'transaction_type'=>'shares'
                    ));
                    
                    // send email
                    $this->matchFound($userid,$numToSell,$numToSell,$companyname,'Sell',$saleId);
                    
                    $application->redirect($refer, 'Your sell tranche was created and a match has been found. Please checkout your inbox.', 'success');
                }
                
                // if buyer needs less shares than what I'm selling
                elseif ($availablebid && $availablebid->num_shares > 0 && $availablebid->num_shares < $transaction['num_shares']) {
                    
                    $numToSell = $availablebid->num_shares;
                    
                    // We know that buy tranche has less shares that I'm selling
                    $buyerform = array('pending'=>0);
                    
                    // Close the buy tranche
                    $model->updateBuy($availablebid->id, $buyerform);
                    
                    //check if the buyer already holds shares in that company
                    $buyershares = $model->getClientShares($transaction['companyid'], $availablebid->memberid);
                    
                    // if buyer already holds some shares perform update
                    if ($buyershares) {
                        $model->updateShares($availablebid->memberid, $transaction['companyid'], ($buyershares + $numToSell));
                    }
                    // otherwise create new record
                    else {
                        $form = $this->createShareForm($availablebid->memberid, $transaction['companyid'], $numToSell);
                        $model->addShares($form);
                    }
                    
                    // calculate how many share will remain
                    $remainingshares = ($transaction['num_shares'] - $numToSell);
                    $totalToPay = ($numToSell * $transaction['selling_price']);
                    
                    // update sale tranche
                    $sellerform = array('num_shares'=>$remainingshares);
                    
                    // close the sell tranche
                    $model->updateSale($saleId, $sellerform); 
                    
                    
                    // deduct share value from buyer account
                    $model->updateBalance($availablebid->memberid, $totalToPay, 'minus');
                    
                    // add share value to seller account
                    $model->updateBalance($transaction['memberid'], $totalToPay, 'add');
                    
                    // record completed sale
                    $model->addCompletedSale(array(
                        'buy_tr_id'=>$availablebid->id,
                        'sell_tr_id'=>$saleId,
                        'num_shares'=> $numToSell,
                        'share_price'=>$transaction['selling_price'],
                        'prev_price'=>$transaction['share_price']
                    ));
                    
                    $today = new DateTime();
                    $timestamp = $today->format('Y-m-d H:i:s');
                    
                    // update company share price
                    $companies->updateCompany($transaction['companyid'], array(
                        'share_price'=>$transaction['selling_price'], 
                        'prev_price'=>$transaction['share_price'],
                        'last_updated'=>$timestamp
                    ));
                    
                    // record transaction
                    $bank->addRecord(array(
                        'memberid'=>$transaction['memberid'],
                        'amount'=>$totalToPay,
                        'created_by'=>$userid,
                        'transaction_type'=>'shares'
                    ));
                    
                    // send email
                    $this->matchFound($userid,$numToSell,$transaction['num_shares'],$companyname,'Sell',$saleId);
                    
                    $application->redirect($refer, 'Your sell tranche was created and a match has been found. Please checkout your inbox.', 'success');                
                }
                else {                
                    $application->redirect($refer, 'Your shares have been been put up for sale and you will be notified once a match has been made.', 'success');
                }
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
        $transaction['share_price'] = JRequest::getVar('share_price', 0, 'post', 'int');
        $transaction['num_shares'] = $num_shares;
        
        if ($type == 'selling') {
            $transaction['selling_price'] = $price;
            
            $transaction_fee = $transaction_fee = $this->calcTransactionFee($price * $num_shares);
            $security_tax = 0;
        }
        elseif($type == 'buying') {
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
    
    
    
    
    private function createShareForm($memberid, $companyid, $num_shares) {
        $shares = array();
        
        $shares['memberid'] = $memberid;
        $shares['companyid'] = $companyid;
        $shares['num_shares'] = $num_shares;
        
        return $shares;
    }
    
    
    
    
    private function createBankRecord(&$bank, $memberid, $amount, $type) {
        $bankrecord = array();
        
        $bankrecord['memberid'] = $memberid;
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
    
    
    
    
    private function isValidPrice($shareprice, $price) {
            $result = true;
            $shareprice = (int)$shareprice;
            $price = (int)$price;
            
            $diff = $shareprice * 0.15;
            $max = $shareprice + $diff;
            $min = $shareprice - $diff;
            
            if ($price > $max || $price < $min) {
                $result = false;  
            }
            
            return $result;
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
    
    
    private function sellTrancheMail($id,$num_shares,$company,$share_price,$expiry_date,$sellid) {
        $user =& JFactory::getUser($id);
        
        $subject = "Sell tranche created";
        
        $msg = "Dear $user->name \n\n";
        $msg .= "A Sell Order for $num_shares $company shares at $share_price has been created on your account. Expiry date $expiry_date \n";
        $msg .= "Order Ref No: $sellid \n \n";
        $msg .= "Should you have any questions, please o not hesitate to contact us on info@lanteotc.co.za \n\n\n";

        $msg .= "Yours sincerely \n";
        $msg .= "LanteOTC admin";
        
        JUtility::sendMail('info@lanteotc.co.za', 'Admin', $user->email, $subject, $msg);
    }
    
    

    
    
    private function matchFound($id,$matchedshares,$totalonsale,$company,$ordertype,$orderno) {
        $user =& JFactory::getUser($id);
        
        $subject = "Match found";

        $msg .= "$matchedshares of the total $totalonsale $companyname shares of your $ordertype Order (Ref No: {$orderno}) \n\n";

        $msg .= "Should you have any questions, please o not hesitate to contact us on info@lanteotc.co.za \n\n\n";

        $msg .= "Yours sincerely \n";
        $msg .= "LanteOTC admin";
        
        JUtility::sendMail('info@lanteotc.co.za', 'Admin', $user->email, $subject, $msg);
    }
}
