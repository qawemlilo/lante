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
        $member['address'] = JRequest::getVar('address', '', 'post', 'string');
        $member['address_code'] = JRequest::getVar('address_code', 0, 'post', 'int');
        $member['postal_address'] = JRequest::getVar('postal_address', '', 'post', 'string');
        $member['postal_code'] = JRequest::getVar('postal_code', 0, 'post', 'int');
        $member['account_number'] = JRequest::getVar('account_number', 0, 'post', 'int');
        $member['bank_name'] = JRequest::getVar('bank_name', '', 'post', 'string');
        $member['account_name'] = JRequest::getVar('account_name', '', 'post', 'string');
        $member['branch_name'] = JRequest::getVar('branch_name', '', 'post', 'string');
        $member['branch_code'] = JRequest::getVar('branch_code', 0, 'post', 'int');
        
        if ($model->addMember($member)) {
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
    
    
    
    private function createDateString($day, $mon, $year) {
        $date = trim($year) . '-' . $this->getMonthDigit($mon) . '-' . trim($day); 
        
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
}
