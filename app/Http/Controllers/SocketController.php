<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LRedis;


class SocketController extends Controller {

/*
	public function __construct()
	{
		$this->middleware('guest');
	}
*/

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('socket');
	}


	public function writemessage()
	{
		return view('writemessage');
	}

	public function sendMessage()
	{
		$redis = \LRedis::connection();
		$redis->publish('1', json_encode([
			'action' => \Request::input('action'),
			'data' => \Request::input('message')
		]));
		return redirect('writemessage');
	}

}
