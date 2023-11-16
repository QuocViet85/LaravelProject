@extends('layouts.backend')

@section('content')
@if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
@endif
    <form action="" method="POST">
        <div class="row">
            <div class="col-6">
                <div class="mb3">
                    <label for="">Tên</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Tên..." value="{{ old('name') ?? $category->name}}">
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
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug..." value="{{ old('slug') ?? $category->slug }}">
                    <div class="invalid-feedback">
                        @error('slug')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="mb3">
                    <label for="">Cha</label>
                    <select name="parent_id" id="" class="form-select @error('parent_id') is-invalid @enderror">
                        <option value="0">Không</option>
                    </select>
                    <div class="invalid-feedback">
                        @error('parent_id')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-danger">Hủy</a>
            </div>
        </div>
        @csrf
        @method('PUT')
    </form>
@endsection