<?php
   use yii\bootstrap\Alert;
   echo Alert::widget([
      'options' => ['class' => 'alert-success'],
      'body' => Yii::$app->session->getFlash('greeting'),
   ]);
   echo Alert::widget([
      'options' => ['class' => 'alert-info'],
      'body' => Yii::$app->session->getFlash('greeting'),
   ]);
   echo Alert::widget([
      'options' => ['class' => 'alert-warning'],
      'body' => Yii::$app->session->getFlash('greeting'),
   ]);
   	echo Alert::widget([
      'options' => ['class' => 'alert-danger'],
      'body' => Yii::$app->session->getFlash('greeting'),
   ]);
?>