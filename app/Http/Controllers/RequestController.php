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

<<<<<<< HEAD
    public function indexAdmin()
    {
        $requests = RequestData::with(['barang', 'user'])->orderByDesc('created_at')->get();
        return view('requests.admin_index', compact('requests'));
    }

    public function myRequests()
    {
        $requests = RequestData::with(['barang'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('requests.my_requests', compact('requests'));
    }

=======
>>>>>>> BACKUP2
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
<<<<<<< HEAD

    public function approve($id)
    {
        $req = RequestData::with('barang')->findOrFail($id);

        if ($req->status !== 'pending') {
            return back()->withErrors(['status' => 'Permintaan sudah diproses.']);
        }

        if ($req->quantity > $req->barang->jumlahbarang) {
            return back()->withErrors([
                'quantity' => 'Stok tidak cukup. Stok tersedia: '.$req->barang->jumlahbarang,
            ]);
        }

        $req->barang->decrement('jumlahbarang', $req->quantity);
        $req->update(['status' => 'approved']);

        return back()->with('success', 'Permintaan disetujui dan stok dikurangi.');
    }

    public function reject($id)
    {
        $req = RequestData::findOrFail($id);

        if ($req->status !== 'pending') {
            return back()->withErrors(['status' => 'Permintaan sudah diproses.']);
        }

        $req->update(['status' => 'rejected']);

        return back()->with('success', 'Permintaan ditolak.');
    }
=======
>>>>>>> BACKUP2
}
