<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::all();
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
        $products->short_descripton = $request->input('short_description');
        //$products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->tax = $request->input('tax');
        $products->quantity = $request->input('quantity');
        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->trending = $request->input('trending')== TRUE ? '1':'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_description = $request->input('meta_description');
        $products->save();
        return redirect('products')->with('status','商品已增加至資料庫中。');
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
        $products->description = $request->input('description');
        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->popular = $request->input('popular')== TRUE ? '1':'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_descript = $request->input('meta_descript');
        $products->update();
        return redirect('dashboard')->with('status','商品已完成更新。');
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
        return redirect('products')->with('status','商品已刪除。');
    }   
}
