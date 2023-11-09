@extends('layouts.client')

@section('title', 'Chi tiết người dùng')
    
@section('content')
{{-- Để dùng hàm trans lấy dữ liệu file lang trong thư mục lang của module thì cần khai báo theo cú pháp: tên module như đã thiết lập trong phần khai báo lang::tên file lang --}}
    <h1>{{ __('user::custom.title', ['name' => 'Demo']) }}: {{ $id }}</h1>
@endsection