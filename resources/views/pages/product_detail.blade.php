@extends('pages/layouts/layout')
@section('title')
    <title>Chi tiết sản phẩm | Nội thất Furnibuy</title>
@endsection
@section('content')
    <div class="main">
        <div class="content">
            <div class="banner-head">
                <div class="banner-head">
                    <div class="url-main">
                        <div class="url-title">{{ $chiTiet->ten_san_pham }}</div>
                        <nav aria-label="breadcrumb row">
                            <ol class="breadcrumb url-menu nav-product">
                                <li class="breadcrumb-item"><a href="{{ route('TrangChu') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="/san-pham/{{ $chiTiet->danh_muc->id }}">{{ $chiTiet->danh_muc->ten_danh_muc }}</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="sidebar-main">
                    <div class="main-content">
                        <div class="content-product">
                            <div class="content-img-product">
                                <img id="main-image" src="{{ asset($images[0]->url) }}" alt="">
                                <div class="image-list">
                                  @foreach ( $images as $index => $image )
                                  <img class="thumbnail {{ $index == 0 ? 'active' : '' }}" style="width: 80px; height: 80px" src="{{ asset($image->url) }}" alt="" onclick="displayImage('{{ asset($image->url) }}')">
                                  @endforeach
                                </div>
                            </div>
                            <div id="image-modal" class="modal">
                                <span class="close" onclick="closeModal()">&times;</span>
                                <img id="modal-image" src="" alt="">
                              </div>
                            <div class="content-info-product">
                                <h1 class="name-product">{{ $chiTiet->ten_san_pham }}</h1>
                                <div class="product-meta" style="padding: 0px 16px; line-height:1.6">
                                    <p class="sold">{!! $chiTiet->thuoc_tinh !!}</p>
                                </div>
                                <div class="prices">
                                    <p class="price-product">Giá: {{ number_format($chiTiet->gia_ban) }} VNĐ</p>
                                    <div class="product-meta">
                                        <span class="sold">Đã bán: {{ $chiTiet->da_ban }}</span>
                                        <span class="posted_in">Tình trạng: @if ($chiTiet->so_luong === 0)
                                                <i>Hết hàng</i>
                                            @else
                                                <i>Còn hàng</i>
                                            @endif
                                        </span>
                                    </div>
                                    @if ($chiTiet->so_luong > 0)
                                        <div class="buy">
                                            <a style="cursor: pointer; color: white;" class="btn-buy"
                                                onclick="addCart({{ $chiTiet->id }})" data-id="{{ $chiTiet->id }}">Thêm
                                                vào giỏ hàng</a>
                                        </div>
                                    @else
                                        <div class="buy">
                                            <p style="color: white; border-color: #ffffff"
                                                class="btn-not-buy">Thêm vào
                                                giỏ hàng</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="detail-product">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#home">MÔ TẢ</a></li>
                                <li><a data-toggle="tab" href="#menu1">LÀM THEO YÊU CẦU</a></li>
                                <li><a data-toggle="tab" href="#menu2">CÁCH MUA HÀNG</a></li>
                            </ul>

                            <div class="tab-content" style="padding: 30px; border:1px solid rgb(233, 230, 230)">
                                <div id="home" class="tab-pane fade in active">
                                    <p>{!! $chiTiet->mo_ta !!}</p>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <p>Bên cạnh sản phẩm có bán sẵn như bên, quý khách cũng có thể đặt đóng đồ nội thất theo
                                        nhu cầu riêng của mình.</p>
                                    <p>Hiện nội thất FurniBuy.com có nhận đóng các mặt hàng nội thất với giá rẻ trực tiếp
                                        tại xưởng. Bao gồm:</p>
                                    <p>- Làm theo mẫu mã khách hàng thích (hình ảnh, bản vẽ thiết kế…)</p>
                                    <p>- Làm theo chất liệu riêng khách hàng chọn lựa</p>
                                    <p>- Chọn màu sắc theo sở thích</p>
                                    <p>- Kích thước riêng vừa với không gian kê</p>
                                    <p>Thời gian làm nhanh chỉ khoảng 3-6 ngày tùy vào độ khó của mẫu thiết kế, một số
                                        trường hợp còn có thể nhanh hơn.</p>
                                    <p>Nhận làm với mọi số lượng, từ đơn hàng lẻ hộ gia đình tới các đơn hàng lớn cho các dự
                                        án và các công ty đối tác.</p>
                                    <p>Nội thất FurniBuy.com hoàn toàn chủ động về mặt sản xuất, với 3 xưởng sản xuất quy
                                        mô, tự tin sẽ đáp ứng tốt yêu cầu của quý khách hàng. Có nhân viên đến khảo sát tư
                                        vấn tận nơi theo yêu cầu.</p>
                                    <p>Vui lòng liên hệ các cửa hàng trong hệ thống (xem địa chỉ và bản đồ chỉ đường dưới
                                        chân website này) hoặc các số Hotline để được tư vấn chi tiết.</p>
                                    <p>Rất hân hạnh được phục vụ!</p>
                                </div>
                                <div id="menu2" class="tab-pane fade">
                                    <p>Nội thất FurniBuy.com xin kính chào quý khách.</p>
                                    <p>Quý khách có thể mua hàng của chúng tôi dưới 4 hình thức:</p>
                                    <p>- Đến trực tiếp trải nghiệm và chọn mua (ưu tiên nhất)</p>
                                    <p>- Đặt hàng qua Điện thoại, Zalo (ưu tiên thứ 2)</p>
                                    <p>- Đặt hàng online trực tiếp trên website (ưu tiên thứ 3).</p>
                                    <p>- Hoặc cần nhân viên tư vấn tại nhà khách hàng (áp dụng với một số khu vực)</p>
                                    <p>Sở dĩ chúng tôi sắp xếp theo thứ tự ưu tiên như trên là dựa trên sự đảm bảo tương tác
                                        tốt nhất với khách hàng, giúp khách hàng mua được sản phẩm ưng ý nhất đúng với nhu
                                        cầu sử dụng của mình.</p>
                                    <p>-> Trải nghiệm thực tế (ngồi thử, nằm thử, dùng thử) sẽ tốt hơn là nhìn bằng mắt.</p>
                                    <p>-> Nhìn thực tế bằng mắt sẽ tốt hơn là chỉ nhìn hình ảnh chụp qua điện thoại, Zalo,
                                        xem trên mạng…</p>
                                    <p>-> Được tương tác, tư vấn kỹ, gửi hình ảnh thực tế sản phẩm… qua điện thoại, Zalo thì
                                        sẽ tốt hơn là chỉ xem qua trên website rồi bấm đặt hàng luôn…</p>
                                    <p>-> Được nhân viên có kinh nghiệm tư vấn thì sẽ đưa ra quyết định chuẩn xác hơn là tự
                                        khách hàng mua khi mà không có kinh nghiệ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="well">
                    <form action="{{ route('pages.postbinhluan', ['id' => $chiTiet->id]) }}" method="POST" role="form">
                        @csrf
                        @if ((Auth::check() && Auth::user()->role === 5) || Session('login'))
                            <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                            <div class="form-group">
                                <textarea class="form-control" rows="8" name="noi_dung"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-left: 1047px">Gửi</button>
                        @endif
                        <!-- Comment -->
                        @if (empty($binhluan[0]))
                            <div class="media">Chưa có bình luận nào</div>
                        @else
                            @foreach ($binhluan as $item)
                                <div class="media">
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $item->users->name }}
                                            <small>{{ $item->created_at }}</small>
                                        </h4>
                                        {{ $item->noi_dung }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->


                <div class="product-propose">
                    <div class="grid wide">
                        <div class="product-propose_title">
                            <h3 class="product-propose_title-name active">SẢN PHẨM LIÊN QUAN</h3>
                            <div class="line"></div>
                        </div>
                        <div class="product-propose_new active">
                            <div class="slick-slider">
                                @foreach ($tuongTu as $tt)
                                <div>
                                        <div class="product-propose_new-item">
                                            <a href="{{ route('pages.chitietsanpham', ['slug' => $tt->slug, 'id' => $tt->id]) }}">
                                            <img class="product-propose_new-item_img" src="{{ asset($tt->image[0]->url) }}"
                                                alt="FURNIBUY">
                                            <div class="product-top">
                                            <p class="product-propose_new-item_info">{{ $tt->ten_san_pham }}</p>
                                            <h4 class="product-propose_new-item_price">Giá:
                                                {{ number_format($tt->gia_ban) }} VNĐ</h4>
                                            </div>
                                            </a>
                                        </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
