<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
    
    function centsToRands($cents) {
        return number_format($cents/100, 2);
    }
    
$document =& JFactory::getDocument();
$document->addStyleDeclaration('#limit {width: 60px}');
?>

<div>
   <ul class="nav nav-pills" style="margin-bottom: 0px">
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=members'); ?>"><i class="icon-user"></i> Registered Members</a>
    </li>
    <li  class="disabled">
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=companies'); ?>"><i class="icon-briefcase"></i> Listed Companies</a>
    </li>
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=transactions'); ?>"><i class="icon-signal"></i> Transactions</a>
    </li>
  </ul>
  <hr style="margin-top: 0px" />
</div>

<div class="row-fluid well well-small" style="margin-bottom:1px">
  <div class="span4">
    <form action="<?php echo JRoute::_('index.php?option=com_otc&view=companies'); ?>" style="margin-bottom: 0px" method="post" name="pagination-form">
    Display # <?php echo @$this->pagination->getLimitBox() ;?>
    </form>
  </div>

  <div class="span8" style="text-align:right">
    <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=companies'); ?>" class="btn btn-large btn-primary" type="button">
      <i class="icon-check"></i> Add Company
    </a>
    
    <button id="submitedit" class="btn btn-primary btn-large btn-success">
      <i class="icon-edit"></i> Edit
    </button>
    
    <button id="deletecompany" class="btn btn-primary btn-large btn-danger">
      <i class="icon-remove"></i> Delete
    </button>
  </div>
</div>
 
<div class="row-fluid">
<form name="companies" id="companies-form" method="GET" action="index.php">  
  <?php
  if (is_array($this->companies) && count($this->companies) > 0) :
  ?>
  
  <input type="hidden" name="option" value="com_otc">
  <input type="hidden" name="view" value="companies">
  <input type="hidden" name="layout" value="editcompany">
  
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th colspan="5" style="text-align:center;">Registered Companies</th>
      </tr>
      <tr>
        <th>&nbsp;</th>
        <th>Company Name</th>
        <th>Website</th>
        <th>About</th>
        <th>Share Price</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach($this->companies as $company) :
    ?>
        <tr>
          <td><input type="radio" name="id" value="<?php echo $company->id; ?>" /></td>
          <td><?php echo $company->name; ?></td>
          <td><?php echo "<a href=\"{$company->website}\" target=\"_blank\">{$company->website}</a>"; ?></td>
          <td><?php echo $company->about; ?></td>
          <td>R<?php echo centsToRands((int)$company->share_price); ?></td>
        </tr>
    <?php
      endforeach;
    ?>
    </tbody>
  </table>

  <?php
    endif;
  ?>
</form>
</div>
<div class="row-fluid" style="text-align: center; border-top: 0px">
    <?php echo @$this->pagination->getPagesLinks(); ?>
</div>
<script>
jQuery.noConflict();

(function ($) {
    $(function () {
        $("#companies-form").on("submit", function (event) {
        
            if (!$("input[name=id]:checked").val()) {
                alert("Please select a company");
                return false;
            }
            
            return true;
        });
        
        $("#submitedit").on("click", function () {
            $("#companies-form").submit();
        });
        
        $("#deletecompany").on("click", function () {
            var id = $("input[name=id]:checked").val(),
                answer;
            
            if (id) {
                answer = confirm("Are you sure you want to permanently delete that company (" + id + ") ?");
            }
            
            return false;
        });
    });
})(jQuery);
</script>