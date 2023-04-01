@extends('admin.layouts.layout')
@section('head')
    <title>Quản lý bình luận</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách bình luận</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách bình luận
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                <tr align="center">
                                    <th>STT</th>
                                    <th>Người gửi</th>
                                    <th>Nội dung</th>
                                    <th>Ngày gửi</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($binhluan))
                                    <?php $i = 1; ?>
                                    @foreach ($binhluan as $bl)
                                        <tr class="even gradeC" align="center">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $bl->users->email }}</td>
                                            <td>{{ $bl->noi_dung }}</td>
                                            <td>{{ $bl->created_at }}</td>
                                            <td class="center">
                                                <a class="btn btn-success btn-xs btn-edit"
                                                    href="{{ route('admin.binhluan.gatReply', ['id' => $bl->id]) }}"><i
                                                        class="fa fa-reply fa-fw"></i>Trả lời</a>
                                                <a class="btn btn-danger btn-xs"
                                                    href="{{ route('admin.binhluan.xoa', ['id' => $bl->id]) }}"
                                                    onclick="return ConfirmDelete()"><i
                                                        class="fa fa-trash-o  fa-fw"></i>Xoá</a>
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
