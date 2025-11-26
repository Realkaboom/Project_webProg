<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\category;
use App\Models\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BarangController extends Controller
{
    public function viewcreatebarang(){
        $categories = category::all();
        $suppliers = supplier::all();
        return view('home', compact('categories', 'suppliers'));
    }
    
    public function createbarang(request $request){

        $request->validate([
            'kategoribarang' => 'required|integer|exists:categories,id',
            'supplierbarang' => 'required|integer|exists:suppliers,id',
            'namabarang' => 'required|string',
            'hargabarang' => 'required|integer|min:0',
            'jumlahbarang' => 'required|integer|min:0',
            'fotobarang' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $image_name = null;
        if($request->hasFile('fotobarang')){
            $image_path = 'public/fotobarang';
            $image = $request->file('fotobarang');
            $image_name = str::random(5).'_'.$image->getClientOriginalName();
            $image->storeAs($image_path, $image_name);
            //$path = $request->file('fotobarang')->storeAs($image_path, $image_name);
        }

        barang::create([
            'kategoribarang' => $request->kategoribarang,
            'supplierbarang' => $request->supplierbarang,
            'namabarang' => $request->namabarang,
            'hargabarang'=> $request->hargabarang,
            'jumlahbarang'=> $request->jumlahbarang,
            'fotobarang'=> $image_name,
        ]);
        return redirect('viewadmin');
    }

    public function view(){
        $thing = barang::with(['category', 'supplier'])->get();
        return view('viewuser')->with('semuabarang', $thing);
    }

    public function viewadmin(){
        $thing = barang::with(['category', 'supplier'])->get();
        return view('/viewadmin')->with('semuabarang', $thing);
    }

    public function editform($id){
        $thing = barang::findOrFail($id);
        $categories = category::all();
        $suppliers = supplier::all();
        return view('edit', [
            'semuabarang' => $thing,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }

    public function edit($id, Request $request){
        $thing = barang::findOrFail($id);

        $request->validate([
            'kategoribarang' => 'required|integer|exists:categories,id',
            'supplierbarang' => 'required|integer|exists:suppliers,id',
            'namabarang' => 'required|string',
            'hargabarang' => 'required|integer|min:0',
            'jumlahbarang' => 'required|integer|min:0',
            'fotobarang' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        if($request->hasFile('fotobarang')){
            $image_path = 'public/fotobarang';
            Storage::delete($image_path.$thing);

            $image = $request->file('fotobarang');
            $image_name = str::random(5).'_'.$image->getClientOriginalName();
            $image->storeAs($image_path, $image_name);
        } else {
            $image_name = $thing->fotobarang;
        }

        $thing->update([
            'kategoribarang' => $request->kategoribarang,
            'supplierbarang' => $request->supplierbarang,
            'namabarang' => $request->namabarang,
            'hargabarang'=> $request->hargabarang,
            'jumlahbarang'=> $request->jumlahbarang,
            'fotobarang' => $image_name,
        ]);
        return redirect('viewadmin');
    }

    public function delete($id){
        barang::destroy($id);

        return redirect('viewadmin');
    }
}
