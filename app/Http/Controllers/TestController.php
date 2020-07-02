<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data;


class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test(Request $request)
    {   
        $data = Data::get();
        return response()->json([
            'ok' => true,
            'data' => $data
        ], 200);
    }
}
