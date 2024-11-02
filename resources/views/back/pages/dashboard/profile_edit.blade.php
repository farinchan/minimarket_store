@extends('back.app')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <form id="kt_ecommerce_add_category_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('back.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Foto</h2>
                            </div>
                        </div>
                        <div class="card-body text-center pt-0">
                            <style>
                                .image-input-placeholder {
                                    background-image: url('{{ Auth::user()->pegawai->getFoto() }}');
                                }

                                [data-bs-theme="dark"] .image-input-placeholder {
                                    background-image: url('{{ Auth::user()->pegawai->getFoto() }}');
                                }
                            </style>
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                                data-kt-image-input="true">
                                <div class="image-input-wrapper w-150px h-150px"></div>
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ubah Thumbnail">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <input type="file" name="foto" accept=".png, .jpg, .jpeg" />
                                    <input type="hidden" name="avatar_remove" />
                                </label>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batalkan Thumbnail">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus Thumbnail">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <div class="text-muted fs-7">
                                Set foto anggota, hanya menerima file dengan ekstensi .png, .jpg, .jpeg
                            </div>
                        </div>
                    </div>
                    {{-- <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Role</h2>
                            </div>
                            <div class="card-toolbar">
                                <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_category_status">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="role_user" value="1" checked
                                    id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    User
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" name="role_admin" value="1" @if (old('role_admin') == 1) checked @endif
                                    id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Admin
                                </label>
                            </div>
                            @error('status')
                                <div class="text-danger fs-7">{{ $message }}</div>
                            @enderror

                        </div>
                    </div> --}}
                </div>
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Biodata</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Nama</label>
                                <input type="text" name="nama" class="form-control mb-2"
                                    placeholder="Nama" value="{{Auth::user()->pegawai->nama}}" required />
                                @error('nama')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select mb-2" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" @if (Auth::user()->pegawai->jenis_kelamin == 'L') selected @endif>
                                        Laki-laki</option>
                                    <option value="P" @if (Auth::user()->pegawai->jenis_kelamin == 'P') selected @endif> Perempuan </option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="mb-5 fv-row">
                                <label class="required form-label">Tempat, Tanggal Lahir</label>
                                <div class="d-flex flex-stack mb-2">
                                    <input type="text" name="tempat_lahir" class="form-control me-2"
                                        placeholder="Tempat Lahir" value="{{Auth::user()->pegawai->tempat_lahir}}" required />
                                    <input type="date" name="tanggal_lahir" class="form-control" value="{{Auth::user()->pegawai->tanggal_lahir}}"
                                        required />
                                </div>
                                @error('tempat_lahir')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                                @error('tanggal_lahir')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Alamat</label>
                                <textarea name="alamat" class="form-control mb-2" rows="3"
                                    placeholder="Alamat Lengkap" required>{{Auth::user()->pegawai->alamat}}</textarea>
                                @error('alamat')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">No. Telepon</label>
                                <input type="text" name="no_telp" class="form-control mb-2"
                                    placeholder="Nomor Telepon" value="{{Auth::user()->pegawai->no_telp}}" required />
                                @error('no_telp')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div id="kepakaran_view"></div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control mb-2"
                                    placeholder="Jabatan" value="{{Auth::user()->pegawai->jabatan}}" required  readonly/>
                                @error('jabatan')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="mb-5 fv-row">
                                <label class="required form-label">Email</label>
                                <input type="email" name="email" class="form-control mb-2" placeholder="Email"
                                    value="{{Auth::user()->email}}" required />
                                @error('email')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-5 fv-row">
                                <label class="required form-label">Password</label>
                                <input type="password" name="password" class="form-control mb-2" placeholder="Password" />
                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                                @error('password')
                                    <div class="text-danger fs-7">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan Perubahan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
