<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=base_url('/favicon.ico')?>">

    <title>FishWAF Manage</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('/assets/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url('/assets/css/manage.css')?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?=base_url('/assets/js/ie-emulation-modes-warning.js')?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">FishWAF</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?=site_url('manage/dashboard');?>">Dashboard</a></li>
            <li><a href="<?=site_url('manage/settings');?>">Settings</a></li>
            <li><a href="#">Help</a></li>
          </ul>
        <!--
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        -->
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="li1"><a href="<?=site_url('manage/dashboard');?>">Overview</a></li>
            <li class="li1 active"><a href="<?=site_url('manage/reports');?>">Reports</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div>
            <h1 class="page-header">Reports</h1>
            <form class="navbar-form" method="POST">
              From : <input type="date" class="form-control" name="start_time">
              To : <input type="date" class="form-control" name="end_time">
              <button type="submit" class="btn btn-default">Search</button>
            </form>
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Time</th>
                    <th>IP</th>
                    <th>Rule</th> 
                    <th>Type</th>
                    <th>Request</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($reports as $row):?>
                  <tr>
                    <td><?=htmlspecialchars(date('Y-m-d h:i:s', $row['time']))?></td>
                    <td><?=htmlspecialchars($row['ip'])?></td>
                    <td><?=htmlspecialchars($row['rule'])?></td>                    
                    <td><?=htmlspecialchars($row['type'])?></td>
                    <td>
                      <form class="form-horizontal" role="form" method="POST">
                        <input type="hidden" name="id" value="<?=htmlspecialchars($row['id'])?>">
                        <input type="hidden" name="act" value="get_request">
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#<?='report-'.htmlspecialchars($row['id'])?>" onclick="getRequest(this)">View</button>
                      </form>
                      <div class="modal fade" id="<?='report-'.htmlspecialchars($row['id'])?>" tabindex="-1" role="dialog" aria-labelledby="<?='report-'.htmlspecialchars($row['id'])?>Label" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title" id="<?='report-'.htmlspecialchars($row['id'])?>Label"><?=htmlspecialchars(date('Y-m-d h:i:s', $row['time']).' '.$row['ip'])?></h4>
                            </div>
                            <div class="modal-body" id="<?='report-'.htmlspecialchars($row['id']).'-content'?>"></div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal -->
                      </div>
                    </td>
                  </tr>
                  <?php endforeach;?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="footer">
            <p class="text-muted fleft"><a href="<?=site_url('manage/dashboard');?>">&lt;-previous</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?=base_url('/assets/js/jquery/1.11.1/jquery.min.js');?>"></script>
    <script src="<?=base_url('/assets/js/jquery/jquery-form.js');?>"></script>
    <script src="<?=base_url('/assets/js/bootstrap.min.js');?>"></script>
    <script src="<?=base_url('/assets/js/docs.min.js');?>"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?=base_url('/assets/js/ie10-viewport-bug-workaround.js');?>"></script>
    <script src="<?=base_url('/assets/js/json2.js');?>"></script>
    <script src="<?=base_url('/assets/js/manage.js');?>"></script>
  </body>
</html>
