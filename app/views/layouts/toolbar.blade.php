@section('toolbar')
@if(Auth::user()->email && Auth::user()->mdpemail)
<?php   
$mail = true;
$boiteMail = 'outlook.office365.com';
$port = 993;
$login = Auth::user()->email;
$motDePasse = Auth::user()->mdpemail;
$imap = imap_open("{".$boiteMail.":".$port."/imap/ssl/novalidate-cert/norsh}", $login, $motDePasse); 
$info = imap_mailboxmsginfo($imap); ?>
@else
<?php $mail = false; ?>
@endif

<div class="col-sm-6 hidden-xs">
	<div class="page-header">
		<h1>Stride <small>{{ trans('menu.titre') }} </small></h1>
	</div>
</div>
<div class="col-sm-6 col-xs-12">
	<div class="toolbar-tools pull-right">
		<ul class="nav navbar-right">
			<li class="dropdown">
				<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
					<i class="fa fa-flag text-success"></i> {{ trans('menu.toolbar-titre-1') }}
				</a>
				<ul class="dropdown-menu dropdown-light dropdown-subview">
					<li class="dropdown-header">
						{{ trans('menu.dropdown-header-1') }}
					</li>
					<li>
						<a href="http://localhost/stride/public/language/fr">{{ trans('menu.lang-1') }}</a>
					</li>
					<li>
						<a href="http://localhost/stride/public/language/en">{{ trans('menu.lang-2') }}</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
					<i class="fa fa-tasks text-success"></i> {{ trans('menu.toolbar-titre-2') }}
				</a>
				<ul class="dropdown-menu dropdown-light dropdown-subview">
					<li class="dropdown-header">
						{{ trans('menu.dropdown-header-3') }}
					</li>
					<li>
						<a href="{{ URL::route('evenements.create') }}" class="new-event"><span class="fa-stack"> <i class="fa fa-calendar-o fa-stack-1x fa-lg"></i> <i class="fa fa-plus fa-stack-1x stack-right-bottom text-success"></i> </span> {{ trans('menu.span-3') }}</a>
					</li>
					<li>
						<a href="{{ URL::route('evenements.index') }}" class="show-calendar"><span class="fa-stack"> <i class="fa fa-calendar fa-stack-1x fa-lg"></i> <i class="fa fa-external-link-square fa-stack-1x stack-right-bottom text-success"></i> </span> {{ trans('menu.span-4') }}</a>
					</li>
					@if(Auth::user()->userStatut == 'admin' || Auth::user()->userStatut == 'manager')
					<li class="dropdown-header">
						{{ trans('menu.dropdown-header-4') }}
					</li>
					<li>
						<a href="{{ URL::route('Users.create') }}" class="new-contributor"><span class="fa-stack"> <i class="fa fa-user fa-stack-1x fa-lg"></i> <i class="fa fa-plus fa-stack-1x stack-right-bottom text-success"></i> </span> {{ trans('menu.span-5') }}</a>
					</li>
					<li>
						<a href="{{ URL::route('Users.index') }}" class="show-contributors"><span class="fa-stack"> <i class="fa fa-users fa-stack-1x fa-lg"></i> <i class="fa fa-external-link-square fa-stack-1x stack-right-bottom text-success"></i> </span> {{ trans('menu.span-6') }}</a>
					</li>
					@endif
				</ul>
			</li>
			<li class="dropdown">
				<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
					@if($mail)
					@if($info->Unread == 0)
					<span class="messages-count badge badge-default hide"></span>
					<i class="fa fa-envelope"></i> {{ trans('menu.toolbar-titre-3') }}
					@else
					<span class="messages-count badge badge-default"><?php echo $info->Unread; ?></span>
					<i class="fa fa-envelope"></i> {{ trans('menu.toolbar-titre-3') }}
					@endif
					@else
					<i class="fa fa-envelope"></i> {{ trans('menu.toolbar-titre-3') }}
					@endif
				</a>
				@if($mail)
				<ul class="dropdown-menu dropdown-light dropdown-messages">
					<li>
						<span class="dropdown-header"> Vous avez <?php echo $info->Unread; ?> message(s) non lu(s)</span>
					</li>
					<li>
						<div class="drop-down-wrapper ps-container">
							<ul>
								<?php 
								$mails = imap_fetch_overview($imap, '1:'.$info->Nmsgs, 0); ?>
								@for($i = $info->Nmsgs-1; $i > $info->Nmsgs-4; $i--)
								<?php // echo "#{$mails[$i]->msgno} ({$mails[$i]->date}) - From: {$mails[$i]->from} {$mails[$i]->subject}\n"; ?>
								@if( $mails[$i]->seen )
								<li class="read">
									<a href="javascript:;" class="read">
										<div class="clearfix">
											<div class="thread-image">

											</div>
											<div class="thread-content">
												<span class="author">{{ $mails[$i]->from }}</span>
												@if(isset($mails[$i]->subject))
												<span class="preview">{{ $mails[$i]->subject }}</span>
												@endif
												<span class="time">{{ $mails[$i]->date }}</span>
											</div>
										</div>
									</a>
								</li>
								@else
								<li class="unread">
									<a href="javascript:;" class="unread">
										<div class="clearfix">
											<div class="thread-image">

											</div>
											<div class="thread-content">
												<span class="author">{{ $mails[$i]->from }}</span>
												@if(isset($mails[$i]->subject))
												<span class="preview">{{ $mails[$i]->subject }}</span>
												@endif
												<span class="time">{{ $mails[$i]->date }}</span>
											</div>
										</div>
									</a>
								</li>
								@endif
								@endfor
							</ul>
						</div>
						<?php imap_close($imap); ?>
					</li>
				</ul>
				@endif
			</li>
		</ul>
	</div>
</div>
@stop