<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');


class OtcControllerMembers extends JController
{
    public function createmember() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('members');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $member = array();     

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $name = JRequest::getVar('name', '', 'post', 'string');
        $email = JRequest::getVar('email', '', 'post', 'string');
        $day = JRequest::getVar('day', '', 'post', 'string');
        $month = JRequest::getVar('month', '', 'post', 'string');
        $year = JRequest::getVar('year', '', 'post', 'string');
        $dob = $this->createDateString($day, $month, $year);
        
        $member['userid'] = JRequest::getVar('userid', 0, 'post', 'int');
        $member['created_by'] = $user->id;
        $member['title'] = JRequest::getVar('title', '', 'post', 'string');
        $member['middle_name'] = JRequest::getVar('middle_name', '', 'post', 'string');
        $member['surname'] = JRequest::getVar('surname', '', 'post', 'string');
        $member['cell_number'] = JRequest::getVar('cell_number', 0, 'post', 'int');
        $member['work_number'] = JRequest::getVar('work_number', 0, 'post', 'int');
        $member['dob'] = $dob;
        $member['account_id'] = time();
        $member['address'] = JRequest::getVar('address', '', 'post', 'string');
        $member['address_code'] = JRequest::getVar('address_code', 0, 'post', 'int');
        $member['postal_address'] = JRequest::getVar('postal_address', '', 'post', 'string');
        $member['postal_code'] = JRequest::getVar('postal_code', 0, 'post', 'int');
        $member['account_number'] = JRequest::getVar('account_number', 0, 'post', 'int');
        $member['bank_name'] = JRequest::getVar('bank_name', '', 'post', 'string');
        $member['account_name'] = JRequest::getVar('account_name', '', 'post', 'string');
        $member['branch_name'] = JRequest::getVar('branch_name', '', 'post', 'string');
        $member['branch_code'] = JRequest::getVar('branch_code', 0, 'post', 'int');
        
