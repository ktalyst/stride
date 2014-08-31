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
<body class="login">
    <div class="row">
        <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="logo">
                <img src="../img/stride.png" style="width:100px">
            </div>
            <div class="box-login">
                @if(Session::has('message'))
                {{Session::get('message')}}
                @endif
                <h3>Connectez-vous à votre compte</h3>
                <p>
                    Entrez votre identifiant et votre mot de passe pour vous loguer.
                </p>
                {{ Form::open(array('url' => 'auth/login', 'method' => 'POST')) }}
                <fieldset>
                    <div class="form-group">
                        <span class="input-icon">
                            <input type="text" class="form-control" name="username" placeholder="Identifiant">
                            <i class="fa fa-user"></i> 
                        </span>
                    </div>
                    <div class="form-group form-actions">
                        <span class="input-icon">
                            <input type="password" class="form-control password" name="password" placeholder="Mot de passe">
                            <i class="fa fa-lock"></i>
                            {{ link_to('remind/remind', "J'ai oublié mon mot de passe", array('class' => 'forgot')) }} 
                        </span>
                    </div>
                    <div class="form-actions">
                        <label for="remember" class="checkbox-inline">
                            <input type="checkbox" class="grey remember" id="remember" name="remember">
                            Se rappeler de moi
                        </label>
                        <button type="submit" class="btn btn-green pull-right">
                            Se connecter <i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                    <div class="new-account">
                        Vous n'avez pas encore de compte ?
                        {{ link_to('auth/inscription', 'Créer un compte') }}

                    </div>
                </fieldset>
                <div class="copyright">
                    2014 &copy; Steria
                </div>
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
</html>