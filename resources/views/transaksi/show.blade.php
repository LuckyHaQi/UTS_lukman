@empty($transaksi)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data transaksi yang Anda cari tidak ditemukan
                </div>
                <a href="{{ url('/transactions') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered table-striped w-100">
                    <tr>
                        <th class="text-right col-3">Nama Pelanggan</th>
                        <td>:</td>
                        <td class="col-9">{{ $transaksi->pelanggan->nama }}</td>
                    </tr>

                    <tr>
                        <th class="text-right col-3">Nama Produk</th>
                        <td>:</td>
                        <td class="col-9">{{ $transaksi->produk->nama_produk }}</td>
                    </tr>

                    <tr>
                        <th class="text-right col-3">Tanggal Transaksi</th>
                        <td>:</td>
                        <td class="col-9">{{ $transaksi->tanggal }}</td>
                    </tr>

                    <tr>
                        <th class="text-right col-3">Jumlah</th>
                        <td>:</td>
                        <td class="col-9">{{ $transaksi->jumlah }}</td>
                    </tr>

                    <tr>
                        <th class="text-right col-3">Total Harga</th>
                        <td>:</td>
                        <td class="col-9">Rp {{ number_format($transaksi->produk->harga * $transaksi->jumlah, 2, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Tutup</button>
            </div>
        </div>
    </div>
@endempty
