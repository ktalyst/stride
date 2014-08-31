@section('top_bar')
<div class="container">
	<div class="navbar-header">
		<a class="sb-toggle-left hidden-md hidden-lg" href="#main-navbar">
			<i class="fa fa-bars"></i>
		</a>
		<a class="navbar-brand" href="{{ URL::route('accueil') }}">
			{{ HTML::image('img/stride.png', 'Stride', array('style' => 'width:100px')) }}
		</a>
	</div>
	<div class="topbar-tools">
		<ul class="nav navbar-right">
			<li class="dropdown current-user">
				<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
					<span class="username"><i class="fa fa-user" style="margin-right:5px;">  </i> {{ Auth::user()->username }}</span> <i class="fa fa-caret-down "></i>
				</a>
				<ul class="dropdown-menu dropdown-dark">
					<li>
						<a href="{{ URL::route('Users.edit', Auth::user()->id) }}">
							{{ trans('menu.nav-1') }}
						</a>
					</li>
					<li>
						<a href="{{ URL::route('evenements.index') }}">
							{{ trans('menu.nav-2') }}
						</a>
					</li>
					<li>
						@if (Auth::check())
						<a href="http://localhost/stride/public/auth/logout">{{ trans('menu.nav-3') }}</a>
						@endif
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>
@stop