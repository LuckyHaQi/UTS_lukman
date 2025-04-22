@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <button onclick="modalAction('{{ url('produk/create') }}')" class="btn btn-primary mt-1">Tambah</button>
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
                            <select class="form-control" id="filter_harga" name="filter_harga">
                                <option value="">- Semua Harga -</option>
                                <option value="murah">Harga Murah (&lt; 100.000)</option>
                                <option value="mahal">Harga Mahal (&ge; 100.000)</option>
                            </select>
                            <small class="form-text text-muted">Filter berdasarkan harga produk</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_produk">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
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

        var dataProduk;
        $(document).ready(function() {
            dataProduk = $('#table_produk').DataTable({
                serverSide: true,
                ajax: {
                    url: "{{ url('produk/data') }}",
                    type: "POST",
                    data: function(d) {
                        d.harga_filter = $('#filter_harga').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false },
                    { data: 'nama_produk', className: '', orderable: true, searchable: true },
                    { data: 'harga', className: 'text-right', orderable: true, searchable: true },
                    { data: 'aksi', className: 'text-center', orderable: false, searchable: false }
                ]
            });
        });

        $('#filter_harga').on('change', function() {
            dataProduk.ajax.reload();
        });
    </script>
@endpush
