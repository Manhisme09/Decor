@extends('admin.layouts.layout')

@section('head')
    <title>Quản lý bài viết</title>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách bài viết</h1>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            @foreach ($errors->all() as $err)
                {{ $err }}
            @endforeach
        </div>
    @endif
    @if (session('thongbao'))
        <div class="alert alert-success">
            {{ session('thongbao') }}
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12">
            <p>
                <a class="btn btn-primary" href="{{ route('admin.baiviet.getThem') }}"> <i class="fa fa-plus"></i> Thêm
                    mới</a>
            <p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách bài viết
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Ảnh</th>
                                    {{-- <th>Nội dung</th> --}}
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($baiviet))
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($baiviet as $bv)
                                        <tr class="odd gradeX">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $bv->tieu_de }}</td>
                                            <td><img src="{{ asset($bv->image) }}" style="width: 250px; height:150px"
                                                    alt=""></td>
                                            {{-- <td>{!! $bv->noi_dung !!}</td> --}}
                                            <td>
                                                <a class="btn btn-warning btn-xs"
                                                    href="{{ route('admin.baiviet.getSua', ['id' => $bv->id]) }}" ​><i
                                                        class="fa fa-edit"></i> Sửa</a>
                                                <a class="btn btn-danger btn-xs" onclick=" return ConfirmDelete()"
                                                    href="{{ route('admin.baiviet.xoa', ['id' => $bv->id]) }}"><i
                                                        class="fa fa-trash-o  fa-fw"></i> Xoá</a>
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
