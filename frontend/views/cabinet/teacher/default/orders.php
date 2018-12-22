<?php
/* @var $this yii\web\View */

/* @var $order \shop\entities\shop\course\Order*/
/* @var $orderEditForm \shop\forms\course\order\OrderEditForm*/
/* @var $searchModel \frontend\forms\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $courses[] \shop\entities\shop\course\Course */
/* @var $course \shop\entities\shop\course\Course */
/* @var $orderCommentCreateForm \shop\forms\course\order\OrderCommentCreateForm */
/* @var $comment \shop\entities\shop\course\OrderComment*/


use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use shop\helpers\OrderHelper;
use yii\helpers\Url;
use shop\entities\shop\course\Order;
use shop\entities\shop\course\Course;


$this->title = 'Заявки';
$this->params['active_orders'] = 'active';
?>

<div class="tab-cabinet-container tab-orders active">
    <?php if (!empty($courses)): ?>
        <div class="orders-header">
            <select name="status" class="orders-select" id="dynamic_select">
                <option value="<?= Url::to(['orders']) ?>">Все курсы</option>
                <?php if (isset($course)): ?>
                    <?php foreach ($courses as $item): ?>
                        <?php /**@var Course $item */ ?>
                        <?php if ($item->id == $course->id): ?>
                            <option value="<?= Url::to(['orders-by-course', 'id' => $item->id]) ?>" selected><?= Html::encode($item->name); ?></option>
                        <?php else: ?>
                            <option value="<?= Url::to(['orders-by-course', 'id' => $item->id]) ?>"><?= Html::encode($item->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php foreach ($courses as $item): ?>
                        <?php /**@var Course $item */ ?>
                        <option value="<?= Url::to(['orders-by-course', 'id' => $item->id]) ?>"><?= Html::encode($item->name); ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <a href="#" class="archive">Перейти к архиву <i class="fa fa-trash" aria-hidden="true"></i></a>
        </div>
    <?php  endif; ?>
    <?php if (!empty($orders)): ?>
        <div class="row">
            <div class="col-md-12 orders-container orders-static">
                <div class="col-md-4">
                    <h3>Новые заявки</h3>
                    <?php foreach ($orders as $order): ?>
                        <?php if ($order->status == Order::STATUS_NEW): ?>
                            <div class="order-item">
                                <a href="#" data-mfp-src="#order_popup_<?= Html::encode($order->id); ?>" class="open-order-popup">
                                    <div class="order-item-header">
                                        <p class="name"><?= Html::encode($order->username); ?></p>
                                        <p class="date"><?= OrderHelper::echoDate($order->created_at); ?></p>
                                    </div>
                                    <div class="order-item-center">
                                        <p class="course-name"><?= Html::encode($order->title); ?></p>
                                    </div>
                                </a>
                                <div class="order-item-bottom">
                                    <p class="order-item-bottom-price"><?= Html::encode($order->price); ?> грн.</p>
                                    <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <h3>В обработке</h3>
                    <?php foreach ($orders as $order): ?>
                        <?php if ($order->status == Order::STATUS_PROCESSING): ?>
                            <div class="order-item">
                                <a href="#" data-mfp-src="#order_popup_<?= Html::encode($order->id); ?>" class="open-order-popup">
                                    <div class="order-item-header">
                                        <p class="name"><?= Html::encode($order->username); ?></p>
                                        <p class="date"><?= OrderHelper::echoDate($order->created_at); ?></p>
                                    </div>
                                    <div class="order-item-center">
                                        <p class="course-name"><?= Html::encode($order->title); ?></p>
                                    </div>
                                </a>
                                <div class="order-item-bottom">
                                    <p class="order-item-bottom-price"><?= Html::encode($order->price); ?> грн.</p>
                                    <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <h3>Обработаные</h3>
                    <?php foreach ($orders as $order): ?>
                        <?php if ($order->status == Order::STATUS_COMPLETED): ?>
                            <div class="order-item">
                                <a href="#" data-mfp-src="#order_popup_<?= Html::encode($order->id); ?>" class="open-order-popup">
                                    <div class="order-item-header">
                                        <p class="name"><?= Html::encode($order->username); ?></p>
                                        <p class="date"><?= OrderHelper::echoDate($order->created_at); ?></p>
                                    </div>
                                    <div class="order-item-center">
                                        <p class="course-name"><?= Html::encode($order->title); ?></p>
                                    </div>
                                </a>
                                <div class="order-item-bottom">
                                    <p class="order-item-bottom-price"><?= Html::encode($order->price); ?> грн.</p>
                                    <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-12 orders-container orders-slide">
                <div class="owl-carousel">
                    <div class="col-md-4">
                        <h3>Новые заявки</h3>
                        <?php foreach ($orders as $order): ?>
                            <?php if ($order->status == Order::STATUS_NEW): ?>
                                <div class="order-item">
                                    <a href="#" data-mfp-src="#order_popup_<?= Html::encode($order->id); ?>" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name"><?= Html::encode($order->username); ?></p>
                                            <p class="date"><?= OrderHelper::echoDate($order->created_at); ?></p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name"><?= Html::encode($order->title); ?></p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price"><?= Html::encode($order->price); ?> грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-4">
                        <h3>В обработке</h3>
                        <?php foreach ($orders as $order): ?>
                            <?php if ($order->status == Order::STATUS_PROCESSING): ?>
                                <div class="order-item">
                                    <a href="#" data-mfp-src="#order_popup_<?= Html::encode($order->id); ?>" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name"><?= Html::encode($order->username); ?></p>
                                            <p class="date"><?= OrderHelper::echoDate($order->created_at); ?></p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name"><?= Html::encode($order->title); ?></p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price"><?= Html::encode($order->price); ?> грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-md-4">
                        <h3>Обработаные</h3>
                        <?php foreach ($orders as $order): ?>
                            <?php if ($order->status == Order::STATUS_COMPLETED): ?>
                                <div class="order-item">
                                    <a href="#" data-mfp-src="#order_popup_<?= Html::encode($order->id); ?>" class="open-order-popup">
                                        <div class="order-item-header">
                                            <p class="name"><?= Html::encode($order->username); ?></p>
                                            <p class="date"><?= OrderHelper::echoDate($order->created_at); ?></p>
                                        </div>
                                        <div class="order-item-center">
                                            <p class="course-name"><?= Html::encode($order->title); ?></p>
                                        </div>
                                    </a>
                                    <div class="order-item-bottom">
                                        <p class="order-item-bottom-price"><?= Html::encode($order->price); ?> грн.</p>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php foreach ($orders as $order): ?>
            <div id="order_popup_<?= Html::encode($order->id); ?>" class="white-popup mfp-hide order_popup">
                <div class="row order-popup-wrap">
                    <div class="col-sm-4">
                        <?php $form = ActiveForm::begin(['action' => Url::to(['edit-order'])]); ?>
                            <div class="order-info-wrap">
                                <div class="row popup-order-info">
                                    <div class="col-xs-4">
                                        <p class="popup-order-name popup-order-status">Статус</p>
                                    </div>
                                    <div class="col-xs-8 header-search-city">
                                        <?= $form->field($orderEditForms[$order->id], 'course_id')->hiddenInput(['id' => 'course_id'. $order->id, 'value' => $order->course_id])->label(false);  ?>
                                        <?= $form->field($orderEditForms[$order->id], 'order_id')->hiddenInput(['id' => 'order_id'. $order->id, 'value' => $order->id])->label(false);  ?>

                                        <?= $form->field($orderEditForms[$order->id], 'status')->dropDownList(OrderHelper::selectStatusList(), ['id' => 'status'. $order->id])->label(false); ?>
                                    </div>
                                </div>
                                <div class="row popup-order-info">
                                    <div class="col-xs-4">
                                        <p class="popup-order-name">Название</p>
                                    </div>
                                    <div class="col-xs-8">
                                        <?= $form->field($orderEditForms[$order->id], 'title')->textInput(['id' => 'title'. $order->id])->label(false);  ?>
                                    </div>
                                </div>
                                <div class="row popup-order-info">
                                    <div class="col-xs-4">
                                        <p class="popup-order-name">Цена</p>
                                    </div>
                                    <div class="col-xs-8">
                                        <p class="popup-order-value"><?= Html::encode($order->price); ?> грн.</p>
                                    </div>
                                </div>
                                <div class="row popup-order-info">
                                    <div class="col-xs-4">
                                        <p class="popup-order-name">Имя</p>
                                    </div>
                                    <div class="col-xs-8">
                                        <p class="popup-order-value"><?= Html::encode($order->username); ?></p>
                                    </div>
                                </div>
                                <div class="row popup-order-info">
                                    <div class="col-xs-4">
                                        <p class="popup-order-name">Телефон</p>
                                    </div>
                                    <div class="col-xs-8">
                                        <p class="popup-order-value"><?= Html::encode($order->phone); ?></p>
                                    </div>
                                </div>
                                <div class="row popup-order-info">
                                    <div class="col-xs-4">
                                        <p class="popup-order-name">Курс</p>
                                    </div>
                                    <div class="col-xs-8">
                                        <p class="popup-order-value"><?= Html::encode($order->course->name); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-block button-pure order-submit" data-url="<?= Url::to(['/cabinet/teacher/edit-order'], true); ?>">Сохранить</button>
                                </div>
                            </div>
                        <?php ActiveForm::end() ?>
                    </div>
                    <div class="col-sm-8 popup-order-comments">
                        <div class="comment-container">
                            <?php if (!empty($order->orderComments)): ?>
                                <?php foreach ($order->orderComments as $comment): ?>
                                    <div class="comment">
                                        <?= Html::a('<i class="fa fa-trash" aria-hidden="true"></i>', Url::to(['delete-order-comment'], true), [
                                            'class' => 'delete-comment',
                                            'data-id' => $comment->id,
                                        ]) ?>
                                        <p><?= Html::encode($comment->text); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php  endif; ?>
                        </div>
                        <?php $form = ActiveForm::begin([
                                'class' => 'popup-order-form',
                                'id' => 'order-comment-form'.$order->id,
                        ]); ?>
                            <div class="row">
                                <div class="col-xs-12">
                                    <?= $form->field($orderCommentCreateForm, 'order_id')->hiddenInput(['value' => $order->id, 'data-url' => Url::to([''], true)])->label(false); ?>
                                    <?= $form->field($orderCommentCreateForm, 'text')->textarea(['rows' => 3])->label(false); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 float-r">
                                    <button type="submit" class="btn btn-block btn-default popup-comment-btn">Добавить комментарий</button>
                                </div>
                            </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    <?php else: ?>
        <p>Список заявок пуст</p>
    <?php endif; ?>
</div>


