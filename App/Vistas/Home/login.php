<?php

use App\App;

?>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <?= App::$Config->get_app_nombre(); ?>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <form action="/home/login_validar" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario" name="user" required value="webmaster">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="psw" required value="malevaje">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
