<div class="header">
    @php $menusHtml = \App\Helpers\Helper::menus($danhmuc); @endphp
    <!-- header-info -->
    <div class="header-first">
        <div class="header-contact">
            <div style="padding-top: 57px">
                <i class="fab fa-facebook-f" style="font-size: 17px"></i>
                <i class="fab fa-tiktok" style="font-size: 17px; margin: 0 15px"></i>
                <i class="fab fa-youtube" style="font-size: 17px"></i>
            </div>
            <div class="header-logo-image">
                <img style="width: 300px;
                height: 40px" src="{{ asset('images/bannerlogo.png') }}" alt="">
            </div>
            <div class="item-header">
                <div class="multi-myaccount">
                    <button class="myaccount">
                        <div style="display:flex; justify-content:space-between; width:105px">
                            <div><i class="fas fa-user"></i></div>
                            <div>My account</div>
                            <div><i class="fas fa-angle-down"></i></div>
                        </div>
                    </button>
                    <ul class="account-item">
                        <li class="account-bar">
                            <a class="account-icon" href="{{ route('pages.dangnhap') }}">
                                Đăng nhập
                            </a>
                        </li>
                        <li class="account-bar">
                            <a class="account-icon" href="{{ route('pages.dangky') }}">
                               Đăng ký
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="multi-lang">
                    <button class="language">
                        <span class="getLang">
                            {{-- @if (Session::get('language') == 'en'|| Session::get('language') == null) --}}
                            <div class="flag-icon">
                                <img src="{{ asset('images/en.png') }}" alt="en" class="flag">
                                <span>English</span>
                                <div><i class="fas fa-angle-down"></i></div>

                            </div>
                            {{-- @elseif (Session::get('language') == 'vi') --}}
                            {{-- <div class="flag-icon">
                                <img src="{{ asset('images/vn.jpg') }}" alt="en" class="flag">
                                <span>VietNam</span>
                                <i class="fa-solid fa-angle-down"></i>
                            </div> --}}
                            {{-- @endif --}}
                        </span>
                    </button>
                    <ul class="language-item">
                        <li class="language-bar">
                            <a class="flag-icon">
                                <img src="{{ asset('images/en.png') }}" alt="EN" class="flag">
                                <span>English</span>
                            </a>
                        </li>
                        <li class="language-bar">
                            <a class="flag-icon">
                                <img src="{{ asset('images/vn.jpg') }}" alt="VN" class="flag">
                                <span>VietNam</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="icon-search-head">
                    <a href="#" class="search-icon" data-toggle="modal" data-target="#searchModal">
                        <i class="fas fa-search fa-lg"></i>
                    </a>
                </div>

                <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="searchModalLabel">Tìm kiếm</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="close-icon" aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Sản phẩm bạn muốn tìm..." aria-label="Search">
                            <button type="submit" class="btn btn-outline-success my-2 my-sm-0">
                                <span style="color: #ffff" class="fa fa-search"></span>
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="grid wide">
        <div id="top" class="header-info">
            <p class="header-info_phone">Hotline : 0378642530</p>
            <div class="header-info_about">
                @if (Session('login'))
                    <div class="dropdown">
                        <a href="{{ route('pages.gioithieu') }}" class="header-info_about-content btn">Giới thiệu</a>
                    </div>
                    <div class="dropdown">
                        <a href="{{ route('pages.getcskh') }}" class="header-info_about-content btn">CSKH</a>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                            style="border-left: 1px solid #ccc">{{ Session('user_login') }}
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('pages.getthongtin') }}"><i class="fas fa-user"></i> Thông tin
                                    tài khoản</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('pages.getdonhang') }}"><i class="fas fa-file-invoice"></i> Đơn
                                    hàng</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('pages.dangxuat') }}"><i class="fas fa-sign-out-alt"></i> Đăng
                                    xuất</a></li>
                        </ul>
                    </div>
                @elseif (Auth::check() && Auth::user()->role === 5)
                    <div class="dropdown">
                        <a href="{{ route('pages.gioithieu') }}" class="header-info_about-content btn">Giới thiệu</a>
                    </div>
                    <div class="dropdown">
                        <a href="{{ route('pages.getcskh') }}" class="header-info_about-content btn">CSKH</a>
                    </div>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                            style="border-left: 1px solid #ccc">{{ Auth::user()->khach_hang->ho_ten }}
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('pages.getthongtin') }}"><i class="fas fa-user"></i> Thông tin
                                    tài khoản</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('pages.getdonhang') }}"><i class="fas fa-file-invoice"></i> Đơn
                                    hàng</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('pages.getmatkhau') }}"><i class="fas fa-key"></i> Đổi mật
                                    khẩu</a></li>
                            <li class="divider"></li>
                            <li><a href="{{ route('pages.dangxuat') }}"><i class="fas fa-sign-out-alt"></i> Đăng
                                    xuất</a></li>
                        </ul>
                    </div>
                @else
                    <div class="dropdown">
                        <a href="{{ route('pages.gioithieu') }}" class="header-info_about-content btn">Giới thiệu</a>
                    </div>
                    <div class="dropdown">
                        <a href="{{ route('pages.getcskh') }}" class="header-info_about-content btn">CSKH</a>
                    </div>
                    <div class="dropdown">
                        <a href="{{ route('pages.dangnhap') }}" class="header-info_about-content btn">Đăng nhập</a>
                    </div>
                    <div class="dropdown">
                        <a href="{{ route('pages.dangky') }}" class="header-info_about-content btn">Đăng Ký</a>
                    </div>
                @endif
            </div>
        </div>

    </div> --}}


    <!-- header-bottom -->
    <div class="grid wide" style="height: 60px; line-height:50px; border-color: #f76b6a;">
        <div class="introduce-container">
                <div class="row no-gutters">
                    <div class="col m-12 c-12">
                        <div class="nav-container">
                            <ul class="nav-list" style="margin-bottom: 0px;">
                                <li class="nav-item"><a class="menu" href="{{ route('TrangChu') }}">TRANG
                                        CHỦ</a></li>
                                {!! $menusHtml !!}

                                <li class="nav-item"><a class="menu"
                                        href="{{ route('pages.baiviet') }}">TIN TỨC</a>
                                </li>
                                <li class="nav-item"><a class="menu"
                                        href="{{ route('pages.lienhe') }}">LIÊN HỆ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
