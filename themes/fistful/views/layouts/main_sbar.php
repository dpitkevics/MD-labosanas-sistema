<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"[]>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
    <head>
        <!--
        Created by Artisteer v3.1.0.46558
        Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
        -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo CHtml::encode(Yii::app()->name); ?></title>



        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" type="text/css" media="screen, projection" />
        <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
        <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/favicon.ico" type="image/x-icon" />
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/script.js"></script>
        <style type="text/css">
            .art-post .layout-item-0 { padding-right: 10px;padding-left: 10px; }
            .ie7 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
            .ie6 .art-post .art-layout-cell {border:none !important; padding:0 !important; }
        </style>

    </head>
    <body>
        <div id="art-main">
            <div class="cleared reset-box"></div>
            <div class="art-bar art-nav">
                <div class="art-nav-outer">
                    <div class="art-nav-wrapper">
                        <div class="art-nav-inner">
                            <?php
                            $this->widget('application.components.ArtMenu', array(
                                'cls' => 'art-hmenu',
                                'items'=>array(
                                        array('label'=>'Home', 'url'=>array('/site/index')),
                                        array('label'=>'Hometasks', 'url'=>array('/hometask/index'), 'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Criteria', 'url'=>array('/criteria/index'), 'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Contact', 'url'=>array('/site/contact'), 'visible'=>!Yii::app()->user->isGuest),
                                        array('label'=>'Registration', 'url'=>array('/site/registration'), 'visible'=>Yii::app()->user->isGuest),
                                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                                ),
                            ));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cleared reset-box"></div>
            <div class="art-header">
                <div class="art-header-position">
                    <div class="art-header-wrapper">
                        <div class="cleared reset-box"></div>
                        <div class="art-header-inner">
                            <div class="art-logo">
                               <h1 class="art-logo-name"><a href="#"><?php echo isset(Yii::app()->params['art-logo-name']) ? Yii::app()->params['art-logo-name'] : Yii::app()->name; ?></a></h1> 
                                <h2 class="art-logo-text"><?php echo Yii::app()->params['art-logo-text']; ?></h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="cleared reset-box"></div>
            <div class="art-box art-sheet">
                <div class="art-box-body art-sheet-body">
                    <div class="art-layout-wrapper">
                        <div class="art-content-layout">
                            <div class="art-content-layout-row">
                                <div class="art-layout-cell art-content">
                                    <div class="art-box art-post">
                                        <div class="art-box-body art-post-body">
                                            <div class="art-post-inner art-article">
                                                <!-- <h2 class="art-postheader">Page 1
                                                </h2> -->
                                                <div class="art-postcontent">
                                                    <!-- Main content goes here -->
                                                    <?php echo $content; ?>
                                                </div>
                                               <div class="cleared"></div>
                                            </div>
                                            <div class="cleared"></div>
                                        </div>

                                        <div class="cleared"></div>
                                    </div>
                                </div>

                                <div class="art-layout-cell art-sidebar1">
                                    <div class="art-box art-vmenublock">
                                        <div class="art-box-body art-vmenublock-body">
                                            <div class="art-bar art-vmenublockheader">
                                                <h3 class="t">Vertical Menu</h3>
                                            </div>
                                            <div class="art-box art-vmenublockcontent">
                                                <div class="art-box-body art-vmenublockcontent-body">
                                                    <?php
                                                    $this->widget('application.components.ArtMenu', array(
                                                        'cls' => 'art-vmenu',
                                                        'items' => array(
                                                            array('label' => 'Home', 'url' => array('/site/index')),
                                                            array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                                                            array('label' => 'Contact', 'url' => array('/site/contact')),
                                                            array('label' => 'Login', 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
                                                            array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/userGroups/user/logout'), 'visible' => !Yii::app()->user->isGuest),
                                                        ),
                                                    ));
                                                    ?>

                                                    <div class="cleared"></div>
                                                </div>
                                            </div>
                                            <div class="cleared"></div>
                                        </div>
                                    </div>
                                    <div class="art-box art-block">
                                        <div class="art-box-body art-block-body">
                                            <div class="art-box art-blockcontent">
                                                <div class="art-box-body art-blockcontent-body">
                                                    <p>Enter Block content here...</p>

                                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra, tellus sit amet congue vulputate, nisi erat iaculis nibh, vitae feugiat sapien ante eget mauris.</p>
                                                    <div class="cleared"></div>
                                                </div>
                                            </div>
                                            <div class="cleared"></div>
                                        </div>
                                    </div>

                                    <div class="cleared"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cleared"></div>
                    <div class="art-footer">
                        <div class="art-footer-body">
                            <a href="#" class="art-rss-tag-icon" title="RSS"></a>
                            <div class="art-footer-text">
                                <p><a href="#">Link1</a> | <a href="#">Link2</a> | <a href="#">Link3</a></p>

                                <p>Copyright © 2012. All Rights Reserved.</p>
                            </div>
                            <div class="cleared"></div>
                        </div>
                    </div>
                    <div class="cleared"></div>
                </div>
            </div>
            <div class="cleared"></div>
            <p class="art-page-footer"><a href="http://www.artisteer.com/?p=website_templates" target="_blank">Website Template</a> created with Artisteer.</p>
            <div class="cleared"></div>
        </div>

    </body>
</html>
