<!-- Modal -->

@foreach ($list_pesanan as $pesanan)
<div class="modal fade" id="pembayaran-{{ $pesanan->id_pemesanan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: visible;">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="overflow: visible;">
        <div class="modal-content" style="overflow: visible;">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Pembayaran</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form action="{{ route('pesanan-pembayaran', $pesanan->id_pemesanan) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="write_review">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5>Informasi Pembayaran</h5>
                                    <p>
                                        Silahkan lakukan pembayaran sebesar <strong>@money($pesanan->total_harga_produk)</strong> <br>
                                        <strong>
                                            Transfer ke rekening <br>
                                            {{ $pesanan->metodePembayaran->bank }} {{ $pesanan->metodePembayaran->no_rek }} a/n
                                            {{ $pesanan->metodePembayaran->atas_nama }}
                                        </strong> <br>
                                        Setelah melakukan pembayaran, silahkan upload bukti pembayaran di bawah ini.
                                    </p>

                                    <div class="form-group mb-3">
                                        <label for="alamat">Bukti Pembayaran<span style="color: red">*</span> </label>
                                        <input type="file" class="form-control" name="bukti_pembayaran" accept="image/*" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn_1">Bayar</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endforeach


