@extends('layouts.backend')

@section('content')
<p><a href="{{ route('admin.users.create') }}" class="btn btn-primary">Thêm mới</a></p>
@if(session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif
<table id="datatable" class="table table-bordered">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Email</th>
            <th>Nhóm</th>
            <th>Thời gian</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Tên</th>
            <th>Eamil</th>
            <th>Nhóm</th>
            <th>Thời gian</th>
            <th style="width: 5%">Sửa</th>
            <th style="width: 5%">Xóa</th>
        </tr>
    </tfoot>
</table>
@endsection
    
@section('script')
    <script>
        let table = new DataTable('#datatable', {
            ajax: '{{ route('admin.users.data') }}',
            processing: true,
            serverSide: true,
            "columns": [
                { "data": "name" },
                { "data": "email" },
                { "data": "group_id" },
                { "data": "created_at" },
                { "data": "edit" },
                { "data": "delete" },
                ]  
            });
    </script>
@endsection