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
            <li class="li1"><a href="<?=site_url('manage/global_config');?>">Global Config</a></li>
            <li class="li1"><a href="<?=site_url('manage/ip_rule');?>">IP Rule</a></li>
            <li class="li1 active"><a href="<?=site_url('manage/block_rule');?>">Block Rule</a></li>
            <li class="li1"><a href="<?=site_url('manage/delay_rule');?>">Delay Rule</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li class="li1"><a href="<?=site_url('manage/user_setting');?>">User Setting</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <div>
            <h2 class="sub-header">Block Rule</h2>
            <h3 class="sub-header">SQLI</h3>
            <form role="form" method="POST">
              <input type="hidden" name="type" value="block_default">
              <div class="form-group">
                <textarea name="sqli" class="form-control" rows="6"><?php foreach ($sqli as $row): ?><?=htmlspecialchars($row).'&#13;&#10;'?><?php endforeach;?></textarea>     
              </div>
              <button type="button" class="btn btn-primary" onclick="submitForm(this)">Save</button>
            </form>
            <h3 class="sub-header">File Upload</h3>
            <form role="form" method="POST">
              <input type="hidden" name="type" value="block_default">
              <div class="form-group">
                <label for="nameFileExtension">File Extension(White List)</label>
                <textarea name="file_extension" class="form-control" rows="6"><?php foreach ($file_extension as $row): ?><?=htmlspecialchars($row).'&#13;&#10;';?><?php endforeach;?></textarea>     
              </div>
              <div class="form-group">
                <label for="nameFileContent">File Content</label>
                <textarea name="file_content" class="form-control" rows="6"><?php foreach ($file_content as $row): ?><?=htmlspecialchars($row).'&#13;&#10;';?><?php endforeach;?></textarea>     
              </div>
              <div class="form-group">
                <label for="nameFileLength">File Length</label>
                <input type="text" name="file_length" class="form-control" value="<?=htmlspecialchars($file_length)?>">
              </div>
              <button type="button" class="btn btn-primary" onclick="submitForm(this)">Save</button>
            </form>
            <h3 class="sub-header">Caidao</h3>
            <form role="form" method="POST">
              <input type="hidden" name="type" value="block_default">
              <div class="form-group">
                <textarea name="caidao" class="form-control" rows="6"><?php foreach ($caidao as $row): ?><?=htmlspecialchars($row).'&#13;&#10;'?><?php endforeach;?></textarea>     
              </div>
              <button type="button" class="btn btn-primary" onclick="submitForm(this)">Save</button>
            </form>
            <h3 class="sub-header">Flow Length</h3>
            <form role="form" method="POST">
              <input type="hidden" name="type" value="block_default">
              <div class="form-group">
                <label for="nameURLLength">URL Length</label>
                <input type="text" name="url_length" class="form-control" value="<?=htmlspecialchars($url_length)?>">
              </div>
              <div class="form-group">
                <label for="nameBodyLength">Body Length</label>
                <input type="text" name="body_length" class="form-control" value="<?=htmlspecialchars($body_length)?>">
              </div>
              <button type="button" class="btn btn-primary" onclick="submitForm(this)">Save</button>
            </form>
            <h3 class="sub-header">WhiteURI</h3>
            <form role="form" method="POST">
              <input type="hidden" name="type" value="block_default">
              <div class="form-group">
                <label for="nameURIList">URI List</label>
                <textarea name="uri_list" class="form-control" rows="6"><?php foreach ($uri_list as $row): ?><?=htmlspecialchars($row).'&#13;&#10;';?><?php endforeach;?></textarea>     
              </div>
              <div class="form-group">
                <label for="nameExceptExtension">Except Extension</label>
                <textarea name="except_extension" class="form-control" rows="6"><?php foreach ($except_extension as $row): ?><?=htmlspecialchars($row).'&#13;&#10;';?><?php endforeach;?></textarea>     
              </div>
              <button type="button" class="btn btn-primary" onclick="submitForm(this)">Save</button>
            </form>
            <h3 class="sub-header">Block DIY</h3>
            <form role="form" method="POST">
              <input type="hidden" name="type" value="block_diy">
              <div class="form-group">
                <label for="nameURLContent">URL Content</label>
                <textarea name="url_content" class="form-control" rows="6"><?php foreach ($url_content as $row): ?><?=htmlspecialchars($row).'&#13;&#10;';?><?php endforeach;?></textarea>     
              </div>
              <div class="form-group">
                <label for="nameBodyContent">Body Content</label>
                <textarea name="body_content" class="form-control" rows="6"><?php foreach ($body_content as $row): ?><?=htmlspecialchars($row).'&#13;&#10;';?><?php endforeach;?></textarea>     
              </div>
              <div class="form-group">
                <label for="nameHeaderContent">Header Content</label>
                <textarea name="header_content" class="form-control" rows="6"><?php foreach ($header_content as $row): ?><?=htmlspecialchars($row).'&#13;&#10;';?><?php endforeach;?></textarea>     
              </div>
              <button type="button" class="btn btn-primary" onclick="submitForm(this)">Save</button>
            </form>
          </div>
          <div class="footer">
            <p class="text-muted fleft"><a href="<?=site_url('manage/ip_rule');?>">&lt;-previous</a></p>
            <p class="text-muted fright"><a href="<?=site_url('manage/delay_rule');?>">next-&gt;</a></p>
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
