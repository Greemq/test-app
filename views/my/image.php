
<?php
use yii\helpers\Html;
$baseUrl='https://unsplash.com/photos/'
?>
<div class="container text-center">
<?= Html::img($baseUrl.$model->service_id.'/download',['style'=>'max-height:85vh']) ?>
</div>

