<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sampah;

class KalkulatorController extends Controller
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
        $sampah = Sampah::get(['id','nama','harga']);
        return view('kalkulator', compact('sampah'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function calculate(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'jumlah' => 'required|numeric|gt:0',
        ]);

        return redirect()->route('kalkulator')->with('total',$request['jenis'] * $request['jumlah']);
    }
}
