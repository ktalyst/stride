@section('menu_horizontal')
<div class="container">
	<div class="navbar-collapse">
		<ul class="nav navbar-nav">
			@if (isset($actif))
			@if ($actif == 0)
			<li class="active">
				@else
				<li>
					@endif
					@else
					<li class="active">
						@endif
						<a href="{{ URL::route('accueil') }}">
							<span class="title">{{ trans('menu.accueil') }}</span>
						</a>
					</li>
					@if(Auth::user()->userStatut == 'admin' || Auth::user()->userStatut == 'manager')
					@if (isset($actif) && $actif == 1)
					<li class="dropdown mega-menu active">
					@else
					<li class="dropdown mega-menu">
							@endif
							<a class="dropdown-toggle actif" href="#" data-toggle="dropdown" data-hover="dropdown">
								{{ trans('menu.menu-titre-1') }} <i class="icon-arrow"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<div class="mega-menu-content">
										<div class="row">
											<div class="col-md-3">
												<ul class="mega-sub-menu">
													<li>
														<span class="mega-menu-sub-title">Clients</span>
														<ul class="mega-sub-menu">
															<li>
																<a href="{{ URL::route('clients.index') }}">
																	<span class="title">Portefeuille de clients</span>
																</a>
															</li>
															<li>
																<a href="{{ URL::route('contacts.index') }}">
																	<span class="title">Liste des contacts</span>
																</a>
															</li>
															<li>
																<a href="{{ URL::route('applications.create') }}">
																	<span class="title">Ajouter une application</span>
																</a>
															</li>
														</ul>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="mega-sub-menu">
													<li>
														<span class="mega-menu-sub-title">Contrats</span>
														<ul class="mega-sub-menu">
															<li>
																<a href="{{ URL::route('contrats.index') }}">
																	<span class="title">Contrats</span>
																</a>
															</li>
															<li>
																<a href="{{ URL::route('catalogues.index') }}">
																	<span class="title">Catalogues</span>
																</a>
															</li>
															<li>
																<a href="{{ URL::route('contrats.create') }}">
																	<span class="title">Ajout d'un contrat</span>
																</a>
															</li>
														</ul>
													</li>
												</ul>
											</div>
											<div class="col-md-3">
												<ul class="mega-sub-menu">
													<li>
														<span class="mega-menu-sub-title">Service Request</span>
														<ul class="mega-sub-menu">
															<li>
																<a href="{{ URL::route('demandeclients.index') }}">
																	<span class="title">Portefeuille de projet</span>
																</a>
															</li>
															<li>
																<a href="{{ URL::route('demandeclients.create') }}">
																	<span class="title">Demande de service</span>
																</a>
															</li>
														</ul>
													</li>
												</ul>
											</div>
										</div>
									</div>
									<!-- end: MEGA MENU CONTENT -->
								</li>
							</ul>
						</li>
						@endif
						@if(Auth::user()->userStatut == 'admin' || Auth::user()->userStatut == 'manager')
						@if (isset($actif) && $actif == 2)
						<li class="dropdown mega-menu active">
							@else
							<li class="dropdown mega-menu">
								@endif
								<a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
									{{ trans('menu.menu-titre-2') }} <i class="icon-arrow"></i>
								</a>
								<ul class="dropdown-menu">
									<li>
										<!-- start: MEGA MENU CONTENT -->
										<div class="mega-menu-content">
											<div class="row">
												<div class="col-md-3">
													<ul class="mega-sub-menu">
														<li>
															<span class="mega-menu-sub-title">Planning</span>
															<ul class="mega-sub-menu">
																<li>
																	<a href="{{ URL::route('tachesteps.index') }}">
																		<span class="title">Suivi des taches</span>
																	</a>
																</li>
																<li>
																	<a href="#">
																		<span class="title">Agenda</span>
																	</a>
																</li>
															</ul>
														</li>
													</ul>
												</div>
												<div class="col-md-3">
													<ul class="mega-sub-menu">
														<li>
															<span class="mega-menu-sub-title">Rapports</span>
															<ul class="mega-sub-menu">
															</ul>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<!-- end: MEGA MENU CONTENT -->
									</li>
								</ul>
							</li>
							@endif
							@if (isset($actif) && $actif == 3)
							<li class="dropdown mega-menu active">
								@else
								<li class="dropdown mega-menu">
									@endif
									<a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
										{{ trans('menu.menu-titre-3') }} <i class="icon-arrow"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<!-- start: MEGA MENU CONTENT -->
											<div class="mega-menu-content">
												<div class="row">
													<div class="col-md-3">
														<ul class="mega-sub-menu">
															<li>
																<span class="mega-menu-sub-title">Timesheet</span>
																<ul class="mega-sub-menu">
																	<li>
																		<a href="{{ URL::route('effectuetaches.create') }}">
																			<span class="title">Saisi du step</span>
																		</a>
																	</li>
																</ul>
															</li>
														</ul>
													</div>
													<div class="col-md-3">
														<ul class="mega-sub-menu">
															<li>
																<span class="mega-menu-sub-title">Cras</span>
																<ul class="mega-sub-menu">
																	<li>
																		<a href="{{ URL::route('cra') }}">
																			<span class="title">Saisi des cras</span>
																		</a>
																	</li>											
																</ul>
															</li>
														</ul>
													</div>
													<div class="col-md-3">
														<ul class="mega-sub-menu">
															<li>
																<span class="mega-menu-sub-title">Taches</span>
																<ul class="mega-sub-menu">
																	<li>
																		<a href="{{ URL::route('tachesteps.index', array('tache' => 2)) }}">
																			<span class="title">Mes taches</span>
																		</a>
																	</li>											
																</ul>
															</li>
														</ul>
													</div>
													<div class="col-md-3">
														<ul class="mega-sub-menu">
															<li>
																<span class="mega-menu-sub-title">Conges</span>
																<ul class="mega-sub-menu">
																	<li>
																		<a href="{{ URL::route('conges.create') }}">
																			<span class="title">Demande de conges</span>
																		</a>
																	</li>	
																	<li>
																		<a href="{{ URL::route('conges.index') }}">
																			<span class="title">Liste de mes conges</span>
																		</a>
																	</li>										
																</ul>
															</li>
														</ul>
													</div>
												</div>
											</div>
											<!-- end: MEGA MENU CONTENT -->
										</li>
									</ul>
								</li>
								@if(Auth::user()->userStatut == 'admin' || Auth::user()->userStatut == 'manager' || Auth::user()->userStatut == 'responsable')
								@if (isset($actif) && $actif == 4)
								<li class="dropdown mega-menu active">
									@else
									<li class="dropdown mega-menu">
										@endif
										<a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
											{{ trans('menu.menu-titre-4') }} <i class="icon-arrow"></i>
										</a>
										<ul class="dropdown-menu">
											<li>
												<!-- start: MEGA MENU CONTENT -->
												<div class="mega-menu-content">
													<div class="row">
														<div class="col-md-3">
															<ul class="mega-sub-menu">
																<li>
																	<span class="mega-menu-sub-title">Gestion des ressources</span>
																	<ul class="mega-sub-menu">
																		<li>
																			<a href="{{ URL::route('demandeclients.index') }}">
																				<span class="title">Affectation</span>
																			</a>
																		</li>
																		<li>
																			<a href="{{ URL::route('domaines.edit') }}">
																				<span class="title">Assignation</span>
																			</a>
																		</li>
																	</ul>
																</li>
															</ul>
														</div>
														<div class="col-md-3">
															<ul class="mega-sub-menu">
																<li>
																	<span class="mega-menu-sub-title">Imputations</span>
																	<ul class="mega-sub-menu">
																		<li>
																			<a href="#">
																				<span class="title">Valider les imputations</span>
																			</a>
																		</li>	
																		<li>
																			<a href="{{ URL::route('validerconges') }}">
																				<span class="title">Valider les congés</span>
																			</a>
																		</li>											
																	</ul>
																</li>
															</ul>
														</div>

													</div>
												</div>
												<!-- end: MEGA MENU CONTENT -->
											</li>
										</ul>
									</li>
									@endif
									@if(Auth::user()->userStatut == 'admin' || Auth::user()->userStatut == 'manager')
									@if (isset($actif) && $actif == 5)
									<li class="dropdown mega-menu active">
										@else
										<li class="dropdown mega-menu">
											@endif
											<a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
												{{ trans('menu.menu-titre-5') }} <i class="icon-arrow"></i>
											</a>
											<ul class="dropdown-menu">
												<li>
													<!-- start: MEGA MENU CONTENT -->
													<div class="mega-menu-content">
														<div class="row">
															<div class="col-md-3">
																<ul class="mega-sub-menu">
																	<li>
																		<span class="mega-menu-sub-title">Cout des ressources</span>
																		<ul class="mega-sub-menu">
																			<li>
																				<a href="{{ URL::route('periodes.index') }}">
																					<span class="title">Cout des ressources</span>
																				</a>
																			</li>
																		</ul>
																	</li>
																</ul>
															</div>
															<div class="col-md-3">
																<ul class="mega-sub-menu">
																	<li>
																		<span class="mega-menu-sub-title">Commandes</span>
																		<ul class="mega-sub-menu">
																			<li>
																				<a href="{{ URL::route('commandes.index') }}">
																					<span class="title">Suivi des commandes</span>
																				</a>
																			</li>												
																		</ul>
																	</li>
																</ul>
															</div>

														</div>
													</div>
													<!-- end: MEGA MENU CONTENT -->
												</li>
											</ul>
										</li>
										@endif
										@if(Auth::user()->userStatut == 'admin')
										@if (isset($actif) && $actif == 6)
										<li class="dropdown mega-menu active">
											@else
											<li class="dropdown mega-menu">
												@endif
												<a class="dropdown-toggle" href="#" data-toggle="dropdown" data-hover="dropdown">
													{{ trans('menu.menu-titre-6') }} <i class="icon-arrow"></i>
												</a>
												<ul class="dropdown-menu">
													<li>
														<!-- start: MEGA MENU CONTENT -->
														<div class="mega-menu-content">
															<div class="row">
																<div class="col-md-3">
																	<ul class="mega-sub-menu">
																		<li>
																			<span class="mega-menu-sub-title">Gestion des catalogues</span>
																			<ul class="mega-sub-menu">
																				<li>
																					<a href="{{ URL::route('catalogues.create') }}">
																						<span class="title">Créer un catalogue</span>
																					</a>
																				</li>
																				<li>
																					<a href="{{ URL::route('tacheservices.create') }}">
																						<span class="title">Ajouter des tâches de niveau service</span>
																					</a>
																				</li>
																			</ul>
																		</li>
																	</ul>
																</div>
																<div class="col-md-3">
																	<ul class="mega-sub-menu">
																		<li>
																			<span class="mega-menu-sub-title">Gestion des utilisateurs</span>
																			<ul class="mega-sub-menu">
																				<li>
																					<a href="{{ URL::route('Users.index') }}">
																						<span class="title">Changement des rôles</span>
																					</a>
																				</li>	
																				<li>
																					<a href="{{ URL::route('Users.create') }}">
																						<span class="title">Ajouter un utilisateur</span>
																					</a>
																				</li>											
																			</ul>
																		</li>
																	</ul>
																</div>
																<div class="col-md-3">
																	<ul class="mega-sub-menu">
																		<li>
																			<span class="mega-menu-sub-title">Administration de l'application</span>
																			<ul class="mega-sub-menu">
																				<li>
																					<a href="{{ URL::route('tacheexternes.create') }}">
																						<span class="title">Taches externes</span>
																					</a>
																				</li>	
																				<li>
																					<a href="{{ URL::route('crjs') }}">
																						<span class="title">CRJS</span>
																					</a>
																				</li>											
																			</ul>
																		</li>
																	</ul>
																</div>

															</div>
														</div>
														<!-- end: MEGA MENU CONTENT -->
													</li>
												</ul>
											</li>
											@endif
										</ul>
									</div>
									<!--/.nav-collapse -->
								</div>

								@stop
