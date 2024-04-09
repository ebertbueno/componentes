<?php
$cor = str_replace('btn-', '', $cor);

echo '<script>this.botaoEnviar{!! StatusDoSistema() === 0 ? 1 : Null !!}.disabled=false</script>';
$timeOut = (!empty($data['timeOut']) ? $data['timeOut'] : 5000);
$progressBar = (!empty($data['progressBar']) ? $data['progressBar'] : true);
$botao = "<script>
            Command: toastr['" . $cor . "']('" . $data['texto'] . "', '" . $data['titulo'] . "');
            toastr.options = {
                'closeButton': false,
                'debug': false,
                'newestOnTop': false,
                'progressBar': " . $progressBar . ",
                'positionClass': 'toast-top-right',
                'preventDuplicates': true,
                'onclick': null,
                'showDuration': '300',
                'hideDuration': '1000',
                'timeOut': " . $timeOut . ",
                'extendedTimeOut': '1000',
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut'
            }</script>
            ";