@extends('layouts.backend')

@section('content')
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb3">
                    <label for="">Tên</label>
                    <input type="text" name="name" class="form-control title @error('name') is-invalid @enderror" placeholder="Tên..." value="{{ old('name') }}">
                    <div class="invalid-feedback">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Slug</label>
                    <input type="text" name="slug" class="form-control slug @error('slug') is-invalid @enderror" placeholder="slug..." value="{{ old('slug') }}">
                    <div class="invalid-feedback">
                        @error('slug')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Giảng viên</label>
                    <select name="teacher_id" id="" class="form-select @error('teacher_id') is-invalid @enderror">
                        <option value="0">Chọn giảng viên</option>
                        <option value="1">Quốc Việt</option>
                    </select>
                    <div class="invalid-feedback">
                        @error('teacher_id')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Mã khóa học</label>
                    <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Mã khóa học..." value="{{ old('code') }}">
                    <div class="invalid-feedback">
                        @error('code')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Giá khóa học</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Giá khóa học..." value="{{ old('price') }}">
                    <div class="invalid-feedback">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Giá khuyến mãi</label>
                    <input type="number" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" placeholder="Giá khuyến mãi..." value="{{ old('sale_price') }}">
                    <div class="invalid-feedback">
                        @error('sale_price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Tài liệu đính kèm</label>
                    <select name="is_document" id="" class="form-select @error('is_document') is-invalid @enderror">
                        <option value="0">Không</option>
                        <option value="1">Có</option>
                    </select>
                    <div class="invalid-feedback">
                        @error('is_document')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Trạng thái</label>
                    <select name="status" id="" class="form-select @error('status') is-invalid @enderror">
                        <option value="0">Chưa ra mắt</option>
                        <option value="1">Đã ra mắt</option>
                    </select>
                    <div class="invalid-feedback">
                        @error('status')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mb3">
                    <label for="">Hỗ trợ</label>
                    <textarea name="supports" class="form-control @error('sale_price') is-invalid @enderror" placeholder="Hỗ trợ..." value="{{ old('supports') }}"></textarea>
                    <div class="invalid-feedback">
                        @error('supports')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mb3">
                    <label for="">Nội dung</label>
                    <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" placeholder="Nội dung..." value="{{ old('detail') }}"></textarea>
                    <div class="invalid-feedback">
                        @error('detail')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mb3">
                    <div class="row align-items-end">
                        <div class="col-7">
                            <label for="">Ảnh đại diện</label>
                            <input type="text" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Ảnh đại diện..." value="{{ old('thumbnail') }}">
                            <div class="invalid-feedback">
                                @error('thumbnail')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary">
                                Chọn ảnh
                            </button>
                        </div>

                        <div class="col-3">
                            <img src="https://fastly.picsum.photos/id/216/536/354.jpg?hmac=xmRTiQKMpTHRf6LLxm-g8MfrMY3VhuIPhdsbdabjVbs" alt="">
                        </div>
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

@section('stylesheets')
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection