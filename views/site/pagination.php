<?php
   use yii\widgets\LinkPager;
   use yii\widgets\DetailView;
   use yii\helpers\Html;
?>
<?php foreach ($models as $model): ?>
   <?= $model->id; ?>
   <?= $model->name; ?>
   <?= $model->email; ?>
   <br/>
<?php endforeach; ?>
<?php
   // display pagination
   echo LinkPager::widget([
      'pagination' => $pagination,
   ]);
?>

<?php foreach ($models as $model):
    echo DetailView::widget([
      'model' => $model,
      'attributes' => [
         'id',
         //formatted as html
         'name:html',
         [
            'label' => 'e-mail',
            'value' => $model->email,
         ],
      ],
   ]);
endforeach; ?>