<!DOCTYPE HTML>
<html>
    <head>
        <title>Admin</title>
        <link rel="stylesheet" href="<?php print BASE_PATH; ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php print BASE_PATH; ?>assets/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php print BASE_PATH; ?>assets/css/jquery.dataTables.css">
        <link rel="stylesheet" href="<?php print BASE_PATH; ?>assets/css/admin.css">
    </head>
    <body>
        <div class="container">
		
          <!-- Static navbar -->
          <div class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="<?php print BASE_PATH; ?>">Tools Registry Admin</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="active"><a href="<?php print BASE_PATH; ?>tool">Tools</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Facets <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                            <li><a href="<?php print BASE_PATH; ?>platform">Platform</a></li>
                            <li><a href="<?php print BASE_PATH; ?>keyword">Keyword</a></li>
                            <li><a href="<?php print BASE_PATH; ?>developer">Developer</a></li>
                            <li><a href="<?php print BASE_PATH; ?>tool-type">Tool type</a></li>
                            <li><a href="<?php print BASE_PATH; ?>license">License</a></li>
                            <li><a href="<?php print BASE_PATH; ?>license-type">License type</a></li>
                    </ul>
                </li>
                <li><a href="<?php print BASE_PATH; ?>user">Users</a></li>
                <li><a href="<?php print BASE_PATH; ?>log">Logs</a></li>
                <li><a href="#">API Keys</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php print BASE_PATH; ?>settings"><span class="glyphicon glyphicon-wrench"></span> Settings</a></li>
                <li><a href="<?php print BASE_PATH; ?>stuff">Stuff</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div>

        <!-- flash messages -->		  
        <?php print render_flash_message($flash); ?>
		  		 
            <!-- content -->				 
          <?php print $content; ?>

        </div> <!-- /container -->
        <script src="assets/js/jquery.min.js"></script>     
        <script src="assets/js/bootstrap.min.js"></script>      
        <script src="assets/js/jquery.dataTables.min.js"></script>     
        <script src="assets/js/admin.js"></script>    
    </body>
</html> 