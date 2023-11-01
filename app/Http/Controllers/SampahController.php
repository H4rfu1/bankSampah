<?php

namespace App\Http\Controllers;

use App\Models\Sampah;
use Illuminate\Http\Request;

class SampahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sampah = Sampah::latest()->paginate(5);
        return view('sampah.index',compact('sampah'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sampah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($image = $request->file('foto')) {
            $destinationPath = 'images/';
            $profileImage = "IMG-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['foto'] = "$profileImage";
        }
        // dd($input);

        Sampah::create($input);

        return redirect()->route('sampah.index')->with('success','Sampah created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sampah  $sampah
     * @return \Illuminate\Http\Response
     */
    public function show(Sampah $sampah)
    {
        return view('sampah.show',compact('sampah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sampah  $sampah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sampah $sampah)
    {
        return view('sampah.edit',compact('sampah'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sampah  $sampah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sampah $sampah)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);

        $sampah->update($request->all());

        return redirect()->route('sampah.index')->with('success','Sampah updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sampah  $sampah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sampah $sampah)
    {
        $sampah->delete();

        return redirect()->route('sampah.index')->with('success','Sampah deleted successfully');
    }
}
