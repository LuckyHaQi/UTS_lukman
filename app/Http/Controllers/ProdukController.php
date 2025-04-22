<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Produk',
            'list' => ['Data', 'Produk']
        ];

        $page = (object) [
            'title' => 'Daftar produk yang tersedia'
        ];

        $activeMenu = 'produk';

        $produk = Produk::all();

        return view('produk.index', compact('breadcrumb', 'page', 'activeMenu', 'produk'));
    }

    public function data(Request $request)
    {
        $produk = Produk::all();

        return DataTables::of($produk)
            ->addIndexColumn()
            ->addColumn('aksi', function ($produk) {
                $btn = '<button onclick="modalAction(\'' . url('/produk/' . $produk->id_produk) . '\')" class="btn btn-primary"> Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/produk/' . $produk->id_produk . '/edit') . '\')" class="btn btn-warning"> Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/produk/' . $produk->id_produk . '/delete') . '\')" class="btn btn-danger"> Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_produk' => 'required|string|min:3|max:100',
                'harga' => 'required|numeric|min:0',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            Produk::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data produk berhasil disimpan'
            ]);
        }

        return redirect('/produk');
    }

    public function show(string $id)
    {
        $produk = Produk::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Produk',
            'list' => ['Home', 'Produk', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail produk'
        ];

        $activeMenu = 'produk';

        return view('produk.show', compact('breadcrumb', 'page', 'produk', 'activeMenu'));
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_produk' => 'required|string|min:3|max:100',
                'harga' => 'required|numeric|min:0',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $produk = Produk::find($id);
            if ($produk) {
                $produk->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data produk berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/produk');
    }

    public function confirm(string $id)
    {
        $produk = Produk::find($id);

        return view('produk.confirm', compact('produk'));
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $produk = Produk::find($id);
            if ($produk) {
                $produk->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data produk berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/produk');
    }
}
