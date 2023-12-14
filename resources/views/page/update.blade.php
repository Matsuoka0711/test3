@extends('layouts.app')

@section('content')
<div class="container">
<a class="btn btn-secondary mb-3" href="{{ route('product.show', $product->id) }}" role="button">戻る</a>

<form method="post" action="{{route('product.update', ['id' => $product->id])}}" enctype="multipart/form-data">
    @csrf
  <table class="table table-striped text-center table-bordered">
    <tr>
        <th class="p-4 align-middle w-25">ID</th>
        <td class="p-4 text-sm-start">{{ $product->id }}</td>
    </tr>
    <tr>
        <th class="p-3 align-middle w-25">商品名</th>
        <td class="p-3 text-sm-start">
            <input type="text" value="{{ $product->name }}" name="name" class="form-control">
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="p-3 align-middle w-25">商品画像</th>
        <td class="p-3 text-sm-start d-flex align-middle">
            <div class="w-50 d-flex align-items-center me-5">
                <input type="file" class="form-control" name="img_path" accept="image/jpeg, image/png, image/jpg, image/gif">
            </div>
            <div class="text-center">
                @if($product->img_path === '')
                <p class="mt-5 mb-5">※未登録</p>
                @else
                <img src="{{ asset($product->img_path) }}" alt="" width="100px" height="100px">
                @endif
                <p class="m-0 mt-3">変更前</p>
            </div>
        </td>
    </tr>
    <tr>
        <th class="p-3 align-middle">商品価格</th>
        <td class="p-3 text-sm-start">
            <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control">
            @error('price')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="p-3 align-middle">在庫数</th>
        <td class="p-3 text-sm-start">
            <input type="text" name="stock" id="stock" value="{{ $product->stock }}" class="form-control">
            @error('stock')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
    </tr>
    <tr>
        <th class="p-3 align-middle">メーカー名</th>
        <td class="p-3 text-sm-start">
            <select class="p-2 w-100 form-select" name="company_id">
                <option value="{{ $product->company_id }}">{{ $product->company->company_name }}</option>
                @foreach($companies as $company)
                @if($product->company->company_name !== $company->company_name)
                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                @endif
                @endforeach
                @error('company_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            </select>
        </td>
      </tr>
      <tr>
        <th class="p-3 align-middle">コメント</th>
        <td class="p-3 text-sm-start">
            <textarea type="text" name="comment" id="comment" class="form-control">{{ $product->comment }}</textarea>
            @error('comment')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </td>
      </tr>
    </table>
    <button type="submit" class="btn btn-primary">更新</button>
</form>
@endsection
