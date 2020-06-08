<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $data->site->title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="assets/vendor/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/vendor/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="index2.html" class="logo">
                <span class="logo-mini">
                    <?= $data->site->logo['mini']; ?>
                </span>
                <span class="logo-lg">
                    <?= $data->site->logo['large']; ?>
                </span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="assets/vendor/adminlte/img/user2-160x160.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs">
                                    <?= $data->user->name ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="assets/vendor/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $data->user->name ?>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= base_url('dashboard/my-profile') ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= base_url('dashboard/logout') ?>" class="btn btn-default btn-flat">Log Out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                <?php foreach ($data->template->menu->items as $item): ?>
                <?= \CI4Xpander_AdminLTE\View\Component\Menu\Item::create($item)->render(); ?>
                <?php endforeach; ?>
                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            <?php if (!empty($data->page->title) || !empty($data->page->description)) : ?>
            <section class="content-header">
                <h1>
                    <?= $data->page->title ?? '' ?>
                    <?= !empty($data->page->description) ? "<small>{$data->page->description}</small>" : '' ?>
                </h1>
            </section>
            <?php endif; ?>

            <section class="content">
                <?= $data->template->content ?? '' ?>
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
    </div>

    <script src="assets/vendor/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="assets/vendor/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="assets/vendor/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/vendor/adminlte/bower_components/raphael/raphael.min.js"></script>
    <script src="assets/vendor/adminlte/bower_components/morris.js/morris.min.js"></script>
    <script src="assets/vendor/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="assets/vendor/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/vendor/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendor/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="assets/vendor/adminlte/bower_components/moment/min/moment.min.js"></script>
    <script src="assets/vendor/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendor/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/vendor/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="assets/vendor/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/vendor/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="assets/vendor/adminlte/js/adminlte.min.js"></script>
    <script src="assets/vendor/adminlte/js/pages/dashboard.js"></script>
    <script src="assets/vendor/adminlte/js/demo.js"></script>
</body>

</html>
