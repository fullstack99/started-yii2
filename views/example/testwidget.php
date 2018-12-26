<?php 
   use yii\bootstrap\Progress;   
   use app\components\FirstWidget; 
?> 
<?= Progress::widget(['percent' => 60, 'label' => 'Progress 60%']) ?>
<?php FirstWidget::begin(); ?>
   Second Widget in H1
<?php FirstWidget::end(); ?>