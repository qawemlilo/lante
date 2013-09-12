<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
    
    function centsToRands($cents) {
        return number_format($cents/100, 2);
    }
?>

<div>
   <ul class="nav nav-pills" style="margin-bottom: 0px">
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin'); ?>"><i class="icon-user"></i> Registered Members</a>
    </li>
    <li  class="disabled">
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=companies'); ?>"><i class="icon-briefcase"></i> Listed Companies</a>
    </li>
    <li>
      <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=transactions'); ?>"><i class="icon-signal"></i> Transactions</a>
    </li>
  </ul>
  <hr style="margin-top: 0px" />
</div>


<div class="row-fluid">
<form name="companies" id="companies-form" method="GET" action="index.php">
  <p style="text-align:right">
    <button type="submit" class="btn btn-primary btn-success">
      <i class="icon-edit"></i> Edit
    </button>
    
    <a href="<?php echo JRoute::_(JURI::base() . 'index.php?option=com_otc&view=admin&layout=newcompany'); ?>" class="btn btn-primary" type="button">
      Add Company
    </a>
  </p>
  
  <?php
  if (is_array($this->companies) && count($this->companies) > 0) :
  ?>
  
  <input type="hidden" name="option" value="com_otc">
  <input type="hidden" name="view" value="admin">
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

<script>
jQuery.noConflict();

(function ($) {
    $(function () {
        $("#companies-form").on("submit", function (event) {
        
            if (!$("input[name=id]:checked").val()) {
                alert("Please chose a company that you would like to edit");
                return false;
            }
            
            return true;
        });
    });
})(jQuery);
</script>