<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $data->site->title ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/Ionicons/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/dist/css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/plugins/iCheck/square/blue.css'); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url(); ?>"><?= $data->site->name; ?></a>
        </div>

        <?= \Config\Services::message()->render(); ?>

        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <?= form_open(); ?>
                <?= form_hidden('_action', 'login'); ?>
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= base_url('assets/npm/admin-lte/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/plugins/iCheck/icheck.min.js'); ?>"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
</body>

</html>
