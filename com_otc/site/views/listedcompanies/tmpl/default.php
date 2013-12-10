<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access'); 
$document =& JFactory::getDocument();
$document->addStyleDeclaration('table .text-center {text-align: center}');
?>

<div style="width:98%;">
  <div id="breadcrumbs" style="margin-bottom: 10px">
    <div class="module">
      <div class="breadcrumbs">
        <a href="/" class="pathway">Home</a> 
        &nbsp;<i class="icon-caret-right"></i>&nbsp; 
        <span>Listed Companies</span>
      </div>
    </div>
  </div>
  
  <div class="row-fluid">
  <table class="table table-bordered">
   <thead>
    <tr>
      <th>
        All Listed Companies
      </th>
    </tr>
  </thead>
  
  <tbody style="background-color:#f5f5f5;">
    <tr>
      <td>
        Below are all companies listed on LanteOTC market-place. To view more details for any of the companies, simply click on desired company below.
      </td>
    </tr>
  </tbody>
 </table>
 </div>
 
 <div class="row-fluid">
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Companies</th>
        <th class="text-center">Last(c)</th>
        <th class="text-center">Change</th>
        <th class="text-center">%Change</th>
        <th class="text-center">Time</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach($this->companies as $company) :
    ?>
        <tr>
          <td><a href="<?php echo $this->parseUrl('index.php?option=com_otc&view=company&id=' .$company->id); ?>"><?php echo $company->name; ?></a></td>
          <td class="text-center"><?php echo $company->share_price; ?></td>
          <td class="text-center"><?php echo $this->calcChange($company->share_price, $company->prev_price); ?></td>
          <td class="text-center"><?php echo $this->calcPChange($company->share_price, $company->prev_price); ?></td>
          <td class="text-center"><?php echo $this->getTime($company->ts, $company->last_updated); ?></td>
        </tr>
    <?php
      endforeach;
    ?>
    </tbody>
  </table>
</div>
<div class="row-fluid" style="text-align: center; border-top: 0px">
    <?php echo @$this->pagination->getPagesLinks(); ?>
</div>

</div>