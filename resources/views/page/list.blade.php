@extends('layouts.app')
@section('title', '投稿画面')
@section('content')
<div class="container">
  <nav class="d-flex justify-content-end align-items-center mb-4">
    <div class="w-50">
      <a class="btn btn-success" href="{{ route('regist') }}" role="button">新規登録</a>
    </div>
    <div class="w-50">
      <form class="d-flex" action="{{ route('searchPost') }}" method="POST">
        @csrf
        <input class="form-control w-25 justify-content-ceneter me-4" type="text" placeholder="商品名で検索" name="name_search">
        <select class="w-50 me-4 form-select" name="company_id_search" id="">
          <option value="null">選択していません</option>
          @foreach ($companies as $company)
          <option value="{{ $company->id }}">{{ $company->company_name }}</option>
          @endforeach
        </select>
        <button class="btn btn-primary" type="submit">検索</button>
      </form>
    </div>
  </nav>
  @if (session('massage'))
  <div class="alert alert-danger">
  {{ session('massage') }}
  </div>
  @endif
  {{ $products->links() }}
  <div class="row">
    <table class="table table-striped text-center table-bordered">
      <thead>
        <tr>
          <th scope="col ">ID</th>
          <th scope="col">商品名</th>
          <th scope="col">商品画像</th>
          <th scope="col">商品価格</th>
          <th scope="col">在庫</th>
          <th scope="col">メーカー</th>
          <th scope="col">詳細</th>
          <th scope="col">削除</th>
        </tr>
      </thead>
      <tbody >
        @if ($products->count() === 0)
          <tr>
            <td colspan="8" class="text-center">商品が登録されていません</td>
          </tr>
        @else
        @foreach ($products as $product)
          <tr>
            <td class="align-middle table-striped">{{ $product->id }}</td>
            <td class="align-middle table-striped">{{ $product->name }}</td>
            
            <td class="align-middle table-striped">
              @if($product->img_path === '')
              <p class="mt-5 mb-5">※未登録</p>
              @else
              <img src="{{ asset($product->img_path) }}" alt="" width="100px" height="100px">
              @endif
            </td>
            
            <td class="align-middle table-striped">¥{{ $product->price }}</td>
            <td class="align-middle table-striped">{{ $product->stock }}</td>
            <td class="align-middle table-striped">{{ $product->company->company_name }}</td>
            <td class="align-middle table-striped">
              <a href="{{ route('product.show', $product->id) }}" class="btn btn-warning ">詳細</a>
            </td>
            <td class="align-middle table-striped">
              <form method="POST" action="{{ route('product.destroy', ['id' => $product->id]) }}">
                @csrf
                <button type="submit" class="btn btn-danger">削除</button>
              </form>
            </td>
          </tr>
        @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection

