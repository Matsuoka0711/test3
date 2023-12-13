<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Carbon\Carbon;

class ProductController extends Controller
{
    // regist(view)へ推移
    public function showRegistForm() {
        $companies = Company::get();

        return view('page.regist', [
            'companies' => $companies,
        ]);
    }

    // list(view)へ推移
    public function showList() {
        $products = Product::with('company')->paginate(4);

        return view('page.list', [
            'products' => $products,
        ]);
    }

    // show(view)へ推移
    public function show($id) 
    {
        $product = Product::find($id);
        
        return view('page.show', ['product' => $product,]);
    }

    // update(view)へ推移
    public function showUpdate($id)
    {
        $product = Product::find($id);
        $companies = Company::get();

        return view('page.update',[
            'product' => $product,
            'companies' => $companies,
        ]);
    }

    // 登録処理 + 画像保存
    public function registSubmit(ProductRequest $request) 
    {
        DB::beginTransaction();
        try{
            $product = new Product();
            
            if($request->img_path !== null){
                // 値が入っていた場合$file_nameに取得した画像の名前を代入
                $file_name = $request->file('img_path')->getClientOriginalName();
                
                $request->file('img_path')->storeAs('public/sample', $file_name);
                $product->img_path = 'public/sample/' . $file_name;
                $request->merge(['img_path' => 'public/sample/' . $file_name]);

            }else{
                // 値がnullの場合$file_nameはnullのまま処理を進める
                $file_name = null;
            }

            $product->registProduct($request, $file_name);
            DB::commit();

        }catch(Exception $e){
            // 例外処理
            return redirect()->route('regist')->with('massage', '登録に失敗しました');
            DB::rollBack();
        }
        return redirect()->route('regist')->with('massage', '商品を登録しました');
    }
    
    // 更新処理
    public function productUpdate(ProductRequest $request, $id)
    {  
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);

            // 変更後の画像を保存
            if($request->file('img_path') !== null){
                // 値が入っていた場合$file_nameに取得した画像の名前を代入して保存
                $file_name = 'storage/sample/' . $request->file('img_path')->getClientOriginalName();
                // dd($file_name);
                $request->file('img_path')->storeAs('public/sample', $request->file('img_path')->getClientOriginalName());

                // 登録済みの画像を削除
                \Illuminate\Support\Facades\File::delete($product->img_path);
                
            }else{
                // 画像が選択されていなかったら同じ画像で処理を実行
                $file_name = $product->img_path;
            }


            $product->updataProduct($request, $file_name, $product);
            
            DB::commit(); // ②修正済

        } catch (Exception $e) {
            return redirect()->route('list')->with('massage', '登録に失敗しました');
            DB::rollBack();
        }
        return view('page/show', compact('product')); // ②修正済
        
    }

    // 削除処理
    public function productDestroy($id)
    {
        DB::beginTransaction();

        try {
            $product = Product::find($id);
    
            $product->delete();
        
            $products = $product->getList();
            $product = $product;

            // 画像を削除
            \Illuminate\Support\Facades\File::delete($product->img_path);

        } catch (Exception $e) {
            return redirect()->route('list')->with('massage', '削除に失敗しました');
            DB::rollBack();
        }
    
        DB::commit();
        return redirect()->route('list')->with('massage', '削除しました');
    }
    
    // 検索処理
    public function searchPost(Request $request) 
    {
        $companies = Company::all();
        // dd($request->company_id_search);
        if (isset($request->name_search)) {
            $products = Product::
                where("name", "LIKE", "%$request->name_search%")
                ->orWhere('company_id', $request->company_id_search)
                ->paginate(4);
            }
        else {
            $products = Product::paginate(4);
        }

        return view('page.list', [
            'products' => $products,
            'search' => $request->search,
            'companies' => $companies,
        ]);
    }
}