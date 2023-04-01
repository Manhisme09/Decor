<div class="header">
    @php $menusHtml = \App\Helpers\Helper::menus($danhmuc); @endphp
    <!-- header-info -->

    <div class="grid wide">
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

    </div>


    <!-- header-bottom -->
    <div class="grid wide">
        <div class="header-bottom">
            <div class="header-bottom_logo">
                <img src="../images/logo_furnibuy.png" alt="">
            </div>
            <div class="header-bottom_search">
                <div class="header-bottom_menu">
                    <div class="header-bottom_menu-icon">
                        <i class="fas fa-bars"></i>
                    </div>
                    <div class="header-bottom_menu-list">
                        <ul class="nav-list_responsive">
                            <div class="nav-list_responsive-icon">
                                <i class="fas fa-times"></i>
                            </div>
                            <li class="nav-itemRespponsive">TRANG CHỦ
                            </li>
                            <li class="nav-itemRespponsive">TRẺ EM
                            </li>
                            <li class="nav-itemRespponsive">NAM
                            </li>
                            <li class="nav-itemRespponsive">NỮ
                            </li>
                            <li class="nav-itemRespponsive">TIÊU DÙNG
                            </li>
                            <li class="nav-itemRespponsive">LÀM ĐẸP
                            </li>
                            <li class="nav-itemRespponsive">MADE BY ANGELS
                            </li>
                            <li class="nav-itemRespponsive">COMBO
                            </li>
                            <li class="nav-itemRespponsive">TIN TỨC
                            </li>
                        </ul>
                    </div>



                </div>
                {{-- <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="{{ route('pages.timkiem') }}">
                        <input type="text" value="" name="keyname" id="s" placeholder="Nhập từ khóa..." />
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div> --}}
                <form style="display: flex; width: 100%;" role="search" method="get" id="searchform"
                    action="{{ route('pages.timkiem') }}">
                    <input name="keyname" class="header-bottom_search-input" type="text" placeholder="Tìm kiếm...">
                    <button class="header-bottom_search-btn"><i class="fas fa-search"></i></button>
                </form>

                <div class="header-bottom_cart reponsive">
                    <button class="header-bottom_cart-icon header-bottom_cart-icon2">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                    <p class="header-bottom_cart-info header-bottom_cart-info2">0 sản phẩm
                        <br> <span>0 ₫</span>
                    </p>

                </div>
            </div>

            <div class="header-bottom_cart pc">
                <a href="{{ route('pages.giohang') }}" class="header-bottom_cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <p class="header-bottom_cart-info header-bottom_cart-info1">
                    @if (isset(Session::get('Cart')->tongsoluong))
                        {{ number_format(Session::get('Cart')->tongsoluong) }} sản phẩm
                    @else
                        0 sản phẩm
                    @endif
                    <br> <span>
                        @if (isset(Session::get('Cart')->tonggia))
                            {{ number_format(Session::get('Cart')->tonggia) }} VNĐ
                        @else
                            0 VNĐ
                        @endif
                    </span>
                </p>
            </div>

        </div>
    </div>
    <div class="introduce-container">
        <div class="">
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
