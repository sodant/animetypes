<?php
include("../private/config.php");
include("SiteController.php");

$siteController = new \controller\SiteController();
$siteController->init();
?>
<!DOCTYPE html>
<html lang="en" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" ng-app="animeTypes">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="shortcut icon" href="images/favicon.png" type="image/png">

        <title>Anime-types.com</title>

        <link href="css/style.default.css" rel="stylesheet">


        <!-- controllers -->
        <script src="app/controllers/characterctrl.js"></script>

        <!-- Components -->
        <script src="lib/ajax/dataprovider.js"></script>
        <script src="lib/components/itemgrid.js"></script>
        <script src="lib/components/itemdetailmodal.js"></script>
        <script src="lib/components/model/item.js"></script>



        <!-- Global variables -->
        <script type="application/javascript">
            <?php foreach($configVariables as $variableName => $value): ?>
            var <?php echo($variableName);?> = "<?php echo($value);?>";
            <?php endforeach; ?>

            var mbtiTypes = <?php echo json_encode($mbtiTypes); ?>;

        </script>

        <!-- App -->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="lib/html5shiv.js"></script>
        <script src="lib/respond.min.js"></script>


        <![endif]-->
        <style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style><style id="holderjs-style" type="text/css">.holderjs-fluid {font-size:16px;font-weight:bold;text-align:center;font-family:sans-serif;margin:0}</style>
    </head>

    <body style="overflow: visible;">
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=452672408119936";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!-- Preloader -->
    <div id="preloader" style="display: none;">
        <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
    </div>
    <a class="menutoggle">
        <i class="fa fa-bars"></i>
    </a>



    <section>

    <div class="mainpanel">

        <div class="leftpanel">

            <div class="logopanel">
                <a class="menutoggle"><i class="fa fa-bars"></i></a>
            </div><!-- logopanel -->

            <div class="leftpanelinner">

                <!-- This is only visible to small devices -->
                <div class="visible-xs hidden-sm hidden-md hidden-lg">
                    <div class="media userlogged">
                        <img alt="" src="images/photos/loggeduser.png" class="media-object">
                        <div class="media-body">
                            <h4>John Doe</h4>
                            <span>"Life is so..."</span>
                        </div>
                    </div>

                    <h5 class="sidebartitle actitle">Account</h5>
                    <ul class="nav nav-pills nav-stacked nav-bracket mb30">

                        <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                        <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                        <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
                        <li><a href="signout.html"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
                    </ul>
                </div>

                <h5 class="sidebartitle">Navigation</h5>
                <ul class="nav nav-pills nav-stacked nav-bracket">
                    <li> <a><i class="fa fa-bars"></i> </a></li>
                    <?php foreach($siteController->_menuItems as $menuItem): ?>
                        <li><a class="menu-item" href="<?php echo$menuItem['menu_href'];?>"><i class="fa <?php echo $menuItem['menu_icon_class'];?>"></i> <span><?php echo $menuItem['menu_label']; ?></span></a></li>
                    <?php endforeach; ?>

                    <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>Forms</span></a>
                        <ul class="children">
                            <li><a href="#general-forms.html" class="menu-item"><i class="fa fa-caret-right"></i> General Forms</a></li>
                            <li><a href="#form-layouts.html" class="menu-item"><i class="fa fa-caret-right"></i> Form Layouts</a></li>
                            <li><a href="#form-validation.html" class="menu-item"><i class="fa fa-caret-right"></i> Form Validation</a></li>
                            <li><a href="#form-wizards.html" class="menu-item"><i class="fa fa-caret-right"></i> Form Wizards</a></li>
                            <li><a href="#wysiwyg.html" class="menu-item"><i class="fa fa-caret-right"></i> Text Editor</a></li>
                            <li><a href="#code-editor.html" class="menu-item"><i class="fa fa-caret-right"></i> Code Editor</a></li>
                            <li><a href="#x-editable.html" class="menu-item"><i class="fa fa-caret-right"></i> X-Editable</a></li>
                        </ul>

                    </li>

                </ul>


            </div><!-- leftpanelinner -->
        </div><!-- leftpanel -->


    <div class="headerbar" style="background-color:inherit !important;">
	<center><div class="breadcrumb-wrapper">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Display Leaderboard Ad -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-4688082653186078"
     data-ad-slot="5352702341"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
        </div></center>
		



       <div class="header-right">

    </div><!-- header-right -->

    </div><!-- headerbar -->

    <div class="pageheader">
        <h2><i class="fa fa-user"></i> People Directory</h2>

    </div>

    <div class="contentpanel"">


        <ul class="type-filter">
            <li><a href="#all" class="mbti_type active-filter" data-type="all">All</a></li>
            <?php foreach($mbtiTypes as $mbtiType): ?>
                <li><a href="#<?php echo $mbtiType; ?>" class="mbti_type" data-type="<?php echo $mbtiType ?>"><?php echo $mbtiType ?></a></li>

            <?php endforeach; ?>
        </ul>
        <div class="mb15"></div>
        <div class = "grid-toolbar">
            <form class="tool grid-searchform" method="post">
                <input type="text" class="form-control" name="keyword" placeholder="Filter on name" data-filter="name">
                <input type="text" class="form-control" name="keyword" placeholder="Filter on anime" data-filter="anime">
            </form>

        </div>

        <div class="mb15"></div>

        <div class="character-list" id="itemgridwrapper">

        </div><!-- character-list -->

    </div><!-- contentpanel -->

    </div><!-- mainpanel -->

    </div><!-- tab-content -->
    </div><!-- rightpanel -->

    </section>


    <!-- library -->
    <script src="lib/jquery-1.11.1.min.js"></script>
    <script src="lib/jquery-migrate-1.2.1.min.js"></script>
    <script src="lib/bootstrap.min.js"></script>
    <script src="lib/modernizr.min.js"></script>
    <script src="lib/jquery.sparkline.min.js"></script>
    <script src="lib/toggles.min.js"></script>
    <script src="lib/retina.min.js"></script>
    <script src="lib/jquery.cookies.js"></script>
    <script src="lib/app.js"></script>




    <script src="lib/holder.js"></script>

    <script src="lib/custom.js"></script>

    <script>
        $(window).load(function(){



            $( 'a[href="#"]' ).click( function(e) {
                e.preventDefault();
            } );

        });

    </script>


    <footer>

    </footer>



    </body>
</html>