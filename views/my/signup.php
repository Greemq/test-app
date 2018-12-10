<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

?>

<div style="max-width: 400px;">
<?php $form=ActiveForm::begin()?>
    <?= $form->field($model,'username')?>
    <?= $form->field($model,'password')->passwordInput()?>
    <div class="form-group">
        <?= Html::submitButton('регистрация',['class'=>'btn btn-success'])?>
    </div>

<?php ActiveForm::end()?>
</div>
