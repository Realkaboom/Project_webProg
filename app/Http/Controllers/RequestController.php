<?php

namespace App\Http\Controllers;

use App\Models\RequestData;
use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function create()
    {
        $barangs = barang::with(['category', 'supplier'])->get();
        return view('requests.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'barang_id' => 'required|integer|exists:barangs,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        $barang = barang::findOrFail($data['barang_id']);

        if ($data['quantity'] > $barang->jumlahbarang) {
            return back()->withErrors([
                'quantity' => 'Stok tidak cukup. Stok tersedia: '.$barang->jumlahbarang,
            ])->withInput();
        }

        RequestData::create([
            'user_id' => Auth::id(),
            'barang_id' => $barang->id,
            'quantity' => $data['quantity'],
            'status' => 'pending',
            'note' => $data['note'] ?? null,
        ]);

        return redirect()->route('viewall')->with('success', 'Permintaan disimpan (pending).');
    }
}
