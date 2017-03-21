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
            <li class="li1"><a href="<?=site_url('manage/settings');?>">Preview</a></li>
            <li class="li1 active"><a href="<?=site_url('manage/global_config');?>">Global Config</a></li>
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
            <h2 class="sub-header">Global Config</h2>
            <form class="form-horizontal" role="form" method="POST">
              <div class="form-group">
                <label for="inputRealIP" class="col-sm-2 control-label">Real IP</label>
                <div class="col-sm-10">
                  <input type="text" name="real_ip" class="form-control" placeholder="Please input the real ip" value="<?=htmlspecialchars($real_ip)?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputRealPort" class="col-sm-2 control-label">Real Port</label>
                <div class="col-sm-10">
                  <input type="text" name="real_port" class="form-control" placeholder="Please input the real port" value="<?=htmlspecialchars($real_port)?>">
                </div>
              </div>
              <div class="form-group">
                <label for="inputIsOpen" class="col-sm-2 control-label">WAF</label>
                <div>
                  <?php if ($is_open == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="is_open" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="is_open" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="is_open" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="is_open" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputIsDebug" class="col-sm-2 control-label">Debug</label>
                <div>
                  <?php if ($is_debug == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="is_debug" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="is_debug" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="is_debug" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="is_debug" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputWhiteIP" class="col-sm-2 control-label">White IP</label>
                <div>
                  <?php if ($white_ip == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="white_ip" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="white_ip" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="white_ip" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="white_ip" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputBlackIP" class="col-sm-2 control-label">Black IP</label>
                <div>
                  <?php if ($black_ip == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="black_ip" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="black_ip" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="black_ip" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="black_ip" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputSQLI" class="col-sm-2 control-label">SQLI</label>
                <div>
                  <?php if ($sqli == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="sqli" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="sqli" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="sqli" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="sqli" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputFileExtension" class="col-sm-2 control-label">File Extension</label>
                <div>
                  <?php if ($file_extension == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_extension" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_extension" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_extension" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_extension" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputFileContent" class="col-sm-2 control-label">File Content</label>
                <div>
                  <?php if ($file_content == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_content" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_content" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_content" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_content" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputFileLength" class="col-sm-2 control-label">File Length</label>
                <div>
                  <?php if ($file_length == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_length" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_length" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_length" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="file_length" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputCaidao" class="col-sm-2 control-label">Caidao</label>
                <div>
                  <?php if ($caidao == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="caidao" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="caidao" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="caidao" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="caidao" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputURLLength" class="col-sm-2 control-label">URL Length</label>
                <div>
                  <?php if ($url_length == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="url_length" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="url_length" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="url_length" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="url_length" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputBodyLength" class="col-sm-2 control-label">Body Length</label>
                <div>
                  <?php if ($body_length == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="body_length" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="body_length" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="body_length" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="body_length" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputWhiteURI" class="col-sm-2 control-label">WhiteURI</label>
                <div>
                  <?php if ($whiteuri == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="whiteuri" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="whiteuri" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="whiteuri" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="whiteuri" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputURLContent" class="col-sm-2 control-label">URL Content</label>
                <div>
                  <?php if ($url_content == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="url_content" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="url_content" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="url_content" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="url_content" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputBodyContent" class="col-sm-2 control-label">Body Content</label>
                <div>
                  <?php if ($body_content == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="body_content" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="body_content" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="body_content" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="body_content" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputHeaderContent" class="col-sm-2 control-label">Header Content</label>
                <div>
                  <?php if ($header_content == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="header_content" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="header_content" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="header_content" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="header_content" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputLimitper10Seconds" class="col-sm-2 control-label">Limit per 10 Seconds</label>
                <div>
                  <?php if ($limit_per_10_seconds == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="limit_per_10_seconds" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="limit_per_10_seconds" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="limit_per_10_seconds" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="limit_per_10_seconds" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputLimitforBlock" class="col-sm-2 control-label">Limit for Block</label>
                <div>
                  <?php if ($limit_for_block == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="limit_for_block" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="limit_for_block" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="limit_for_block" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="limit_for_block" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputBlockedIP" class="col-sm-2 control-label">Blocked IP</label>
                <div>
                  <?php if ($blocked_ip == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="blocked_ip" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="blocked_ip" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="blocked_ip" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="blocked_ip" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputXSSProtection" class="col-sm-2 control-label">XSS Protection</label>
                <div>
                  <?php if ($xss_protection == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="xss_protection" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="xss_protection" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="xss_protection" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="xss_protection" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputCSRFProtection" class="col-sm-2 control-label">CSRF Protection</label>
                <div>
                  <?php if ($csrf_protection == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="csrf_protection" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="csrf_protection" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="csrf_protection" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="csrf_protection" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <div class="form-group">
                <label for="inputDummyProtection" class="col-sm-2 control-label">Dummy Protection</label>
                <div>
                  <?php if ($dummy_protection == 'open'): ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="dummy_protection" value="1" checked>Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="dummy_protection" value="0">Close
                    </label>
                  <?php else: ?>
                    <label class="checkbox-inline">
                      <input type="radio" name="dummy_protection" value="1">Open
                    </label>
                    <label class="checkbox-inline">
                      <input type="radio" name="dummy_protection" value="0" checked>Close
                    </label>
                  <?php endif; ?>
                </div>
              </div>
              <button type="button" class="btn btn-primary" onclick="submitForm(this)">Save</button>
            </form>
          </div>
          <div class="footer">
            <p class="text-muted fleft"><a href="<?=site_url('manage/settings');?>">&lt;-previous</a></p>
            <p class="text-muted fright"><a href="<?=site_url('manage/ip_rule');?>">next-&gt;</a></p>
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
