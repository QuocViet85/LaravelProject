@extends('layouts.backend')

@section('content')
@if(session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb3">
                    <label for="">Tên</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên..." value="{{ old('name') ?? $user->name}}">
                    <div class="invalid-feedback">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email..." value="{{ old('email') ?? $user->email}}">
                    <div class="invalid-feedback">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Nhóm</label>
                    <select name="group_id" id="" class="form-select @error('group_id') is-invalid @enderror">
                        <option value="0">Chọn Nhóm</option>
                        <option value="1">Administrator</option>
                    </select>
                    <div class="invalid-feedback">
                        @error('group_id')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Mật khẩu</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu...">
                    <div class="invalid-feedback">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
        
    </form>
@endsection