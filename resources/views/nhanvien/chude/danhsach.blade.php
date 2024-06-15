@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">Chủ đề</div>
        <div class="card-body table-responsive">
            <p><a href="{{ route('nhanvien.chude.them') }}" class="btn btn-info"><i class="bi bi-plus"></i> Thêm mới</a></p>
            {{ $chude -> links() }}
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="45%">Tên chủ đề</th>
                        <th width="40%">Tên chủ đề không dấu</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($chude as $value)
                <tr>
                    <td>{{ $loop->index + $chude -> firstItem() }}</td>
                    <td>{{ $value->tenchude }}</td>
                    <td>{{ $value->tenchude_slug }}</td>
                    <td class="text-center">
                    <a href="{{ route('nhanvien.chude.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>
                    </a>
                    </td>
                    <td class="text-center">
                    <a href="{{ route('nhanvien.chude.xoa', ['id' => $value->id]) }}" onclick="return confirm('Bạn có muốn xóa chủ đề {{ $value->tenchude }} không?')">
                        <i class="bi bi-trash text-danger"></i>
                    </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            </table>
            <br>
            {{ $chude -> links() }}
        </div>
    </div>
@endsection