<!-- Modal -->

@foreach ($list_pesanan as $pesanan)
<div class="modal fade" id="batalkanpesanan-{{ $pesanan->id_pemesanan }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="overflow: visible;">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="overflow: visible;">
        <div class="modal-content" style="overflow: visible;">
            <div class="modal-header">
                <h4 class="modal-title fs-5" id="exampleModalLabel">Batalkan Pesanan?</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <form action="{{ route('pesanan-batal', $pesanan->id_pemesanan) }}" method="post">
                    @method('delete')
                    @csrf
                    <div class="modal-body">
                        <div class="write_review">
                            <p style="font-size: 16px;">
                                Apakah Anda yakin ingin membatalkan pesanan ini? Pesanan yang sudah dibatalkan tidak dapat dikembalikan.
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn_1"
                            data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn_1">iya Batalkan</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endforeach


