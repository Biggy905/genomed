<?php

use yii\helpers\Url;
use app\assets\ToastrAsset;

ToastrAsset::register($this);

$url = Url::to(['site/create'], true);

$js = <<<JS

$(document).ready(function (e) {
    let button = $('#send-link');
    let image_update = $('#qr_code');
    let content_update = $('#update_content');
    let text_update = $('#update_text');
            
    button.click(function (e) {
        e.preventDefault();
                
        let Form = {};
        Form['link'] = $('input[name=link]').val();
        
        let body = JSON.stringify(Form);
                
        responseFormValidate(
            sendForm(
                'POST',
                '$url',
                'application/json; charset=utf-8',
                'json',
                body
            )
        );
                
        return false;
    })
});

function sendForm(
    method,
    url,
    contentType,
    responseType,
    body
) {
    var sendForm = new XMLHttpRequest();

    sendForm.open(method, url);
    sendForm.setRequestHeader('Content-Type', contentType);
    sendForm.responseType = responseType;
    sendForm.send(body);

    return sendForm;
}

function mapValidateKey(data) {
    let keys = Object.keys(data);

    return keys[0];
}

function responseFormValidate(sendForm) {
    sendForm.onload = function () {
        let response = this.response;
        let image_update = $('#qr_code');
        let content_update = $('#update_content');
        let text_update = $('#update_text');
        
        if (this.status >= 200 && this.status <= 299) {
            let key = mapValidateKey(response['data']);
            
            appendToastSuccess(response['data'][key]);
            image_update.attr('src', response['data']['additional']['qr_code']);
            content_update.show(200);
            text_update.text(response['data']['additional']['link_generated']);
        } else if (this.status >= 400 && this.status <= 499) {
            appendToastError(response['message']);
            image_update.attr('src', '/images/qr_code.png');
            content_update.hide(200);
            text_update.text('Ссылка не сгенерована');
        } else if (this.status >= 500 && this.status <= 599) {
            appendToastError(response['message']);
            image_update.attr('src', '/images/qr_code.png');
            content_update.hide(200);
            text_update.text('Ссылка не сгенерована');
        }
    }
}

const appendToastSuccess = (message) => {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.success(message);
}

const appendToastError = (message) => {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.error(message);
}

JS;

$this->registerJS($js, \yii\web\View::POS_END);

$this->title = 'Главная';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <img width="25%" src="/images/qr_code.png" id="qr_code" alt=""/>
        </div>
        <div class="col-6">
            <form class="mb-3">
                <div class="input-group mb-3">
                    <label for="link" class="input-group-text">
                         Ссылка
                    </label>
                    <input id="link" class="form-control" type="text" name="link" placeholder="Вставьте ссылку">
                </div>
                <div class="input-group">
                    <button id="send-link" class="btn btn-info">Отправить</button>
                </div>
            </form>
            <div id="update_content" style="display: none;">
                <div class="row">
                    <div class="col-12">
                        <p class="h-4">
                            Ваша ссылка
                        </p>
                        <p id="update_text">
                            Сгенерируйте ссылку
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
