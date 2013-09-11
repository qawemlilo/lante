<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');


class OtcControllerAdmin extends JController
{
    public function createmember() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('admin');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $member = array();
        

        /*
            Check if user is authorized to view this page
        */
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $member['userid'] = JRequest::getVar('userid', 0, 'post', 'int');
        $member['created_by'] = $user->id;
        $member['title'] = JRequest::getVar('title', '', 'post', 'string');
        $member['middle_name'] = JRequest::getVar('middle_name', '', 'post', 'string');
        $member['surname'] = JRequest::getVar('surname', '', 'post', 'string');
        $member['cell_number'] = JRequest::getVar('cell_number', 0, 'post', 'int');
        $member['work_number'] = JRequest::getVar('work_number', 0, 'post', 'int');
        $member['dob'] = JRequest::getVar('dob', 0, 'post', 'int');
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
            $application->redirect('index.php?option=com_otc&view=admin&layout=newuser', 'New member created!', 'success');   
        }
        else { 
            $application->redirect($refer, 'An error occured. Member not created.', 'error'); 
        }
    }
    
    
    public function createcompany() {
        JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('company');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        $user =& JFactory::getUser();
        $company = array();
        $owner = array();
        

        /*
            Check if user is authorized to view this page
        */
        if(!$this->isAuthorized()) {
            $application->redirect('index.php', 'You are not authorized to view that page');
        }
        
        $company['name'] = JRequest::getVar('name', '', 'post', 'string');
        $company['website'] = JRequest::getVar('website', '', 'post', 'string');
        $company['created_by'] = $user->id;
        $company['share_price'] = JRequest::getVar('share_price', 0, 'post', 'int');
        $company['about'] = JRequest::getVar('about', '', 'post', 'string');
        
        $owner['owner_name'] = JRequest::getVar('owner_name', '', 'post', 'string');
        $owner['created_by'] = $user->id;
        $owner['cell_number'] = JRequest::getVar('cell_number', 0, 'post', 'int');
        $owner['email'] = JRequest::getVar('email', '', 'post', 'string');
        
        if (!$ownerid = $model->addOwner($owner)) {
            $application->redirect('index.php?option=com_otc&view=admin&layout=newuser', 'New member created.', 'success');
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
    
    
    
    
    private function isAuthorized() {
        $user =& JFactory::getUser();
        if ($user->authorize( 'com_content', 'edit', 'content', 'all' )) {
            return true;
        }
        
        return false;
    }
}