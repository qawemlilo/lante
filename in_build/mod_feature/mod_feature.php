<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

require_once(dirname(__FILE__).DS.'helper.php');

$companies = ModfeatureHelper::getCompanies();
$summary = ModfeatureHelper::getSummary();

$member = ModfeatureHelper::getMember();
$investments = ModfeatureHelper::getMyInvestments();
$plannings = ModfeatureHelper::getMyPlannings();


$allcompanies = ModfeatureHelper::getAllCompanies();

if($_GET["tnxid"] && $_GET["checksum"] && $_GET["parity"]) {
	$savepayment = ModfeatureHelper::savePayment($_GET["tnxid"], $_GET["checksum"], $_GET["parity"]);
}
	
require(JModuleHelper::getLayoutPath('mod_feature'));

