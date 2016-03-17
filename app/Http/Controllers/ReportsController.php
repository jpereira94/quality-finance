<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class ReportsController extends Controller
{
	public function index()
	{
	    return view('reports.index');
	}

	public function rawRequest()
	{
		return view('reports.raw');
	}

	public function rawGet(Request $request)
	{
		$sql = $request->sql_request;
		
		// Holds the forbidden sql commands
		// Should only allow select and views command
		$forbidden_sql = [
			'create',
			'drop',
			'alter',
			'delete',
			'insert',
			'update',
			'truncate',
		];

		if (str_contains(strtolower($sql), $forbidden_sql)) {
			# code...
		}
		$results = \DB::select(
			\DB::raw($request->sql_request)
		);



		dd($results);
	}
}
