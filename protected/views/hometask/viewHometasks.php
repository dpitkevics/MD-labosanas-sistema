<?php
/* @var $this HometaskController */

$this->breadcrumbs=array(
    'Hometask' => array('/hometask/index'),
    'My Hometasks'    
);
?>

<h1>My Hometasks</h1>

<div class="row">
    <?php foreach ($userHometasks as $uht): ?>
    <div class="row">
        <div class="row">
            Zip ID: <?php echo $uht->hometask->zipID; ?>
        </div>
        <div class="row">
            Title: <?php echo $uht->hometask->title; ?>
        </div>
        <div class="row">
            Is Imported: <?php echo $uht->hometask->isImported ? "Yes" : "No"; ?>
        </div>
        <div class="row">
            Index file: <?php echo $uht->hometask->indexFile; ?>
        </div>
        <div class="row">
            Term: <?php echo date('Y-m-d', $uht->hometask->term); ?>
        </div>
        <hr />
    </div>
    <?php endforeach; ?>
</div>