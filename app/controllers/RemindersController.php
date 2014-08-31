<?php

class RemindersController extends Controller {

	/**
	 * Affiche le formulaire d'oubli
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('auth.remind', array('actif' => -1));
	}

	/**
	 * Traitement du formulaire d'oubli
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$response = Password::remind(Input::only('email'), function($message)
		{
		  $message->subject('Oubli du mot de passe.');
		});
		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response))->withInput();

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response))->withInput();
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('auth.reset', array('categories' => Categorie::all(), 'actif' => -1, 'token' => $token));
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response))->withInput();

			case Password::PASSWORD_RESET:
				return Redirect::to('auth/login');
		}
	}

}
