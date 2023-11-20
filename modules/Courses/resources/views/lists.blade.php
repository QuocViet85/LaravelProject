@extends('layouts.backend')

@section('content')
<p><a href="{{ route('admin.courses.create') }}" class="btn btn-primary">Thêm mới</a></p>
@if(session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif
<table id="datatable" class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Giá</th>
            <th>Trạng thái</th>
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
            ajax: '{{ route('admin.courses.data') }}', //gọi vào API BackEnd để lấy dữ liệu
            processing: true,
            serverSide: true,
            "columns": [ //Tên cột theo tên trường dữ liệu lấy từ BackEnd
                { "data": "name" }, 
                { "data": "price" },
                { "data": "status" },
                { "data": "created_at" },
                { "data": "edit" },
                { "data": "delete" },
                { "data": "xyz"}
                ]  
            });
    </script>
@endsection