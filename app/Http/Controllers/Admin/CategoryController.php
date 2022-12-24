<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;

class CategoryController extends Controller
{
    //
    public function index(){
        $category = Category::where('status','1')->paginate(5);
        return view('admin.category.index',compact('category'));
    }   

    // add page
    public function add(){
        return view('admin.category.add');
    }

    //action add category
    public function insert(Request $request){
        $category = new Category();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular')== TRUE ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descript = $request->input('meta_descript');
        $category->save();
        return redirect('admin/categories')->with('status','類別{Category} | 已增加至資料庫中。');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        if($request->hasFile('image')){
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular')== TRUE ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descript = $request->input('meta_descript');
        $category->update();
        return redirect('admin/dashboard')->with('status','類別{Category} | 已完成更新。');
    }

    public function destroy(Request $request,$id){
        $category = Category::find($id);
        if($request->hasFile('image')){
            $path = 'assets/uploads/category/'.$category->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('admin/categories')->with('status','類別{Category} | 已刪除。');
    }   
}
