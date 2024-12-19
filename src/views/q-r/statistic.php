<?php

$this->title = 'Статистика';

?>
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-1">
                    <p class="text-center">ID</p>
                </div>
                <div class="col-4">
                    <p>Исходная ссылка</p>
                </div>
                <div class="col-4">
                    <p>Короткая ссылка</p>
                </div>
                <div class="col-1">
                    <p>Кол-во посещения</p>
                </div>
            </div>
        </div>

<?php foreach ($links as $link) {?>

        <div class="col-12">
            <div class="row">
                <div class="col-1">
                    <p class="text-center"><?= $link['id']?></p>
                </div>
                <div class="col-4">
                    <p><?= $link['url']?></p>
                </div>
                <div class="col-4">
                    <p><?= $link['url_generated']?></p>
                </div>
                <div class="col-1">
                    <p><?= $link['countVisit']?></p>
                </div>
            </div>
        </div>

<?php } ?>

    </div>
</div>
