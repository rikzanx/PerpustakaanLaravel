<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $buku = Buku::all();
        return view('admin.buku.index', ['bukus' => $buku]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buku = Buku::all();
        return view('admin.buku.create', ['bukus' => $buku]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

       $data = $request->all();
        $data['foto_cover'] = $request->file('foto_cover')
        ->store('assets/cover','public');

        Buku::create($data);     
       return redirect ('buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku  = Buku::findOrFail($id);
        return view('admin.buku.detail',['bukus' => $buku]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku  = Buku::findOrFail($id);
        return view('admin/buku/edit',['bukus' => $buku]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);
        $data['foto_cover'] = $request->file('foto_cover')->store(
            'assets/cover','public'
        );

        $item = Buku::findOrFail($id);
        
        $item->update($data);

        return redirect()->route('buku');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        

        return redirect()->route('buku');
    }
}