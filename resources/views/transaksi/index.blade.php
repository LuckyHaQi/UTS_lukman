@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('transaksi/create') }}')" class="btn btn-primary mt-1">Tambah</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter :</label>
                        <div class="col-3">
                            <select class="form-control" id="filter_pelanggan" name="filter_pelanggan">
                                <option value="">- Semua Pelanggan -</option>
                                @foreach(App\Models\Pelanggan::all() as $pelanggan)
                                    <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Filter berdasarkan pelanggan</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_transaksi">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Nama Produk</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataTransaksi;
        $(document).ready(function() {
            dataTransaksi = $('#table_transaksi').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('transaksi/data') }}",
                    type: "POST",
                    data: function(d) {
                        d.id_pelanggan = $('#filter_pelanggan').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                    { data: 'nama_pelanggan', className: '', orderable: true, searchable: true },
                    { data: 'nama_produk', className: '', orderable: true, searchable: true },
                    { data: 'tanggal', className: '', orderable: true, searchable: true },
                    { data: 'jumlah', className: 'text-center', orderable: true, searchable: true },
                    { data: 'aksi', className: 'text-center', orderable: false, searchable: false }
                ]
            });
        });

        $('#filter_pelanggan').on('change', function() {
            dataTransaksi.ajax.reload();
        });
    </script>
@endpush
