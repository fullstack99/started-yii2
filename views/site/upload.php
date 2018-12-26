<?php
   use yii\widgets\ActiveForm;
   use yii\bootstrap\Alert;
   
   if (Yii::$app->session->getFlash('greeting')) {
	   	echo Alert::widget([
	      	'options' => ['class' => 'alert-success'],
	      	'body' => Yii::$app->session->getFlash('greeting'),
	   	]);
   	}
   	
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']])?>
<?= $form->field($model, 'image')->fileInput() ?>
   <button>Submit</button>
<?php ActiveForm::end() ?>