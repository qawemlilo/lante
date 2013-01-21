<?php
/**
 * @copyright	Copyright (C) 2005 - 2011 Joomlashack / Meritage Assets
 * @author		Jeremy Wilken - Joomlashack
 * @package		Wright
 *
 * Use this file to add any PHP to the template before it is executed
 */
 
// Restrict Access to within Joomla
defined('_JEXEC') or die('Restricted access');


function wright_joomla_mod_login($buffer) {
	$buffer = preg_replace('/ id="login-form"/Ui', ' id="login-form" class="form-inline" ', $buffer);
	$buffer = preg_replace('/<ul>/Ui', '<ul  class="nav nav-list well">', $buffer);
	$buffer = preg_replace('/ class="button"/Ui', ' class="button btn btn-warning" ', $buffer);
	return $buffer;
				
}