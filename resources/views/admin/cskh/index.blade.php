@extends('admin.layouts.layout')

@section('head')
    <title>Chăm sóc khách hàng</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách lời nhắn khách hàng</h1>
        </div>
    </div>
    @if (session('thongbao'))
        <div class="alert alert-success">{{ session('thongbao') }}</div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Danh sách lời nhắn</div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($cskh))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($cskh as $item)
                                        <tr class="odd gradeX">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->ho_ten }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->dien_thoai }}</td>
                                            <td>{{ $item->noi_dung }}</td>
                                            <td>
                                                @if ($item->status == 0)
                                                Chưa phản hồi | <a class="btn btn-success btn-xs"
                                                    href="{{ route('admin.cskh.repFeedback', ['id' => $item->id]) }}"><i
                                                        class="fa fa-check"></i> Phản hồi</a>
                                                @elseif ($item->status == 1)
                                                <b style="color: green;">ĐÃ PHẢN HỒI</b>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
@endsection
