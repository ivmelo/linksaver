<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;

use App\User;

use Auth;

use Illuminate\Support\Facades\Validator;



class UserController extends Controller {

	// Only authenticated users can have access to this methods.
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// As per now, a user can only edit his own account
		// when admin capabilities will be implemented, this will change
		// and the admin user will be able to do anything with user accounts
		$user = User::find(Auth::user()->id);
		return view('users.edit', compact('user'));


	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		$validator = Validator::make(Request::all(),[
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);

		if ($validator->fails()) {
			// email or username missing
			return redirect()->back()->withErrors($validator)->withInput();
		}


		// get the user's id for authentication
		$user = User::find($id);

		// check if the provided password is valid
		if(Auth::validate(['id' => $user->id, 'password' => Request::get('password')])){
			$user->name = Request::get('name');
			$user->email = Request::get('email');
			$user->save();
			// it's all right Johnny, redirect and inform the user
			return redirect('link')->with('flash_message', 'Your account information was updated!');
			echo Request::get('email');
		} else {
			// wrong password, inform the user
			return redirect()->back()
			->with('error_message', 'The password provided doesn\'t match our records!')->withInput();
		}


	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