        if ($accountid = $model->addMember($member)) {
            $this->sendMail($member['title'] . " " . $name . " " .$member['surname'], $email, $accountid);
            $application->redirect($refer, 'New member created!', 'success'); 
        }
        else { 
            $application->redirect($refer, 'An error occured. Member not created.', 'error'); 
        }
    }
    
    
    public function removemember() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('members');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $member = array();

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $id = JRequest::getVar('id', '', 'post', 'int');
        
        if ($model->removeMember($id)) {
            $application->redirect($refer, 'Member removed!', 'success');   
        }
        else { 
            $application->redirect($refer, 'An error occured. Member not removed.', 'error'); 
        }
    }
    
    
    public function editmember() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('members');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $member = array();

        //Check if user is authorized to view this page
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $day = JRequest::getVar('day', '', 'post', 'string');
        $month = JRequest::getVar('month', '', 'post', 'string');
        $year = JRequest::getVar('year', '', 'post', 'string');
        $day = JRequest::getVar('day', '', 'post', 'string');
        $month = JRequest::getVar('month', '', 'post', 'string');
        $year = JRequest::getVar('year', '', 'post', 'string');
        $dob = $this->createDateString($day, $month, $year);
        
        $memberid = JRequest::getVar('id', 0, 'post', 'int');
        $member['userid'] = JRequest::getVar('userid', 0, 'post', 'int');
        $member['title'] = JRequest::getVar('title', '', 'post', 'string');
        $member['middle_name'] = JRequest::getVar('middle_name', '', 'post', 'string');
        $member['surname'] = JRequest::getVar('surname', '', 'post', 'string');
        $member['cell_number'] = JRequest::getVar('cell_number', 0, 'post', 'int');
        $member['work_number'] = JRequest::getVar('work_number', 0, 'post', 'int');
        $member['dob'] = $dob;
        $member['address'] = JRequest::getVar('address', '', 'post', 'string');
        $member['address_code'] = JRequest::getVar('address_code', 0, 'post', 'int');
        $member['postal_address'] = JRequest::getVar('postal_address', '', 'post', 'string');
        $member['postal_code'] = JRequest::getVar('postal_code', 0, 'post', 'int');
        $member['account_number'] = JRequest::getVar('account_number', 0, 'post', 'int');
        $member['bank_name'] = JRequest::getVar('bank_name', '', 'post', 'string');
        $member['account_name'] = JRequest::getVar('account_name', '', 'post', 'string');
        $member['branch_name'] = JRequest::getVar('branch_name', '', 'post', 'string');
        $member['branch_code'] = JRequest::getVar('branch_code', 0, 'post', 'int');
        
        $this->updateJoomlaUser();
        
        if ($model->updateMember($memberid, $member)) {
            $application->redirect($refer, 'Member updated!', 'success');   
        }
        else { 
            $application->redirect($refer, 'An error occured. Member not updated.', 'error'); 
        }
    }
    
    
    
    public function updatemember() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $model =& $this->getModel('members');
        $user =& JFactory::getUser();
        $member = array();

        //Check if user is authorized to view this page
        if ($user->guest) {
            http_response_code(500);
            header('Content-type: text/plain');
            echo "Unauthorised user";
            exit();
        }
   
        
        $email = JRequest::getVar('email', '', 'post', 'string');
        $memberid = JRequest::getVar('id', 0, 'post', 'int');
        $member['contact_method'] = JRequest::getVar('contact_method', '', 'post', 'string');
        $member['cell_number'] = JRequest::getVar('cell_number', 0, 'post', 'int');
        $member['work_number'] = JRequest::getVar('work_number', 0, 'post', 'int');
        $member['postal_address'] = JRequest::getVar('postal_address', '', 'post', 'string');
        $member['postal_code'] = JRequest::getVar('postal_code', 0, 'post', 'int');
        
        if ($email != $user->email) {
            $user->set('email', $email);
            $user->save();
        }
        
        if ($model->updateMember($memberid, $member)) { 
            http_response_code(200);
            header('Content-type: text/plain');
            echo "Details Updated";
            exit();            
        }
        else { 
            http_response_code(500);
            header('Content-type: text/plain');
            echo "An error occured. Some details not updated.";
            exit();
        }
    }
    
    
    public function createJoomlaUser() {
        $application =& JFactory::getApplication();
        
        $user = array();
        $user['fullname'] = JRequest::getVar('fullname', '', 'post', 'string');
        $user['email'] = JRequest::getVar('email', '', 'post', 'string');
        $user['username'] = JRequest::getVar('username', '', 'post', 'string');
        $password = JRequest::getVar('password', '', 'post', 'string');
        
        $password = $this->makeCrypt($password);
		
        $instance = JUser::getInstance();		
        $config = JComponentHelper::getParams('com_users');
        $defaultUserGroup = $config->get('new_usertype', 2);
        $acl = JFactory::getACL();

        $instance->set('id', null);
        $instance->set('name', $user['fullname']);
        $instance->set('username', $user['username']);
        $instance->set('password', $password);
        $instance->set('email', $user['email']);
        $instance->set('usertype', 'deprecated');
        $instance->set('groups', array($defaultUserGroup));
		

        if ($instance->save()) {      
            $application->redirect('index.php?option=com_users&view=login', 'Account created, please login.');
        }
        else {   
            $this->response(500, 'Error. Account not created.');	
        }			
    }
    
    
    
    private function updateJoomlaUser() {
        $id = JRequest::getVar('userid', '', 'post', 'int');
        $fullname = JRequest::getVar('name', '', 'post', 'string');
        $email = JRequest::getVar('email', '', 'post', 'string');
        
        $user =& JFactory::getUser($id);
        
        
        if ($email != $user->email || $fullname != $user->name) {
            if ($email != $user->email) {
               $user->set('email', $email);
            }
            
            if ($fullname != $user->name) {
                $user->set('name', $fullname);
            }
        
            if (!$user->save()) {
                return false;
            }
        }
        
        return true;
    }
    
    
    public function changepassword() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        
	    $originalPassword = JRequest::getVar('currentpassword', '', 'post', 'string');
		$p_1 = JRequest::getVar('newpassword', '', 'post', 'string');
        $p_2 = JRequest::getVar('newpassword2', '', 'post', 'string');
        
        
        if ($user->guest) {
            http_response_code(500);
            header('Content-type: text/plain');
            echo "Unauthorised user";
            exit();
        }
        
        $password = $user->get('password');
        $salt = $this->getSalt($password);
        $currentpassword = $this->makeCrypt($originalPassword, $salt);
        
        if ($currentpassword != $password || $p_1 != $p_2) {
            http_response_code(500);
            header('Content-type: text/plain');
            echo "Password could not be verified";
            exit();
        }
        
        $newpassword = $this->makeCrypt($p_1);
        
        $user->set('password', $newpassword);
        
        if (!$user->save()) {
            http_response_code(500);
            header('Content-type: text/plain');
            echo "Password could not be updated";
            exit();
        }
        
        http_response_code(200);
        header('Content-type: text/plain');
        echo "Password updated";
        exit();
    }
    
    
    
    private function getSalt($password) {  
        $passwordarray = explode(":", $password);
		
		if (is_array($passwordarray)) {
            return $passwordarray[1];
        }
        
        return false;
    }
    
    
    
    
    private function makeCrypt($password, $salt = false) {
    
		if (!$salt) {
            $salt = JUserHelper::genRandomPassword(32);
        }
        
        $crypt = JUserHelper::getCryptedPassword($password, $salt);
        $crypted = $crypt.':'.$salt;
        
        return $crypted;
    }
    
    

    private function createDateString($day, $mon, $year) {
        $date = trim($year) . '-' . $this->getMonthDigit($mon) . '-' . trim($day); 
        
        return $date;
    }
    
    
    
    private function dateToString($rawdate) {
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
    
    
    private function sendMail($name,$email,$accnumber) {
        $subject = "Shareholder number created";
        
        $msg = "Dear $name \n\n";
        $msg .= "Your Shareholder number for the LanteOTC Share Trading Website has been created. \n";
        $msg .= "Your LanteOTC Shareholder number is: $accnumber \n\n";
        $msg .= "Should you have any questions, please do not hesitate to contact us on info@lanteotc.co.za \n\n\n";

        $msg .= "Yours sincerely \n";
        $msg .= "LanteOTC";
        
        JUtility::sendMail('info@lanteotc.co.za', 'LanteOTC', $email, $subject, $msg);
    }
}





