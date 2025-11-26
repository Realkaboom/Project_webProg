<?php

namespace App\Http\Controllers;

use App\Models\supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'contact' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        supplier::create($data);

        return redirect()->route('suppliers.index');
    }

    public function show($id)
    {
        $supplier = supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
    }

    public function edit($id)
    {
        $supplier = supplier::findOrFail($id);
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = supplier::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|min:3',
            'contact' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $supplier->update($data);

        return redirect()->route('suppliers.index');
    }

    public function destroy($id)
    {
        supplier::destroy($id);
        return redirect()->route('suppliers.index');
    }
}
