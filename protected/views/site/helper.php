<?php

$this->breadcrumbs = array(
    'Helper'
);

?>

<h1>How to use this system?</h1>

<div class="row">
    <p>
        This is step by step guide on how to use AHCS system.
    </p>
    <p>
        After successful authorization, You should create a new hometask. You can do it by <?php echo CHtml::link('clicking here', array('/hometask/new')); ?>.
    </p>
    <p>
        Form requires zip ID which is received from the name of zip archive downloaded from Moodle system. These are last few digits in the zip archive name.
    </p>
    <p>
        After creating hometask, upload an zip archive received from Moodle system. You can do it by <?php echo CHtml::link('clicking here', array('/hometask/upload')); ?>.
    </p>
    <p>
        Archive's name must have correct name - [Course name]-[task title]-[zip ID].zip, for example, DatZ2019-1st_homework-6788.zip
    </p>
    <p>
        Student sent archives must have correct name too - [Student name] [Student lastname]_[Student ID number]_[Zip ID].zip, for example, Daniels Pitkevics_dp11058_12345.zip
    </p>
    <p>
        After that, run hometask importing, and start creating criteria. You can do it by <?php echo CHtml::link('clicking here', array('/criteria/new')); ?>.
    </p>
    <p>
        Criteria have special variables - PHP variable $context will hold source code, Javascript variable $iframe will be object of an iframe while running hometask live.
    </p>
    <p>
        When creating a type 4 criteria, You must have public method called "run". This type of criterion will have access to source codes, through public $sources variable.
    </p>
    <p>
        After creating a criteria, set it to Your hometask. You can do it by <?php echo CHtml::link('clicking here', array('/criteria/set')); ?>.
    </p>
    <p>
        Now You are ready to check hometasks and grade them.
    </p>
</div>
