<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');


class OtcControllerPlanning extends JController
{
	function display() {
		$application =& JFactory::getApplication();
        $model =& $this->getModel('planning');
        $view->display();
    }
	
	public function sendreminderemail() {
		

        $application =& JFactory::getApplication();
        $model =& $this->getModel('planning');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
		
		$model->sendReminderEmail();
		
		
	}
	public function whentopurchase() {
		
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('planning');
        // $companies =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        
		$userid = JRequest::getVar('userid', '', 'post', 'int');
		$memberid = JRequest::getVar('memberid', '', 'post', 'int');
		
		$companyid = JRequest::getVar('companyid', 0, 'post', 'int');
        $companyname = JRequest::getVar('company_name', '', 'post', 'string');
		$num_shares = JRequest::getVar('num_shares', 0, 'post', 'int');
        $when_date = JRequest::getVar('when_date', 0, 'post', 'string');
		
		
		$data_array['userid'] = $userid;
		$data_array['memberid'] = $memberid;
		$data_array['companyid'] = $companyid;
		$data_array['num_shares'] = $num_shares;
		$data_array['when_to_purchase'] = $this->createDateString($when_date);
		
		if ($planningid = $model->addPlanningRecord($data_array)) {
            // http_response_code(200);
			header('Content-type: text/plain');
			echo "Your Reminder has been saved";
			exit();
        } else {
			// http_response_code(500);
            header('Content-type: text/plain');
            echo "Your Reminder could not be saved";
            exit();
		}
		
		/*if($planningid = $model->addPlanningRecord($data_array)) {
			$application->redirect($refer, 'Your plan has been saved and we will send you reminder email on the selected date.', 'success');
		}*/
		
		/*
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('planning');
        // $companies =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        
		$userid = JRequest::getVar('userid', '', 'post', 'int');
		$memberid = JRequest::getVar('memberid', '', 'post', 'int');
		
		$companyid = JRequest::getVar('companyid', 0, 'post', 'int');
        $companyname = JRequest::getVar('company_name', '', 'post', 'string');
		$num_shares = JRequest::getVar('num_shares', 0, 'post', 'int');
        $when_date = JRequest::getVar('when_date', 0, 'post', 'string');
		
		$data_array['userid'] = $userid;
		$data_array['memberid'] = $memberid;
		$data_array['companyid'] = $companyid;
		$data_array['num_shares'] = $num_shares;
		$data_array['when_to_purchase'] = $this->createDateString($when_date);
		
		if($planningid = $model->addPlanningRecord($data_array)) {
			$application->redirect($refer, 'Your plan has been saved and we will send you reminder email on the selected date.', 'success');
		}
		*/
		
		 // print_r($data_array);
		 // exit;
		
	}
	
	
	
	
	
	public function edittargetplan() {
		
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('planning');
        // $companies =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        
		$userid = JRequest::getVar('userid', '', 'post', 'int');
		$memberid = JRequest::getVar('memberid', '', 'post', 'int');
		$planningid = JRequest::getVar('id', '', 'post', 'int');
		
		$companyid = JRequest::getVar('companyid', 0, 'post', 'int');
        $companyname = JRequest::getVar('company_name', '', 'post', 'string');
		$num_shares = JRequest::getVar('num_shares', 0, 'post', 'int');
        $when_date = JRequest::getVar('when_date', 0, 'post', 'string');
		
		$data_array['userid'] = $userid;
		$data_array['memberid'] = $memberid;
		$data_array['companyid'] = $companyid;
		$data_array['num_shares'] = $num_shares;
		$data_array['when_to_purchase'] = $this->createDateString($when_date);
		
		if($model->updatePlanningRecord($planningid, $data_array)) {
			// http_response_code(200);
			header('Content-type: text/plain');
			echo "Your Reminder has been editted successfully";
			exit();
		} else {
			// http_response_code(500);
            header('Content-type: text/plain');
            echo "Your Reminder could not be saved";
            exit();
		}
		
		/*
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $application =& JFactory::getApplication();
        $model =& $this->getModel('planning');
        // $companies =& $this->getModel('companies');
        $refer = JRoute::_($_SERVER['HTTP_REFERER']);
        
		$userid = JRequest::getVar('userid', '', 'post', 'int');
		$memberid = JRequest::getVar('memberid', '', 'post', 'int');
		
		$companyid = JRequest::getVar('companyid', 0, 'post', 'int');
        $companyname = JRequest::getVar('company_name', '', 'post', 'string');
		$num_shares = JRequest::getVar('num_shares', 0, 'post', 'int');
        $when_date = JRequest::getVar('when_date', 0, 'post', 'string');
		
		$planningid = JRequest::getVar('id', '', 'post', 'int');
		$data_array['userid'] = $userid;
		$data_array['memberid'] = $memberid;
		$data_array['companyid'] = $companyid;
		$data_array['num_shares'] = $num_shares;
		$data_array['when_to_purchase'] = $this->createDateString($when_date);
		
		if(!$model->updatePlanningRecord($planningid, $data_array)) {
			$application->redirect($refer, 'Database error. Failed to update Plan.', 'error');
		} else {
			$application->redirect($refer, 'Your plan has been editted successfully.', 'success');
		}
		*/
		 // print_r($data_array);
		 // exit;
		
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
	
	
	
	
	
	
	
    

	
	
	
	
	
}