if (!function_exists('http_response_code')) {
    function http_response_code($code = NULL) {
        if ($code !== NULL) {

            switch ($code) {
                case 100: $text = 'Continue'; break;
                case 101: $text = 'Switching Protocols'; break;
                case 200: $text = 'OK'; break;
                case 201: $text = 'Created'; break;
                case 202: $text = 'Accepted'; break;
                case 203: $text = 'Non-Authoritative Information'; break;
                case 204: $text = 'No Content'; break;
                case 205: $text = 'Reset Content'; break;
                case 206: $text = 'Partial Content'; break;
                case 300: $text = 'Multiple Choices'; break;
                case 301: $text = 'Moved Permanently'; break;
                case 302: $text = 'Moved Temporarily'; break;
                case 303: $text = 'See Other'; break;
                case 304: $text = 'Not Modified'; break;
                case 305: $text = 'Use Proxy'; break;
                case 400: $text = 'Bad Request'; break;
                case 401: $text = 'Unauthorized'; break;
                case 402: $text = 'Payment Required'; break;
                case 403: $text = 'Forbidden'; break;
                case 404: $text = 'Not Found'; break;
                case 405: $text = 'Method Not Allowed'; break;
                case 406: $text = 'Not Acceptable'; break;
                case 407: $text = 'Proxy Authentication Required'; break;
                case 408: $text = 'Request Time-out'; break;
                case 409: $text = 'Conflict'; break;
                case 410: $text = 'Gone'; break;
                case 411: $text = 'Length Required'; break;
                case 412: $text = 'Precondition Failed'; break;
                case 413: $text = 'Request Entity Too Large'; break;
                case 414: $text = 'Request-URI Too Large'; break;
                case 415: $text = 'Unsupported Media Type'; break;
                case 500: $text = 'Internal Server Error'; break;
                case 501: $text = 'Not Implemented'; break;
                case 502: $text = 'Bad Gateway'; break;
                case 503: $text = 'Service Unavailable'; break;
                case 504: $text = 'Gateway Time-out'; break;
                case 505: $text = 'HTTP Version not supported'; break;
                default:
                    exit('Unknown http status code "' . htmlentities($code) . '"');
                break;
            }

            $protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

            header($protocol . ' ' . $code . ' ' . $text);

            $GLOBALS['http_response_code'] = $code;
        } else {
            $code = (isset($GLOBALS['http_response_code']) ? $GLOBALS['http_response_code'] : 200);
        }
        
        return $code;
    }
}
