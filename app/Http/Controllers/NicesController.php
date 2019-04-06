<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NicesController extends Controller
{
     public function store(Request $request, $id)
    {
        \Auth::user()->nice($id);
       return redirect()->back();
    }

    public function destroy($id)
    {
        \Auth::user()->bad($id);
        return redirect()->back();
    }
}
