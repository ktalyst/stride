<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Stride | Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, minimum-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800' rel='stylesheet' type='text/css'>
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('css/font-awesome.min.css'); }}
    {{ HTML::style('css/iCheck/all.css'); }}
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/tabletools/2.2.2/css/dataTables.tableTools.css">
    {{ HTML::style('css/styles.css'); }}
    {{ HTML::style('css/styles-responsive.css'); }}
    {{ HTML::style('css/plugins.css'); }}
    {{ HTML::style('css/theme-default.css'); }}
    {{ HTML::style('js/plugins/datetimepicker/jquery.datetimepicker.css'); }}
    {{ HTML::style('js/plugins/fullcalendar/fullcalendar.css'); }}
    {{ HTML::style('js/plugins/magicsuggest/magicsuggest-min.css'); }}
    <link rel="shortcut icon" href="img/favicon.png">
</head>
<body class="sidebar-close horizontal-menu-fixed">
    <div class="main-wrapper">
        <header class="topbar navbar navbar-inverse navbar-fixed-top inner">
            @yield('top_bar')
        </header>

        <nav id="pageslide-left" class="pageslide inner hidden-lg hidden-md">
            <div class="navbar-content">
                <div class="main-navigation left-wrapper transition-left">
                    <div class="navigation-toggler hidden-sm hidden-xs">
                        <a href="#main-navbar" class="sb-toggle-left">
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div id="horizontal-menu" class="navbar navbar-inverse hidden-xs hidden-sm inner">
            @yield('menu_horizontal')
        </div>
        <div class="main-container inner">
            <div class="main-content">
                <div class="container">
                    <div class="toolbar row">
                        @yield('toolbar')
                    </div>
                    <div>
                        @yield('main')
                    </div>
                </div>
            </div>
            <footer class="inner">
                <div class="footer-inner">
                    <div class="pull-left">
                        2014 &copy; Steria.
                    </div>
                    <div class="pull-right">
                        <span class="go-top"><i class="fa fa-chevron-up"></i></span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    {{ HTML::script('js/jquery-2.1.1.min.js'); }}
    {{ HTML::script('js/jquery-ui-1.10.3.min.js'); }}
    <script src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    {{ HTML::script('js/bootstrap.min.js'); }}
    {{ HTML::script('js/plugins/iCheck/icheck.min.js'); }}  
    {{ HTML::script('js/main.js'); }}
    {{ HTML::script('js/jquery.velocity.min.js'); }}
    {{ HTML::script('js/perfect-scrollbar.js'); }}
    {{ HTML::script('js/jquery.scrollTo.min.js'); }}
    {{ HTML::script('js/plugins/datetimepicker//jquery.datetimepicker.js'); }}
    {{ HTML::script('js/plugins/datepicker/js/bootstrap-datepicker.js'); }}
    {{ HTML::script('js/plugins/fullcalendar/moment.min.js'); }}
    {{ HTML::script('js/plugins/fullcalendar/fullcalendar.js'); }}
    {{ HTML::script('js/plugins/fullcalendar/fr.js'); }}
    {{ HTML::script('js/plugins/magicsuggest/magicsuggest-min.js'); }}
    {{ HTML::script('js/plugins/SmartWizard/js/jquery.smartWizard-2.0.js'); }}
    @yield('script')
    <script>
    jQuery('#datetimepicker').datetimepicker();
    jQuery('#datetimepickerfin').datetimepicker();
    jQuery(document).ready(function() {
        Main.init();
        $('#wizard').smartWizard({
            selected: 0,  // Selected Step, 0 = first step   
            keyNavigation: true, // Enable/Disable key navigation(left and right keys are used if enabled)
            enableAllSteps: true,  // Enable/Disable all steps on first load
            transitionEffect: 'fade', // Effect on navigation, none/fade/slide/slideleft
            contentURL:null, // specifying content url enables ajax content loading
            contentCache:true, // cache step contents, if false content is fetched always from ajax url
            cycleSteps: false, // cycle step navigation
            enableFinishButton: false,
            errorSteps:[],   
            labelNext:'Next', 
            labelPrevious:'Previous',
            labelFinish:'Finish',          
            onLeaveStep: null, 
            onShowStep: null,  
            onFinish: null 
        });
        $(document).ready(function(){
            $('#table').dataTable({
                @if(App::getLocale() == "fr")
                "language": {
                    "url": 'js/plugins/datatables/fr_Fr.json'
                }
                @endif
            });
        });
    });
    </script>
</body>
</html>

