<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


use yii\helpers\ArrayHelper;
use common\models\Amphur;
use common\models\Province;
use common\models\District;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

?>

<div class="personnel-form">

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'form-horizontal'],
    ]); ?>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">คำนำหน้า</label>
        <div class="col-sm-8">
            <?= $form->field($model, 'title')->label(false)->radioList($model->getItemTitle(),
                ['prompt' => 'เลือกคำนำหน้า..']
            ) ?>

        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">ชื่อ-นามสกุล</label>
        <div class="col-sm-4">
            <?= $form->field($model, 'firstname')->label(false)->textInput(['placeholder' => 'กรอกชื่อ',]) ?>

        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'lastname')->label(false)->textInput(['placeholder' => 'กรอกนามสกุล',]) ?>

        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">เพศ</label>
        <div class="col-sm-8">

            <?= $form->field($model, 'sex')->label(false)->radioList($model->getItemSex()) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">เลขบัตรประชาชน</label>
        <div class="col-sm-8">

            <?= $form->field($model, 'identification')->label(false)->hiddenInput()->widget(\yii\widgets\MaskedInput::classname(), [
                'mask' => '9-9999-99999-99-9',
                'clientOptions' => [
                    'removeMaskOnSubmit' => true //กรณีไม่ต้องการให้มันบันทึก format ลงไปด้วยเช่น 9-9999-99999-999 ก็จะเป็น 9999999999999
                ],
                'options' => ['class' => 'form-control',
                    'placeholder' => 'เลขบัตรประชาชน',
                ]
            ]) ?>

        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">วันเกิด</label>
        <div class="col-sm-8">

            <?= dosamigos\datepicker\DatePicker::widget([
                'model' => $model,
                'attribute' => 'birthday',
                'language' => 'th',
                'template' => '{addon}{input}',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy/m/d'
                ]
            ]); ?>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">สถานะ</label>
        <div class="col-sm-4">
            <?= $form->field($model, 'marital')->label(false)->dropDownList($model->getItemMarital()
                , [
                    'prompt' => 'เลือกสถานะ'
                ]) ?>

        </div>

    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">บ้านเลขที่, ถนน, หมู่บ้าน</label>
        <div class="col-sm-8">

            <?= $form->field($model, 'address')->label(false)->textInput(['placeholder' => 'กรอก บ้านเลขที่, ถนน, หมู่บ้าน']) ; ?>


        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">จังหวัด,อำเภอ,ตำบล</label>
        <div class="col-sm-8">


            <div class="col-sm-4 ">
                <?= $form->field($model, 'province')->label(false)->dropdownList(
                    ArrayHelper::map(Province::find()->all(),
                        'PROVINCE_ID',
                        'PROVINCE_NAME'),
                    [
                        'id' => 'ddl-province',
                        'prompt' => 'เลือกจังหวัด'
                    ]); ?>
            </div>
            <div class="col-sm-4 ">
                <?= $form->field($model, 'amphur')->label(false)->widget(DepDrop::classname(), [
                    'options' => ['id' => 'ddl-amphur'],
                    'data' => $amphur,
                    'pluginOptions' => [
                        'depends' => ['ddl-province'],
                        'placeholder' => 'เลือกอำเภอ...',
                        'url' => Url::to(['/student/get-amphur'])
                    ]
                ]); ?>
            </div>
            <div class="col-sm-4 ">
                <?= $form->field($model, 'district')->label(false)->widget(DepDrop::classname(), [
                    'data' => $district,
                    'pluginOptions' => [
                        'depends' => ['ddl-province', 'ddl-amphur'],
                        'placeholder' => 'เลือกตำบล...',
                        'url' => Url::to(['/student/get-district'])
                    ]
                ]); ?>
            </div>

        </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">เบอร์โทร</label>
        <div class="col-sm-8">

            <?= $form->field($model, 'phone')->label(false)->hiddenInput()->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '999-999-9999',

                'clientOptions' => [
                    'removeMaskOnSubmit' => true //กรณีไม่ต้องการให้มันบันทึก format ลงไปด้วยเช่น 9-9999-99999-999 ก็จะเป็น 9999999999999
                ],
                'options' => ['class' => 'form-control',
                    'placeholder' => 'โทรศัพท์มือถือ',
                ]
            ]) ?>


        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">E-mail</label>
        <div class="col-sm-8">
            <?=
            $form->field($user, 'email')->label(false)->hiddenInput()->textInput(['placeholder' => 'example@example.com...']);

            ?>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">เงินเดือน</label>
        <div class="col-sm-8">
            <?= $form->field($model, 'salary')->textInput()->label(false) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">วันที่ลาออก</label>
        <div class="col-sm-8">
            <?= $form->field($model, 'expire_date')->textInput()->label(false) ?>
        </div>
    </div>


    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">ชื่อผู้ใช้งาน</label>
        <div class="col-sm-8">
            <?= $form->field($user, 'username')->label(false)->hiddenInput()->textInput(['maxlength' => true, 'placeholder' => 'กรอกข้อมูลชื่อผู้ใช้งาน']) ?>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-2"></div>
        <label for="inputEmail3" class="col-sm-2 form-control-label">รหัสผ่าน</label>
        <div class="col-sm-4">

            <?= $form->field($user, 'password')->label(false)->hiddenInput()->passwordInput(['placeholder' => 'กรอกรหัสผ่าน']) ?>

        </div>
        <div class="col-sm-4">
            <?= $form->field($user, 'confirm_password')->label(false)->hiddenInput()->passwordInput(['placeholder' => 'กรอกรหัสผ่านยืนยัน']) ?>
        </div>

    </div>


    <div class="form-group text-center ">
        <?= Html::a('<i class="faa-pulse  wa animated fa fa-arrow-circle-left"></i> ยกเลิก', ['index'],
            ['class' => 'btn btn-danger btn-lg']) ?>
        <?= Html::submitButton($model->isNewRecord ? '<i class="faa-wrench animated fa fa-save"> </i> บันทีก' : '<i class="faa-wrench animated fa fa-pencil-square-o"> </i>ปรับปรุง', ['class' => $model->isNewRecord ? 'btn  btn-success btn-lg' : 'btn  btn-primary btn-lg']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
