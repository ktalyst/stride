<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>AdminLTE | Remind</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/font-awesome.min.css') }}
        {{ HTML::style('css/AdminLTE.css') }}
    </head>
    <body class="bg-black">
        <div class="form-box" id="login-box">
            <div class="header">New password</div>
			<div class="col-md-12">
				Pour entrer un nouveau mot de passe veuillez remplir ce formulaire :
			</div>
	    	{{ Form::open(array('url' => 'remind/reset/'.$token, 'method' => 'POST')) }}
			{{ Form::hidden('token', $token)}}
			<div class="body bg-gray">
				<div class="form-group">
					{{ Form::text('email', '', $attributes = array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::password('password', $attributes = array('class' => 'form-control')) }}
				</div>
				<div class="form-group">
					{{ Form::password('password_confirmation', $attributes = array('class' => 'form-control')) }}
				</div>
			</div>
      		<div class="footer">
              {{ Form::submit('Envoyer', array('class' => 'btn btn-success')) }}
          	</div>
			{{ Form::close()}}
		</div>
	</div>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        {{ HTML::script('js/bootstrap.min.js') }}

    </body>
</html>