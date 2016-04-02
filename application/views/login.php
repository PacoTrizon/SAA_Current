<html>
    <head>
        <title>SAA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url('css/bootstrap.min.css')?>" rel="stylesheet" >
        <link href="<?php echo base_url('css/jquery.growl.css')?>" rel="stylesheet" >
        <script type="text/javascript" src="<?php echo base_url('js/jquery-2.2.0.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.min.js')?>"></script>
        <!--<script type="text/javascript" src="<?php echo base_url('js/angular.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/angular-route.js')?>"></script>-->
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.min.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/jquery.growl.js')?>"></script>

    </head>

    <body>
      <?php if($this->session->flashdata('_flash_message_error')) : ?>
          <div class="alert alert-danger" style="text-align:right;margin:20px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong><center><?php echo $this->session->flashdata('_flash_message_error'); ?></center></strong>
          </div>
      <?php endif; ?>

        <div class="container">
            <div class="col-md-4 col-md-push-4">
                <div>
                    <img src="<?php echo base_url('img/sistema-de-admin-de-archivos.png')?>" class="img-responsive">
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-lg-2 col-lg-offset-5">
                <form class="form-horizontal" action="<?php echo base_url('home/login') ?>" method="post">
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-8 col-sm-10">
                            <button type="submit" class="btn btn-success">Aceptar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
