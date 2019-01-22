<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;

$activeCourse = isset($this->params['active_course']) ? $this->params['active_course'] : null;
$activeOrders = isset($this->params['active_orders']) ? $this->params['active_orders'] : null;
$activeTeacherMainInfo = isset($this->params['active_teacher_main_info']) ? $this->params['active_teacher_main_info'] : null;
$activePayments = isset($this->params['active_payments']) ? $this->params['active_payments'] : null;
$activeProfile = isset($this->params['active_profile']) ? $this->params['active_profile'] : null;
?>

<?php $this->beginContent('@frontend/views/layouts/main.php') ?>

<main>
    <div class="container">
        <div class="row cabinet-company">
            <div class="col-md-3 tab-labels">
                <a href="<?= Url::to(['index']); ?>" class="tab-company <?= $activeCourse; ?>" title="Мои курсы">
                    <span class="tab-company-text">Мои курсы</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </span>
                </a>
                <a href="<?= Url::to(['orders']); ?>" class="tab-company <?= $activeOrders; ?>" title="Заявки">
                    <span class="tab-company-text">Заявки</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-bullseye" aria-hidden="true"></i>
                    </span>
                </a>
                <a href="<?= Url::to(['teacher-main-info']); ?>" class="tab-company <?= $activeTeacherMainInfo; ?>" title="Основная информация">
                    <span class="tab-company-text">Основная информация</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-server"></i>
                    </span>
                </a>
                <a href="<?= Url::to(['payment']); ?>" class="tab-company <?= $activePayments; ?>" title="Услуги и платежи">
                    <span class="tab-company-text">Услуги и платежи</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-credit-card" aria-hidden="true"></i>
                    </span>
                </a>
                <a href="<?= Url::to(['profile']); ?>" class="tab-company <?= $activeProfile; ?>" title="Настройки">
                    <span class="tab-company-text">Настройки</span>
                    <span class="tab-company-icon">
                        <i class="fa fa-cog" aria-hidden="true"></i>
                    </span>
                </a>
            </div>
            <div class="col-md-9">
               <?= $content ?>
            </div>
        </div>
    </div>
</main>

<?php $this->endContent() ?>