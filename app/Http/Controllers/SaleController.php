<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function sale(Request $request){
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // 商品を取得
        $product = Product::find($productId);

        // 在庫より購入数が多かったら・・
        if ($product->stock < $quantity) {
            return response()->json(['message' => '在庫がありません']);
        }

        // Productテーブルの在庫数を調整
        $product->stock = $product->stock - $quantity;
        $product->save();

        // saleテーブルに記録
        $sale = new Sale([
            'product_id' => $productId,
            'quantity' => $quantity,
        ]);

        $sale->save();
    
        return response()->json(['message' => '購入成功']);

    }
}
