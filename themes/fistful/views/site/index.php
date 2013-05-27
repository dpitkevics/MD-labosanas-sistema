<?php $this->pageTitle = Yii::app()->name; ?>
<?php $this->layout = 'column2'; ?>
<!-- demo content for the Artisteer theme -->
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell layout-item-0" style="width: 100%;">
            <p><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/preview.jpg" alt="an image" id="preview-image" name="preview-image" /> <!-- Enter Page content here...</p>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pharetra, tellus sit amet congue vulputate, nisi erat iaculis nibh, vitae feugiat sapien ante eget mauris. Aenean sollicitudin imperdiet arcu, vitae dignissim est posuere id.</p>

            <p><a href="#">Read more</a></p>  -->
            <p>You may change the content of this page by modifying the following two files:
            </p>
            <ul>
                <li>View file: <tt><?php echo __FILE__; ?></tt></li>
                <li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
            </ul>

        </div>
    </div>
</div>
<div class="art-content-layout">
    <div class="art-content-layout-row">
        <div class="art-layout-cell layout-item-0" style="width: 50%;">
            <ul>
                <li>Suspendisse pharetra auctor pharetra. Nunc a sollicitudin est.</li>

                <li>Donec vel neque in neque porta venenatis sed sit amet lectus.</li>

                <li>Curabitur ullamcorper gravida felis, sit amet scelerisque lorem iaculis sed.</li>
            </ul>
        </div><div class="art-layout-cell layout-item-0" style="width: 50%;">
            <blockquote style="margin: 10px 0">
                Nunc a sollicitudin est. Curabitur ullamcorper gravida felis, sit amet scelerisque lorem iaculis sed. Donec vel neque in neque porta venenatis sed sit amet lectus.
            </blockquote>
        </div>
    </div>
</div>
