@extends('layouts.app')

@section('title', '投稿画面')

@section('content')
    <div class="container">
        <a class="btn btn-secondary mb-3" href="{{ route('list') }}" role="button">戻る</a>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="row">
            <form action="{{ route('submit') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="from-group mb-4">
                    <label for="">商品名</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="商品名を入力">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="from-group mb-4">
                    <label for="">画像</label>
                    <input type="file" class="form-control" name="img_path" accept="image/jpeg, image/png, image/jpg, image/gif">
                    @error('img_path')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="from-group mb-4">
                    <label for="">価格</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="価格を入力">
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="from-group mb-4">
                    <label for="">在庫</label>
                    <input type="text" class="form-control" id="stock" name="stock" placeholder="在庫を入力">
                    @error('stock')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="from-group mb-4">
                    <label for="">メーカー名</label>
                    <select class="p-2 w-100 form-select" name="company_id">
                        <option selected>選択してください</option> 
                        @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name }}</option> 
                        <!-- ③修正 -->
                        @endforeach
                    </select>
                    @error('company_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="from-group mb-4">
                    <label for="">コメント</label>
                    <textarea type="text" class="form-control" id="comment" name="comment" placeholder="コメントを入力"></textarea>
                    @error('comment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">送信</button>
            </form>
        </div>
    </div>
@endsection
