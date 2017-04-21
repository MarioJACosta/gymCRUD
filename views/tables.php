<?php
require_once dirname(__FILE__) . '/header.php';
require_once dirname(__FILE__) . '/navBar.php';
?>

<div class="row-fluid">
    <div class="col-sm-8 col-md-8 col-lg-6">
        <h2><?php echo ucfirst($table).':';?></h2>
    <?php include_once $table.'Table.php';?>
    </div>
</div>
