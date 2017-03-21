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
            <li class="li1 active"><a href="<?=site_url('manage/settings');?>">Preview</a></li>
            <li class="li1"><a href="<?=site_url('manage/global_config');?>">Global Config</a></li>
            <li class="li1"><a href="<?=site_url('manage/ip_rule');?>">IP Rule</a></li>
            <li class="li1"><a href="<?=site_url('manage/block_rule');?>">Block Rule</a></li>
            <li class="li1"><a href="<?=site_url('manage/delay_rule');?>">Delay Rule</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="li1"><a href="<?=site_url('manage/user_setting');?>">User Setting</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div>
            <h1 class="page-header">Settings</h1>
            <!-- Make the WAF update configuration. -->
            <form class="form-horizontal" role="form" id="come_into_effect">
              <p><a class="btn btn-lg btn-success" href="#" role="button">Come into effect</a></p>
            </form>
            <h2 class="sub-header">Preview</h2>
            <div>
              <h3>Real IP</h3>
              <p><?=htmlspecialchars($real_ip)?></p>
              <h3>Real Port</h3>
              <p><?=htmlspecialchars($real_port)?></p>
              <h3>WAF</h3>
              <span class="label <?=$is_open == 'open' ? 'label-success' : 'label-danger';?>"><?=$is_open?></span>
              <h3>Debug</h3>
              <span class="label <?=$is_debug == 'open' ? 'label-success' : 'label-danger';?>"><?=$is_debug?></span>
              <h2 class="sub-header">IP Rule</h2>
              <h3>White IP</h3>
              <span class="label <?=$white_ip == 'open' ? 'label-success' : 'label-danger';?>"><?=$white_ip?></span>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Path</th>
                      <th>IP</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($white_ip_list as $row):?>
                    <tr>
                      <td><?=htmlspecialchars($row['path'])?></td>
                      <td><?=htmlspecialchars($row['ip'])?></td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <h3>Black IP</h3>
              <span class="label <?=$black_ip == 'open' ? 'label-success' : 'label-danger';?>"><?=$black_ip?></span>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Path</th>
                      <th>IP</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($black_ip_list as $row):?>
                    <tr>
                      <td><?=htmlspecialchars($row['path'])?></td>
                      <td><?=htmlspecialchars($row['ip'])?></td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
              <h2 class="sub-header">Block Rule</h2>
              <div>
                <h3>SQLI</h3>
                <span class="label <?=$sqli == 'open' ? 'label-success' : 'label-danger';?>"><?=$sqli?></span>
              </div>
              <div>
                <h3>File Extension</h3>
                <span class="label <?=$file_extension == 'open' ? 'label-success' : 'label-danger';?>"><?=$file_extension?></span>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>File Extension Allow</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($file_extension_allow as $row):?>
                      <tr>
                        <td><?=htmlspecialchars($row)?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
                <h3>File Content</h3>
                <span class="label <?=$file_content == 'open' ? 'label-success' : 'label-danger';?>"><?=$file_content?></span>
                <h3>File Length</h3>
                <span class="label <?=$file_length == 'open' ? 'label-success' : 'label-danger';?>"><?=$file_length?></span>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>File Length Max</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?=htmlspecialchars($file_length_max)?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div>
                <h3>Caidao</h3>
                <span class="label <?=$caidao == 'open' ? 'label-success' : 'label-danger';?>"><?=$caidao?></span>
              </div>
              <div>
                <h3>URL Length</h3>
                <span class="label <?=$url_length == 'open' ? 'label-success' : 'label-danger';?>"><?=$url_length?></span>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>URL Length Max</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?=htmlspecialchars($url_length_max)?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <h3>Body Length</h3>
                <span class="label <?=$body_length == 'open' ? 'label-success' : 'label-danger';?>"><?=$body_length?></span>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Body Length Max</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?=htmlspecialchars($body_length_max)?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div>
                <h3>WhiteURI</h3>
                <span class="label <?=$whiteuri == 'open' ? 'label-success' : 'label-danger';?>"><?=$whiteuri?></span>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>URI List</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($uri_list as $row):?>
                      <tr>
                        <td><?=htmlspecialchars($row)?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Except Extension</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($except_extension as $row):?>
                      <tr>
                        <td><?=htmlspecialchars($row)?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div>
                <h3>URL Content</h3>
                <span class="label <?=$url_content == 'open' ? 'label-success' : 'label-danger';?>"><?=$url_content?></span>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>URL Content Not Allow</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($url_content_not_allow as $row):?>
                      <tr>
                        <td><?=htmlspecialchars($row)?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
                <h3>Body Content</h3>
                <span class="label <?=$body_content == 'open' ? 'label-success' : 'label-danger';?>"><?=$body_content?></span>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Body Content Not Allow</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($body_content_not_allow as $row):?>
                      <tr>
                        <td><?=htmlspecialchars($row)?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
                <h3>Header Content</h3>
                <span class="label <?=$header_content == 'open' ? 'label-success' : 'label-danger';?>"><?=$body_content?></span>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Header Content Not Allow</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($header_content_not_allow as $row):?>
                      <tr>
                        <td><?=htmlspecialchars($row)?></td>
                      </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
              <h2 class="sub-header">Delay Rule</h2>
              <h3>Limit per 10 Seconds</h3>
              <span class="label <?=$limit_per_10_seconds == 'open' ? 'label-success' : 'label-danger';?>"><?=$limit_per_10_seconds?></span>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Limit per 10 Seconds Max</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?=htmlspecialchars($limit_per_10_seconds_max)?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <h3>Limit for Block</h3>
              <span class="label <?=$limit_for_block == 'open' ? 'label-success' : 'label-danger';?>"><?=$limit_for_block?></span>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Limit for Block Max</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?=htmlspecialchars($limit_for_block_max)?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <h3>Blocked IP</h3>
              <span class="label <?=$blocked_ip == 'open' ? 'label-success' : 'label-danger';?>"><?=$blocked_ip?></span>
              <h2 class="sub-header">Front-End Protection</h2>
              <h3>XSS Protection</h3>
              <span class="label <?=$xss_protection == 'open' ? 'label-success' : 'label-danger';?>"><?=$xss_protection?></span>
              <h3>CSRF Protection</h3>
              <span class="label <?=$csrf_protection == 'open' ? 'label-success' : 'label-danger';?>"><?=$csrf_protection?></span>
              <h3>Dummy Protection</h3>
              <span class="label <?=$dummy_protection == 'open' ? 'label-success' : 'label-danger';?>"><?=$dummy_protection?></span>
            </div>
            <div class="footer">
              <p class="text-muted fright"><a href="<?=site_url('manage/global_config');?>">next-></a></p>
            </div>
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
