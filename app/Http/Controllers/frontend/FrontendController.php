<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Rating;
use App\Models\Category;

class FrontendController extends Controller
{
    //
    public function index(){
        $featured_products = Product::where('trending','1')->take(15)->get();
        $trending_category = Category::where('popular','1')->take(15)->get();
        
        return view('frontend.index',compact('featured_products','trending_category'));
    }

    public function searchProduct(Request $request){
        if($request->search){
            $searchProduct = Product::where('name', 'LIKE' ,'%'.$request->search.'%')->latest()->paginate(15);
            return view('frontend.search',compact('searchProduct'));
        }else{
            return redirect()->back()->with('status','Empty Search');
        }
    }

    public function category(){
        $category = Category::where('status','1')->get();
        return view('frontend.category',compact('category'));
    }

    public function viewcategory($slug){
        if(Category::where('slug',$slug)->exists())
        {
            $category = Category::where('slug',$slug)->first();
            $products = Product::where('category_id',$category->id)->where('status','1')->get();
            return view('frontend.products.index',compact('category','products'));
        }
        else{
            return redirect('/')->with('status',"您所選的類別不存在");
        }
        
    }
    public function viewproduct($category_slug,$product_slug){
        if(Category::where('slug',$category_slug)->exists()){
            if(Product::where('slug',$product_slug)->exists()){
                $products = Product::where('slug',$product_slug)->first();
                $ratings = Rating::where('prod_id', $products->id)->get();
                $ratings_sum = Rating::where('prod_id', $products->id)->sum('stars_rate');
                $user_rating = Rating::where('prod_id', $products->id)->where('user_id',Auth::id())->first();
                if($ratings->count() >0 ){
                    $ratings_value = $ratings_sum/$ratings->count();
                }
                else{
                    $ratings_value = 0;
                }
                
                return view('frontend.products.view',compact('products','ratings','ratings_value','user_rating'));
                
            }
            else{
                return redirect('/')->with('status',"您所選的商品不存在或是已下架。");
            }
        }else{
            return redirect('/')->with('status',"您所選的類別不存在或是已下架。");
        }
        
    }

    public function searchProductAjax(){
        $products = Product::select('name')->where('status','1')->get();
        $data = [];

        foreach ($products as $item) {
            # code...
            $data[] = $item['name'];
        }
        return $data;
    }
}
