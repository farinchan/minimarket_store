@extends('back/app')

@section('styles')
@endsection

@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form id="kt_ecommerce_add_category_form"
                class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" method="POST"
                action="{{route("back.produk.update", $produk->id_produk)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Foto Produk</h2>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <div class="image-input image-input-empty" data-kt-image-input="true">
                                <div class="image-input-wrapper w-200px h-150px"
                                    style="background-image: url('{{ $produk->getGambar() }}')">
                                </div>
                                <label
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Change thumbnail">
                                    <i class="bi bi-pencil"><span class="path1"></span><span class="path2"></span></i>
                                    <input type="file" name="gambar" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Cancel thumbnail">
                                    <i class="bi bi-x fs-3"></i>
                                </span>
                                <span
                                    class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                    title="Remove thumbnail">
                                    <i class="bi bi-x fs-3"></i>
                                </span>
                            </div>

                            @error('gambar')
                                <small class="text-danger">
                                    - {{ $message }}
                                </small>
                            @enderror
                            <div class="text-muted fs-7 pt-3">File yang diizinkan: *.png, *.jpg, *.jpeg <br>Maksimal 2mb
                                <br>Dengan rasio 1:1 - 400x400
                            </div>
                        </div>
                    </div>

                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Kategori Produk</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <label class="form-label required">kategori</label>
                            <select class="form-select mb-2" name="kategori_produk_id" data-control="select2" required>
                                @foreach ($kategori_produk as $kategori)
                                    <option @if ($produk->kategori_produk_id == $kategori->id_kategori_produk) selected @endif
                                        value="{{ $kategori->id_kategori_produk }}">
                                        {{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                            <div class="text-muted fs-7 mb-7">Tambah produk ke Kategori</div>
                            <a href="{{ route('back.kategori-produk.index') }}" class="btn btn-light-primary btn-sm mb-10">
                                <i class="ki-duotone ki-plus fs-2"></i>buat kategori baru
                            </a>

                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <div class="card-body py-0">
                            <div class="card card-flush py-4">
                                <a href="https://demo.gariskode.com/menu/hotel" class="btn btn-light-primary">Batal</a>
                                <button type="submit" class="btn btn-primary mt-4">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Informasi umum</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="fv-row fv-plugins-icon-container">
                                <label class="required form-label">Nama Produk</label>
                                <input type="text" name="nama"
                                    class="form-control mb-2 @error('nama') is-invalid @enderror" placeholder="produk Saya"
                                    value="{{ $produk->nama }}" required>
                            </div>
                            @error('nama')
                                <small class="text-danger">
                                    - {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="card-body pt-0">
                            <div class="fv-row fv-plugins-icon-container">
                                <label class="form-label">Deskripsi Produk</label>
                                <div id="editor" class="min-h-250px mb-2">
                                    {!! $produk->deskripsi !!}
                                    <p></p>
                                </div>
                                <input class="@error('deskripsi') is-invalid @enderror" type="hidden" id="deskripsi_quill"
                                    name="deskripsi">
                            </div>
                            @error('deskripsi')
                                <small class="text-danger">
                                    - {{ $message }}
                                </small>
                            @enderror
                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Informasi Produk</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-5">
                                <label class="required form-label">Harga (RP.)</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp.</span>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                        name="harga" value="{{ $produk->harga }}" required />
                                </div>
                                @error('harga')
                                    <small class="text-danger">
                                        - {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label class="required form-label">Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror" name="stok"
                                    value="{{ $produk->stok }}" required />
                                @error('stok')
                                    <small class="text-danger">
                                        - {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="mb-5">
                                <label class="required form-label">Berat (gram)</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control @error('berat') is-invalid @enderror" name="berat"
                                        value="{{ $produk->berat }}" required />
                                    <span class="input-group-text">gram</span>
                                </div>
                                @error('berat')
                                    <small class="text-danger">
                                        - {{ $message }}
                                    </small>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow'
        });
        var quillEditor = document.getElementById('deskripsi_quill');
        quillEditor.value = quill.root.innerHTML;
        quill.on('text-change', function() {
            quillEditor.value = quill.root.innerHTML;
        });
    </script>
@endsection
