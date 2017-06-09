<?php 

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
// use app\models\Courier;
// use yii\models\Zakaz;
?>

<div class="zakaz-shippingForm">
	<?php $f = ActiveForm::begin(); ?>

	<?= $f->field($shipping, 'id_zakaz')->hiddenInput(['value' => $model])->label(false) ?>

	<?= $f->field($shipping, 'date')->textInput(['type' => 'date'])->label('Дата выполение доставки') ?>

	<?= $f->field($shipping, 'to')->textInput() ?>

	<?= $f->field($shipping, 'from')->textInput() ?>

	<?= $f-> field($shipping, 'commit')->textInput()->label('Доп.указания (только для курьера)') ?>

	<div class="form-group">
		<?= Html::submitButton('Создать доставку', ['class' => 'btn btn-primary']) ?>
	</div>


	<?php ActiveForm::end(); ?>
</div>
