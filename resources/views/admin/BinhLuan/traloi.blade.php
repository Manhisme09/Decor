@extends('admin.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Trả lời bình luận</h1>
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
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{ route('admin.binhluan.postReply', ['id' => $comment->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="ghi_chu">Bình luận của khách hàng</label>
                    <textarea class="form-control" name="" rows="3" disabled>{{ $comment->noi_dung }}</textarea>
                </div>
                <div class="form-group">
                    <label for="noi_dung">Trả lời</label>
                    <textarea class="form-control" name="noi_dung" rows="5"></textarea>
                </div>
                <a type="button" href="{{ route('admin.binhluan.index') }}" class="btn btn-success" value="quay lại">Quay
                    lại</a>
                <button type="submit" class="btn btn-primary mb-2">Trả lời</button>
            </form>
        </div>
    </div>

@endsection
