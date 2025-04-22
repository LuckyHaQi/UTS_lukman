<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Transaksi',
            'list' => ['Data', 'Transaksi']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi pembelian produk'
        ];

        $activeMenu = 'transaksi';

        $transaksi = Transaksi::with(['pelanggan', 'produk'])->get();

        return view('transaksi.index', compact('breadcrumb', 'page', 'activeMenu', 'transaksi'));
    }

    public function data(Request $request)
    {
        $transaksi = Transaksi::with(['pelanggan', 'produk'])->get();

        return DataTables::of($transaksi)
            ->addIndexColumn()
            ->addColumn('nama_pelanggan', function ($transaksi) {
                return $transaksi->pelanggan->nama ?? '-';
            })
            ->addColumn('nama_produk', function ($transaksi) {
                return $transaksi->produk->nama_produk ?? '-';
            })
            ->addColumn('aksi', function ($transaksi) {
                $btn = '<button onclick="modalAction(\'' . url('/transaksi/' . $transaksi->id_transaksi) . '\')" class="btn btn-primary"> Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/transaksi/' . $transaksi->id_transaksi . '/edit') . '\')" class="btn btn-warning"> Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/transaksi/' . $transaksi->id_transaksi . '/delete') . '\')" class="btn btn-danger"> Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();

        return view('transaksi.create', compact('pelanggan', 'produk'));
    }

    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
                'id_produk' => 'required|exists:produk,id_produk',
                'tanggal' => 'required|date',
                'jumlah' => 'required|integer|min:1'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            Transaksi::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data transaksi berhasil disimpan'
            ]);
        }

        return redirect('/transaksi');
    }

    public function show(string $id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'produk'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Transaksi',
            'list' => ['Home', 'Transaksi', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail transaksi'
        ];

        $activeMenu = 'transaksi';

        return view('transaksi.show', compact('breadcrumb', 'page', 'transaksi', 'activeMenu'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::find($id);
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();

        return view('transaksi.edit', compact('transaksi', 'pelanggan', 'produk'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_pelanggan' => 'required|exists:pelanggan,id_pelanggan',
                'id_produk' => 'required|exists:produk,id_produk',
                'tanggal' => 'required|date',
                'jumlah' => 'required|integer|min:1'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $transaksi = Transaksi::find($id);
            if ($transaksi) {
                $transaksi->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data transaksi berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/transaksi');
    }

    public function confirm(string $id)
    {
        $transaksi = Transaksi::find($id);

        return view('transaksi.confirm', compact('transaksi'));
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $transaksi = Transaksi::find($id);
            if ($transaksi) {
                $transaksi->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data transaksi berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/transaksi');
    }
}
