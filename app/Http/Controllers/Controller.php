<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Determines if the user is authorized to make this request.
     * @param $ability
     * @param $arguments
     * @return bool
     * @author 44422
     */
	public function authorize($ability, $arguments) {
		return true; // TODO
	}
}
