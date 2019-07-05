<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ware;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test()
    {
        $ware = Ware::find(1);
        $prd_id = 1;
        $notes = $ware->notes;
        $xuat= array();
        $nhap= array();
        $xuat[$prd_id] = 0;
        $nhap[$prd_id] = 0;
        foreach ($notes as $note) {
            foreach ($note->products as $key => $product) {
                if ($product->id == $prd_id && $note->type == 1) {
                    $xuat[$prd_id] += $product->pivot->quantity;
                }
                if ($product->id == $prd_id && $note->type == 2) {
                    $nhap[$prd_id] += $product->pivot->quantity;
                }
            }
        }
    }
}
