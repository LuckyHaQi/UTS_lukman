<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PelangganController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Pelanggan',
            'list' => ['Data', 'Pelanggan']
        ];

        $page = (object) [
            'title' => 'Daftar pelanggan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pelanggan';

        $pelanggan = Pelanggan::all();

        return view('pelanggan.index', compact('breadcrumb', 'page', 'activeMenu', 'pelanggan'));
    }

    public function data(Request $request)
    {
        $pelanggan = Pelanggan::all();

        return DataTables::of($pelanggan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($pelanggan) {
                $btn = '<button onclick="modalAction(\'' . url('/pelanggan/' . $pelanggan->id_pelanggan . '') . '\')" class="btn btn-primary">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/pelanggan/' . $pelanggan->id_pelanggan . '/edit') . '\')" class="btn btn-warning"> Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/pelanggan/' . $pelanggan->id_pelanggan . '/delete') . '\')" class="btn btn-danger"> Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'email' => 'required|string|email|max:255',
                'no_hp' => 'required|string|digits_between:10,15',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            Pelanggan::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data pelanggan berhasil disimpan'
            ]);
        }

        return redirect('/pelanggan');
    }

    public function show(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Pelanggan',
            'list' => ['Home', 'Pelanggan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail pelanggan'
        ];

        $activeMenu = 'pelanggan';

        return view('pelanggan.show', compact('breadcrumb', 'page', 'pelanggan', 'activeMenu'));
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::find($id);
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama' => 'required|string|min:3|max:100',
                'email' => 'required|string|email|max:255',
                'no_hp' => 'required|string|digits_between:10,15',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors()
                ]);
            }

            $pelanggan = Pelanggan::find($id);
            if ($pelanggan) {
                $pelanggan->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data pelanggan berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/pelanggan');
    }

    public function confirm(string $id)
    {
        $pelanggan = Pelanggan::find($id);

        return view('pelanggan.confirm', compact('pelanggan'));
    }

    public function delete(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $pelanggan = Pelanggan::find($id);
            if ($pelanggan) {
                $pelanggan->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data pelanggan berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }

        return redirect('/pelanggan');
    }
}
