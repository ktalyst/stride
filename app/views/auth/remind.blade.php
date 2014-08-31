<!DOCTYPE html>
<html lang="fr">
    <meta charset="UTF-8">
    <title>Stride | Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, minimum-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,500,600,700,200,100,800' rel='stylesheet' type='text/css'>
    {{ HTML::style('css/bootstrap.min.css'); }}
    {{ HTML::style('css/font-awesome.min.css'); }}
    {{ HTML::style('css/iCheck/all.css'); }}
    {{ HTML::style('css/styles.css'); }}
    {{ HTML::style('css/styles-responsive.css'); }}
    {{ HTML::style('css/plugins.css'); }}
    {{ HTML::style('css/theme-default.css'); }}
    <link rel="shortcut icon" href="img/favicon.png">
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="login">
        <div class="row">
            <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                <div class="logo">
                    <img src="../img/stride.png" style="width:100px">
                </div>
<div class="box-forgot">
                    <h3>Mot de passe oublié ?</h3>
                    <p>
                        Entrer votre adresse email pour réinitialiser votre mot de passe.
                    </p>
                    <form class="form-forgot">
                        <div class="errorHandler alert alert-danger no-display">
                            <i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
                        </div>
                        <fieldset>
                            <div class="form-group">
                                <span class="input-icon">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                    <i class="fa fa-envelope"></i> </span>
                            </div>
                            <div class="form-actions">
                                <a href="{{ URL::previous() }}" class="btn btn-light-grey go-back">
                                    <i class="fa fa-chevron-circle-left"></i> Se connecter
                                </a>
                                <button type="submit" class="btn btn-green pull-right">
                                    Envoyer <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </fieldset>
                    </form>
                    <!-- start: COPYRIGHT -->
                    <div class="copyright">
                        2014 &copy; Steria
                    </div>
                    <!-- end: COPYRIGHT -->
                </div>
            </div>
        </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    {{ HTML::script('js/jquery-2.1.1.min.js'); }}
    {{ HTML::script('js/jquery-ui-1.10.3.min.js'); }}
    {{ HTML::script('js/bootstrap.min.js'); }}
    {{ HTML::script('js/plugins/iCheck/icheck.min.js'); }}  
    {{ HTML::script('js/main.js'); }}
    {{ HTML::script('js/jquery.velocity.min.js'); }}
    {{ HTML::script('js/perfect-scrollbar.js'); }}
    {{ HTML::script('js/jquery.scrollTo.min.js'); }}
    <script>
    jQuery(document).ready(function() {
        Main.init();
    });
    </script>
    </body>
    <!-- end: BODY -->
</html>