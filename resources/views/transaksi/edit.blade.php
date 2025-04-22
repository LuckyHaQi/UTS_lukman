<form action="{{ url('/transaksi/' . $transaksi->id_transaksi . '/update') }}" method="POST" id="form-edit-transaksi">
    @csrf
    @method('PUT')
    <div id="modal-transaksi" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title">Edit Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Pelanggan</label>
                                <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach (App\Models\Pelanggan::all() as $pelanggan)
                                        <option value="{{ $pelanggan->id_pelanggan }}"
                                            {{ $transaksi->id_pelanggan == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                                            {{ $pelanggan->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="error-id_pelanggan" class="error-text form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Produk</label>
                                <select name="id_produk" id="id_produk" class="form-control" required>
                                    <option value="">Pilih Produk</option>
                                    @foreach (App\Models\Produk::all() as $produk)
                                        <option value="{{ $produk->id_produk }}"
                                            {{ $transaksi->id_produk == $produk->id_produk ? 'selected' : '' }}>
                                            {{ $produk->nama_produk }}
                                        </option>
                                    @endforeach
                                </select>
                                <small id="error-id_produk" class="error-text form-text text-danger"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" required
                                    value="{{ $transaksi->tanggal }}">
                                <small id="error-tanggal" class="error-text form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="form-control" required
                                    min="1" value="{{ $transaksi->jumlah }}">
                                <small id="error-jumlah" class="error-text form-text text-danger"></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-edit-transaksi").validate({
            rules: {
                id_pelanggan: {
                    required: true
                },
                id_produk: {
                    required: true
                },
                tanggal: {
                    required: true
                },
                jumlah: {
                    required: true,
                    min: 1
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message
                            });
                            dataTransaksi.ajax.reload(); // reload datatable transaksi
                        } else {
                            $('.error-text').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
