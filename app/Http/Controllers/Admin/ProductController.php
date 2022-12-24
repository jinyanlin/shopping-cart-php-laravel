<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::orderBy('id','ASC')->paginate(5);
        return view('admin.product.index',compact('products'));
    }
    public function add(){
        $category = Category::all();
        return view('admin.product.add',compact('category'));
    }

    //action add Product
    public function insert(Request $request){
        $products = new Product();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/product/',$filename);
            $products->image = $filename;
        }
        $products->category_id = $request->input('category_id');
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->short_description = $request->input('short_description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->tax = $request->input('tax');
        $products->quantity = $request->input('quantity');
        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->trending = $request->input('trending')== TRUE ? '1':'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->description = $request->input('description');
        $products->save();
        return redirect('admin/products')->with('status','商品{Product} | 已增加至資料庫中。');
    }

    public function edit($id){
        $products = Product::find($id);
        return view('admin.product.edit',compact('products'));
    }

    public function update(Request $request, $id){
        $products = Product::find($id);
        if($request->hasFile('image')){
            $path = 'assets/uploads/product/'.$products->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/product/',$filename);
            $products->image = $filename;
        }
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->short_description = $request->input('short_description');
        //$products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->tax = $request->input('tax');
        $products->quantity = $request->input('quantity');
        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->trending = $request->input('trending')== TRUE ? '1':'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->description = $request->input('description');
        $products->update();
        return redirect('admin/products')->with('status','商品{Product} | 已完成更新。');
    }

    public function destroy(Request $request,$id){
        $products = Product::find($id);
        if($request->hasFile('image')){
            $path = 'assets/uploads/product/'.$products->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $products->delete();
        return redirect('admin/products')->with('status','商品{Product} | 已刪除。');
    }   

    // public function delete(Request $request){
    //     if(Auth::check()){
    //         $prod_id = $request->input('prod_id');
    //         if(Product::where('id',$prod_id)->exists()){
    //             $proditem = Product::where('id',$prod_id)->first();
    //             $proditem->delete();
    //             return response()->json(['status' => "您所選的產品已被刪除成功"]);
    //         }
    //     }else{
    //         return response()->json(['status' => "你所選商品已不存在"]);
    //     }
    // }
}
