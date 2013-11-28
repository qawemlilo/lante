<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

require_once(dirname(__FILE__).DS.'helper.php');

$companies = ModfeatureHelper::getCompanies();
$summary = ModfeatureHelper::getSummary();

require(JModuleHelper::getLayoutPath('mod_feature'));

