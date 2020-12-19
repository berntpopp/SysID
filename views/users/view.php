<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\user\User */

$this->title = $model->user_id;

?>
<div class="container user-view">
    
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Delete', ['class'=>'btn btn-danger', 'data-toggle'=>'modal', 'data-target'=>'.bs-example-modal-sm']) ?>
        <?= Html::a('Users', './', ['class' => 'btn btn-info']) ?>
    </p>
    
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                  <div class="modal-body">
                      <p>Are you sure you want to delete selected item?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <?= Html::beginForm(['delete', 'id' => $model->user_id], 'post', ['class'=>'inline']) ?>
                    <?= Html::submitButton('Delete', ['class' => 'btn btn-danger']) ?>
                    <?= Html::endForm() ?>
                  </div>
              </div>
            </div>
        </div>
    

    <?= DetailView::widget([
        'model' => $model,        
        'attributes' => [            
            'user_name',
            'user_designation',
            'user_email:email',
            'user_institution_name',
            'user_remark:ntext',
            'user_password',
            'user_role',
            'date_of_entry',
            'date_of_update',
            'status',
            'auth_key',
            'password_reset_token',
        ],
    ]) ?>

</div>
