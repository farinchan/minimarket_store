<footer class="revealed">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_1">Links</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_1">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('produk') }}">Produk</a></li>
                        <li><a href="#">Kategori</a></li>
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route("pesanan-saya") }}">Pesanan Saya</a></li>
                </div>
            </div>
            @php
                $kategori_produk = \App\Models\KategoriProduk::limit(6)->get();
                // dd($kategori_produk);
            @endphp
            <div class="col-lg-3 col-md-6">
                <h3 data-bs-target="#collapse_2">Kategori</h3>
                <div class="collapse dont-collapse-sm links" id="collapse_2">
                    <ul>
                        @foreach ($kategori_produk as $kategori)
                            <li><a href="{{ route('produk-category', ['cat' => $kategori->id_kategori_produk]) }}">{{ $kategori->nama }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_3">Kontak</h3>
                <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                    <ul>
                        <li><i class="ti-home"></i>Jl. Nasional, Rundeng, Kec. Johan Pahlawan<br>Kabupaten Aceh Barat, Aceh</li>
                        <li><i class="ti-headphone-alt"></i>+62 853-1915-6748</li>
                        <li><i class="ti-email"></i><a href="#0">info@sultanswalayan.com</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                    <h3 data-bs-target="#collapse_4">Terhubung dengan kami</h3>
                <div class="collapse dont-collapse-sm" id="collapse_4">
                    <div id="newsletter">
                        <div class="form-group">
                            <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Email Kamu">
                            <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
                        </div>
                    </div>
                    <div class="follow_us">
                        <h5>Follow Kami</h5>
                        <ul>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset("front/img/twitter_icon.svg") }}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset("front/img/facebook_icon.svg") }}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset("front/img/instagram_icon.svg") }}" alt="" class="lazy"></a></li>
                            <li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset("front/img/youtube_icon.svg") }}" alt="" class="lazy"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /row-->
        <hr>
        <div class="row add_bottom_25">
            <div class="col-lg-6">
                <ul class="footer-selector clearfix">
                    <li>
                        <div class="styled-select lang-selector">
                            <select>
                                <option value="Indonesia" selected>Indonesia</option>
                            </select>
                        </div>
                    </li>
                    <li>
                        <div class="styled-select currency-selector">
                            <select>
                                <option value="Rupiah" selected>Rupiah</option>
                            </select>
                        </div>
                    </li>
                    <li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset("front/img/cards_all.svg") }}" alt="" width="198" height="30" class="lazy"></li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="additional_links">
                    <li><span>© {{ date('Y') }} Minimarket</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
