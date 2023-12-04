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
                        @if ($teachers)
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : false }}>{{ $teacher->name }}</option>
                            @endforeach
                        @endif
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
                        <option value="0" {{ old('is_document') == 0 ? 'selected' : false }}>Không</option>
                        <option value="1" {{ old('is_document') == 1 ? 'selected' : false }}>Có</option>
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
                        <option value="0" {{ old('status') == 0 ? 'selected' : false }}>Chưa ra mắt</option>
                        <option value="1" {{ old('status') == 1 ? 'selected' : false }}>Đã ra mắt</option>
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
                    <textarea name="supports" class="form-control @error('sale_price') is-invalid @enderror" placeholder="Hỗ trợ...">{{ old('supports') }}</textarea>
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
                        <textarea name="detail" class="form-control ckeditor @error('detail') is-invalid @enderror" placeholder="Nội dung...">{{ old('detail') }}</textarea>
                        <div class="invalid-feedback">
                            @error('detail')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb3">
                        <label for="">Chuyên mục</label>
                        <div class="list-categories">
                            {{ getCategoriesCheckBox($categories, old('categories')) }}
                        </div>
                        <div class="invalid-feedback d-block">
                            @error('categories')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
    
            
            <div class="col-12">
                <div class="mb3">
                    <div class="row align-items-{{ $errors->has('thumbnail') ? 'center' : 'end' }}">
                        <div class="col-7">
                            <label for="">Ảnh đại diện</label>
                            <input type="text" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="Ảnh đại diện..." value="{{ old('thumbnail') }}" id="thumbnail">
                            <div class="invalid-feedback">
                                @error('thumbnail')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="thumbnail" data-preview="holder">
                                Chọn ảnh
                            </button>
                        </div>

                        <div class="col-3" >
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                                @if(old('thumbnail'))
                                    <img src={{ old('thumbnail') }} style="height: 5rem;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
        
    </form>
@endsection

@section('stylesheets')
    <style>
        img {
            max-width: 100%;
            height: auto !important;
        }

        #holder img {
            width: 50%;
            height: 80%;
        }

        .list-categories {
            max-height: 250px;
            overflow: auto;
        }
    </style>
@endsection