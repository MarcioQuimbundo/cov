
  <?php
  error_reporting(0);
  mysqli_query($con,"SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
  echo "
    <head>

        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
        <title>Centro Ortopédico de Viana</title>
        <meta name='description' content=''>
        <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>

        <!-- Favicons -->

        <link rel='apple-touch-icon-precomposed' sizes='144x144' href='assets/images/icons/apple-touch-icon-144-precomposed.png'>
        <link rel='apple-touch-icon-precomposed' sizes='114x114' href='assets/images/icons/apple-touch-icon-114-precomposed.png'>
        <link rel='apple-touch-icon-precomposed' sizes='72x72' href='assets/images/icons/apple-touch-icon-72-precomposed.png'>
        <link rel='apple-touch-icon-precomposed' href='assets/images/icons/apple-touch-icon-57-precomposed.png'>
        <link rel='shortcut icon' href='assets/images/favicon.png'>

        <!--[if lt IE 9]>
          <script src='assets/js/minified/core/html5shiv.min.js'></script>
          <script src='assets/js/minified/core/respond.min.js'></script>
        <![endif]-->

        <!-- Lyonzone Admin CSS Core -->
        <style type='text/css'>
            #page-content-wrapper{height:90%;}
        </style>

        <link rel='stylesheet' type='text/css' href='assets/css/minified/aui-production.min.css'>

        <!-- Theme UI -->

        <link id='layout-theme' rel='stylesheet' type='text/css' href='assets/themes/minified/fides/color-schemes/dark-blue.min.css'>

        <!-- Lyonzone Admin Responsive -->

        <link rel='stylesheet' type='text/css' href='assets/themes/minified/fides/common.min.css'>
        <!-- <link rel='stylesheet' type='text/css' href='../_assets/themes/fides/common.css'> -->

        <link id='theme-animations' rel='stylesheet' type='text/css' href='assets/themes/minified/fides/animations.min.css'>

        <link rel='stylesheet' type='text/css' href='assets/themes/minified/fides/responsive.min.css'>

        <!-- Lyonzone Admin JS -->
        ";?>

        <script type="text/javascript">
        function voltar () {
            history.back();
        }
    </script>

        <?php

        date_default_timezone_set('Brazil/East');


        echo"
        <script type='text/javascript' src='assets/js/minified/aui-production.min.js'></script>

        <script type='text/javascript' src='assets/js/minified/core/raphael.min.js'></script>
        <script type='text/javascript' src='assets/js/minified/widgets/charts-justgage.min.js'></script>
        <script type='text/javascript' src='models/vendor_funcs.js'></script>
        <script type='text/javascript' src='models/funcs.js'></script>
        <script type='text/javascript' src='models/sweetalert.min.js'></script>
		<script src='models/dropzone.js'></script>
        </script>
	<script src='js-webshim/minified/extras/modernizr-custom.js'></script>
	<script src='js-webshim/minified/polyfiller.js'></script>
	 <script>
    $.webshims.polyfill();
    </script>
    </head>";
	?>
    