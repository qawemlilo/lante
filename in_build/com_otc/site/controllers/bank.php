<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');


class OtcControllerBank extends JController {
    public function transaction() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $memberModel =& $this->getModel('members');
        $model =& $this->getModel('bank');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $transaction = array();     

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $rands = JRequest::getVar('rands', '', 'post', 'int');
        $cents = JRequest::getVar('cents', '', 'post', 'int');
        $amount = $this->randsToCents($rands, $cents);
        
        $transaction['memberid'] = JRequest::getVar('memberid', 0, 'post', 'int');
        $transaction['amount'] = $amount;
        $transaction['created_by'] = $user->id;
        $transaction['transaction_type'] = JRequest::getVar('transaction_type', '', 'post', 'string');
        
        if ($model->addRecord($transaction)) {
            if ($memberModel->updateBalance($transaction['memberid'], $amount)) {
                $application->redirect($refer, 'New transaction created!', 'success');
            }
            else {
                $application->redirect($refer, 'An error occured. Failed to update member\'s balance.', 'error');
            }   
        }
        else { 
            $application->redirect($refer, 'An error occured. Transaction not created.', 'error'); 
        }
    }
    
    private function randsToCents($rands = 0, $cents = 0) {
        $total = ((int)$rands * 100) + (int)$cents;
        
        return $total;
    }
    
    
    private function sendMail($rands = 0, $cents = 0) {
        $mailer = JFactory::getMailer();
        
        $mailer->setSender('$sender');
        $mailer->addRecipient('$recipient');
        $mailer->setSubject('Your subject string');
        $mailer->isHTML(true);
        $mailer->Encoding = 'base64';
        $mailer->setBody('$body');
        $mailer->addAttachment(JPATH_COMPONENT.'/assets/document.pdf');
        
        $send = $mailer->Send();
        
        if ( $send !== true ) {
            return 'Error sending email: ' . $send->message;
        } else {
            return 'Success';
        }
    }
    
    
    private function isAuthorized() {
        $user =& JFactory::getUser();
        if ($user->authorize( 'com_content', 'edit', 'content', 'all' )) {
            return true;
        }
        
        return false;
    }
}

