<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('head')

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/iconlogo.PNG') }}">
    <link href="{{ asset('front-end/admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/admin/css/metisMenu.min.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/admin/css/dataTables/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/admin/css/dataTables/dataTables.responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/admin/css/startmin.css') }}" rel="stylesheet">
    <link href="{{ asset('front-end/admin/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('front-end/admin/css/style.css') }}">

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="">FURNIBUY - ADMIN</a>
            </div>

            <ul class="nav navbar-right navbar-top-links">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{ Auth::user()->admin ? Auth::user()->admin->ho_ten : '' }}<b
                            class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ route('admin.getadminprofile') }}"><i class="fa fa-user fa-fw"></i> Thông tin
                                tài khoản</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" style="background-color: initial" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav">
                        <li>
                            <a href="{{ route('admin.index') }}"><i class="fa fa-home"></i></i> Trang chủ</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.DanhMuc.index') }}"><i class="fa fa-pied-piper-pp fa-fw"></i>
                                Quản lý danh mục </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.SanPham.index') }}"><i class="fa fa-product-hunt fa-fw"></i>
                                Quản lý sản phẩm </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.hoadon.index') }}"><i class="fa fa-paste fa-fw"></i> Quản lý hoá
                                đơn</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.khachhang.index') }}"><i class="fa fa-group fa-fw"></i> Quản lý
                                khách hàng</a>
                        </li>
                        @if (Auth::user()->role == 1)
                            <li>
                                <a href="{{ route('admin.nhanvien.index') }}"><i class="fa fa-group fa-fw"></i> Quản
                                    lý
                                    nhân viên</a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('admin.binhluan.index') }}"><i class="fa fa-comment"></i> Quản lý bình
                                luận</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.baiviet.index') }}"><i class="fa fa-newspaper-o"></i> Quản lý
                                bài viết</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.slide.index') }}"><i class="fa fa-sliders"></i> Quản lý
                                slide</a>
                        </li>
                        {{-- <li>
                            <a href="{{ route('admin.voucher.index') }}"><i class="fa fa-info-circle"></i> Quản lý
                                phiếu giảm giá</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('admin.cskh.index') }}"><i class="fa fa-info-circle"></i> Quản lý liên
                                hệ</a>
                        </li>
                        @if (Auth::user()->role == 1)
                            <li>
                                <a href="{{ route('admin.thongke.index') }}"><i class="fa fa-bar-chart"></i> Thống
                                    kê</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid" style="min-height: 620px;">
                @yield('content')
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>

    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="{{ asset('front-end/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('front-end/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('front-end/admin/js/metisMenu.min.js') }}"></script>

    <script src="{{ asset('front-end/admin/js/dataTables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('front-end/admin/js/dataTables/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('front-end/admin/js/startmin.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            $('#table-admin').DataTable({
                responsive: true
            });
        });
    </script>

    <script>
        function ConfirmDelete() {
            var x = confirm("Bạn có muốn xoá?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

    <script>
        function ConfirmDeleteCate() {
            var x = confirm("Tất cả các sản phẩm nằm trong danh mục này đều bị xoá. Bạn có muốn xoá?");
            if (x)
                return true;
            else
                return false;
        }
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">
        $(".alert").fadeTo(4500, 800).slideUp(800, function() {
            $(".alert").slideUp(800);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                language: {
                    processing: "Message khi đang tải dữ liệu",
                    search: "Tìm kiếm",
                    lengthMenu: "Hiển thị _MENU_ mục",
                    info: "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    infoEmpty: "Hiển thị 0 đến 0 trong tổng số 0 mục",
                    infoFiltered: "(Được lọc từ tổng số _MAX_ mục)",

                    loadingRecords: "",
                    zeroRecords: "Không tìm thấy kết quả",
                    emptyTable: "Không có dữ liệu",
                    paginate: {
                        first: "Trang đầu",
                        previous: "Trang trước",
                        next: "Trang sau",
                        last: "Trang cuối"
                    },
                    aria: {
                        sortAscending: ": Message khi đang sắp xếp theo column",
                        sortDescending: ": Message khi đang sắp xếp theo column",
                    }
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>
