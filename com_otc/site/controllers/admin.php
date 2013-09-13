<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');


class OtcControllerAdmin extends JController
{
	function display() {
        $view = $this->getView( 'admin', 'html' );
        $view->setModel( $this->getModel( 'admin' ), true );
        $view->setModel( $this->getModel( 'company' ) );
        $view->display();
    }
}