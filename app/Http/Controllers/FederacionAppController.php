<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\FederacionApp;

class FederacionAppController extends BaseController
{
    public function getFederacionAppAll(Request $request)
    {
        $federaciones = FederacionApp::get();

        return($federaciones);

    }

    public function getFederacionAppLogoByID(Request $request)
    {
        $data = $request->all();

        $federacion = FederacionApp::where('federacion_id', $data['federacion'])->first();

        return($federacion);

    }
}
