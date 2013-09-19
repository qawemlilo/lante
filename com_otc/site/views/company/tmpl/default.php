<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<div style="width:98%; margin-top: 15px">
  <div class="row-fluid">
    <div class="media">
      <a class="pull-left" href="#" style="margin-right: 10px">
       <img class="media-object img-polaroid" style="width:120px; height: 120px;" src="http://placehold.it/120&text=Logo+Here">
      </a>
      <div class="media-body">
        <h4 class="media-heading"><?php echo $this->company->name?></h4>
        <p><strong style="color:#fd7800">Website:</strong> <a href="<?php echo $this->company->website; ?>" target="_blank"><?php echo $this->company->website; ?></a></p>
        <p><strong style="color:#fd7800">About Company:</strong> <?php echo $this->company->about; ?></p>
        <p><strong style="color:#fd7800">Company Owner:</strong> <?php echo $this->company->owner_name; ?></p>
      </div>
    </div>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Top 5 bids to buy
            </th>
          </tr>
        </thead>      
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Top 5 bids to sell
            </th>
          </tr>
        </thead>      
      </table>
    </div>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Share Price
            </th>
          </tr>
        </thead>      
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Last 10 Trades
            </th>
          </tr>
        </thead>      
      </table>
    </div>
  </div>
  
  <br>
  
  <div class="row-fluid">
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Market Info
            </th>
          </tr>
        </thead>      
      </table>
    </div>
    
    <div class="span6">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Market Stats
            </th>
          </tr>
        </thead>      
      </table>
    </div>
  </div>
</div>