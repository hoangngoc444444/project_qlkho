<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class AutoCompleteController extends Controller
{


    public function search(Request $request)
    {
          $search = $request->get('term');

          $result = Product::where('name', 'LIKE', '%'. $search. '%')->get();

          return response()->json($result);

    }
}
