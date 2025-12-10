<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\category;
use App\Models\supplier;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function viewcreatebarang(){
        $categories = category::all();
        $suppliers = supplier::all();
        $things = barang::with(['category', 'supplier'])->orderByDesc('id')->get();
        return view('barang', [
            'categories' => $categories,
            'suppliers' => $suppliers,
            'semuabarang' => $things,
        ]);
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
            $image = $request->file('fotobarang');
            $image_name = str::random(5).'_'.$image->getClientOriginalName();
            $destination = public_path('fotobarang');
            File::ensureDirectoryExists($destination);
            $image->move($destination, $image_name);
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

    public function viewUserBarang(){
        $things = barang::with(['category', 'supplier'])->get();
        return view('userbarang')->with('semuabarang', $things);
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
            if ($thing->fotobarang) {
                $oldPath = public_path('fotobarang/'.$thing->fotobarang);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }
            $image = $request->file('fotobarang');
            $image_name = str::random(5).'_'.$image->getClientOriginalName();
            $destination = public_path('fotobarang');
            File::ensureDirectoryExists($destination);
            $image->move($destination, $image_name);
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
