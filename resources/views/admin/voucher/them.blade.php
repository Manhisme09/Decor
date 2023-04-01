@extends('admin.layouts.layout')
@section('head')
    <title>Thêm phiếu giảm giá</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm phiếu giảm giá</h1>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Thêm phiếu giảm giá
        </div>
        @if (session('thongbao'))
            <div class="alert alert-success">{{ session('thongbao') }}</div>
        @endif
        <div class="panel-body">
            <form action="{{ route('admin.voucher.postThem') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="danh_muc">Mã phiếu giảm giá <span style="color: red"> *</span></label>
                    <input type="text" class="form-control" placeholder="Mã phiếu giảm giá" name="ma_giam_gia"
                        autocomplete="off" value="{{ old('ma_giam_gia') }}" />
                    @error('ma_giam_gia')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="danh_muc">Số tiền giảm<span style="color: red"> *</span></label>
                    <input type="text" class="form-control" placeholder="Số tiền giảm" name="so_tien"
                        autocomplete="off" value="{{ old('so_tien') }}" />
                    @error('so_tien')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="danh_muc">Số lượng<span style="color: red"> *</span></label>
                    <input type="number" class="form-control" placeholder="Số lượng phiếu giảm giá" name="so_luong"
                        autocomplete="off" value="{{ old('so_luong') }}" />
                    @error('so_luong')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="danh_muc">Ngày bắt đầu</label>
                    <input type="date" class="form-control" placeholder="Ngày bắt đầu" name="ngay_bat_dau"
                        autocomplete="off" value="{{ old('ngay_bat_dau') }}" />
                    @error('ngay_bat_dau')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="danh_muc">Ngày kết thúc</label>
                    <input type="date" class="form-control" placeholder="Ngày kết thúc" name="ngay_ket_thuc"
                        autocomplete="off" value="{{ old('ngay_ket_thuc') }}" />
                    @error('ngay_ket_thuc')
                        <p style="color: red">{{ $message }}</p>
                    @enderror
                </div>
                <a type="button" href="{{ route('admin.voucher.index') }}" class="btn btn-success" value="quay lại">Quay
                    lại</a>
                <button type="submit" class="btn btn-primary mb-2">Lưu</button>
                <button type="reset" class="btn btn-default">Nhập lại</button>
            </form>
        </div>
    </div>

@endsection
