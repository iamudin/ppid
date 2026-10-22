<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title><?php echo $judul_lengkap.' '.$instansi; ?></title>
        <meta content="Admin Dashboard Bagian Humas Kabupaten" name="description" />
        <meta content="Bagian Humas Kabupaten Bengkalis" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico">

        <!-- App css -->
        <link href="<?php echo base_url(); ?>admintema/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>admintema/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>admintema/assets/css/style.css" rel="stylesheet" type="text/css" />

    </head>


    <body>

        <!-- Begin page -->
        <div class="accountbg"></div>
        <div class="wrapper-page">

            <div class="card">
                <div class="card-body">

                    <h3 class="text-center mt-0 m-b-15">
                        <a href="<?php echo base_url(); ?>" class="logo logo-admin"><img src="<?php echo base_url(); ?>logo.png" height="120" alt="logo"></a>
                    </h3>

                    <h4 class="text-muted text-center font-18"><b>Sign In</b><br>
                    <?php echo $judul_lengkap.' '.$instansi; ?>
                    </h4>

                    <div class="p-3">
                        <form class="form-horizontal m-t-20" method="post" action="<?php echo base_url(); ?>index.php/webadmin/login">

                            <div class="form-group row">
                                <div class="col-12">
                                    <input name="username" class="form-control" type="text" required="" placeholder="Username">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <input class="form-control" type="password" name="password" required="" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Remember me</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row m-t-20">
                                <div class="col-12">
                                    <button class="btn btn-info btn-block waves-effect waves-light" type="submit">Log In</button>
                                </div>
                            </div>

                            
                        </form>
                    </div>

                </div>
            </div>
        </div>



        <!-- jQuery  -->
        <script src="<?php echo base_url(); ?>admintema/assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js/popper.min.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js/modernizr.min.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js/waves.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo base_url(); ?>admintema/assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="<?php echo base_url(); ?>admintema/assets/js/app.js"></script>

    </body>
</html>