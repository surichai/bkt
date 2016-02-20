<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'สร้างสมาชิก';
$this->params['breadcrumbs'][] = ['label' => 'จัดการสมาชิก', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <div class="card  ">
        <div class="card-head">
            <div class="tools">
                <div class="btn-group">
                    <div class="btn-group">

                    </div>
                    <a class="btn btn-icon-toggle btn-refresh"><i class="md md-refresh"></i></a>
                    <a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
                    <a class="btn btn-icon-toggle btn-close "><i class="md md-close"></i></a>
                </div>
            </div>
            <header> <h1><i class=" faa-horizontal animated-hover fa fa-users fa-2x"> </i> <?= Html::encode($this->title) ?></h1></header>
        </div><!--end .card-head -->
        <div class="card-body style-default-bright">

    <?= $this->render('_form', [
        'model' => $model,
        'user'=>$user,
        'amphur'=> $amphur,
        'district' =>$district,
    ]) ?>

</div>
    </div>
