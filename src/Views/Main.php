<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $data->site->title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/Ionicons/css/ionicons.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/plugins/iCheck/all.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/bower_components/select2/dist/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/dist/css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/npm/admin-lte/dist/css/skins/_all-skins.min.css'); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        div.dataTables_wrapper div.dataTables_processing {
            top: 10%;
            background-color: #337ab7;
            color: white;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?= base_url(); ?>" class="logo">
                <span class="logo-mini">
                    <?= $data->site->logo['mini']; ?>
                </span>
                <span class="logo-lg">
                    <?= $data->site->logo['large']; ?>
                </span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle visible-xs" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url('assets/npm/admin-lte/dist/img/user2-160x160.jpg'); ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs">
                                    <?= $data->user->name; ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?= base_url('assets/npm/admin-lte/dist/img/user2-160x160.jpg'); ?>" class="img-circle" alt="User Image">

                                    <p>
                                        <?= $data->user->name; ?>
                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= base_url('dashboard/my-profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= base_url('dashboard/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
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
                    <?php foreach ($data->template->menu->items as $item) : ?>
                        <?= \CI4Xpander_AdminLTE\View\Component\Menu\Item::create($item)->render(); ?>
                    <?php endforeach; ?>
                </ul>
            </section>
        </aside>

        <div class="content-wrapper">
            <?php if (!empty($data->page->title) || !empty($data->page->description)) : ?>
                <section class="content-header">
                    <h1><?= $data->page->title ?? ''; ?><?= !empty($data->page->description) ? "<small>{$data->page->description}</small>" : ''; ?></h1>
                </section>
            <?php endif; ?>

            <section class="content">
                <?= $data->template->content ?? ''; ?>
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.18
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
            reserved.
        </footer>
    </div>

    <div class="modal fade" id="modalDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Delete Data?</h4>
                </div>
                <!-- <div class="modal-body">
                    <p>Delete data?</p>
                </div> -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                    <form action="<?= "{$data->crud->baseUrl}/delete"; ?>" method="post">
                        <input type="hidden" name="_method" value="DELETE" />
                        <input type="hidden" name="_action" value="delete" />
                        <input type="hidden" name="id" value="0">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/npm/admin-lte/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/jquery-ui/jquery-ui.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/moment/min/moment.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/select2/dist/js/select2.full.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/plugins/timepicker/bootstrap-timepicker.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/plugins/iCheck/icheck.min.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/bower_components/fastclick/lib/fastclick.js'); ?>"></script>
    <script src="<?= base_url('assets/npm/admin-lte/dist/js/adminlte.min.js'); ?>"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $.widget.bridge('uibutton', $.ui.button);

            $(".sidebar-menu").tree();

            $(".slider").slider({
                tooltip: 'always'
            });

            <?= \Config\Services::viewScript()->render(); ?>
        });
    </script>
</body>

</html>
