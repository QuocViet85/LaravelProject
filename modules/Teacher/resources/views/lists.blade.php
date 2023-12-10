@extends('layouts.backend')

@section('content')
<p><a href="{{ route('admin.teacher.create') }}" class="btn btn-primary">Thêm mới</a></p>
@if(session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif
<table id="datatable" class="table table-bordered">
    <thead>
        <tr>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Kinh nghiệm</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Kinh nghiệm</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </tfoot>
</table>
@include('parts.backend.delete')
@endsection
    
@section('script')
    <script>
        let table = new DataTable('#datatable', {
            ajax: '{{ route('admin.teacher.data') }}', //gọi vào API BackEnd để lấy dữ liệu
            processing: true,
            serverSide: true,
            "columns": [ //Tên cột theo tên trường dữ liệu lấy từ BackEnd
                { "data": "image" },
                { "data": "name" }, 
                { "data": "exp" },
                { "data": "created_at" },
                { "data": "edit" },
                { "data": "delete" },
                ]  
            });
    </script>
@endsection