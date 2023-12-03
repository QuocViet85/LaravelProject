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

            <div class="col-12">
                <div class="mb3">
                    <label for="">Số năm kinh nghiệm</label>
                    <input type="number" name="exp" class="form-control @error('exp') is-invalid @enderror" placeholder="Số năm kinh nghiệm..." value="{{ old('exp') }}">
                    <div class="invalid-feedback">
                        @error('exp')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mb3">
                    <label for="">Mô tả</label>
                    <textarea name="description" class="form-control ckeditor @error('description') is-invalid @enderror" placeholder="Mô tả...">{{ old('description') }}</textarea>
                    <div class="invalid-feedback">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="mb3">
                    <div class="row align-items-{{ $errors->has('image') ? 'center' : 'end' }}">
                        <div class="col-7">
                            <label for="">Hình ảnh</label>
                            <input type="text" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Hình ảnh..." value="{{ old('image') }}" id="image">
                            <div class="invalid-feedback">
                                @error('image')
                                {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="col-2 d-grid">
                            <button type="button" class="btn btn-primary" id="lfm" data-input="image" data-preview="holder">
                                Chọn ảnh
                            </button>
                        </div>

                        <div class="col-3" >
                            <div id="holder" style="margin-top:15px;max-height:100px;">
                                @if(old('image'))
                                    <img src={{ old('image') }} style="height: 5rem;">
                                @endif
                            </div>
                        </div>
            
            <div class="col-12">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                    <a href="{{ route('admin.teacher.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
        
    </form>
@endsection