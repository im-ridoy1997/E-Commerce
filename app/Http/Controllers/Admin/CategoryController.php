<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use \Toastr;
use App\Http\Requests\CategoryRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $data = Category::where('is_deleted', 0)->where('parent_id', '=', null)->orderBy('id', 'DESC')->get();
        return view('admin/category', ['data' => $data]);
    }

    public function indexAddCategory(){
        return view('admin/add-category');
    }

    public function storeCategory(Request $request){
        $valid = Validator::make($request->all(),[
            'category_name' => 'required | string | unique:tbl_category',
            'cat_sku' => 'required'
        ]);
        if(!$valid->passes()){
            return response()->json([
                'status' => 'error',
                'error' => $valid->errors()->toArray()
            ]);
        }else{
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->cat_sku = $request->cat_sku;
            $category->category_authorize = $request->category_authorize;
            $category->created_at = Carbon::now()->timestamp;
            $category->save();
            return response()->json([
                'status' => "success",
            ]);
        }
    }

    public function indexEditCategory($id){
        $data['category']= Category::where('id', $id)->first();
        return view('admin/edit-category',$data);
    }

    public function updateCategory(Request $request){
        try{
            Category::where('id', $request->id)->update([
                'category_name' => $request->category_name,
                'cat_sku' => $request->cat_sku,
                'category_authorize' => $request->category_authorize,
            ]);
            Toastr::info('Category Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/category');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function destroyCategory($id){
        Category::where('id', $id)->update([
            'is_deleted' => 1
        ]);
        Category::where('parent_id', $id)->update([
            'is_deleted' => 1
        ]);
        Product::where('category', $id)->update([
            'is_deleted' => 1
        ]);
        Toastr::info('Category deleted.','', ["positionClass" => "toast-top-right"]);
        return redirect('admin/category');
    }



    //----- Admin Sub-Category -----

    public function indexSubCategory($id){
        $data['sub_category']= Category::where('parent_id', $id)->where('is_deleted', 0)->get();
        $data['id'] = $id;
        $main_category = Category::where('id', $id)->select('category_name')->first();
        $data['main_category'] = $main_category->category_name;
        return view('admin/sub-category', $data);
    }

    public function indexAddSubCategory($id){
        $data['category']= Category::where('id', $id)->first();
        $data['id'] = $id;
        return view('admin/add-sub-category', $data);
    }

    public function storeSubCategory(Request $request){
        try{
            $valid = Validator::make($request->all(),[
                'category_name' => 'required | string | unique:tbl_category',
                'cat_sku' => 'required'
            ]);
            if(!$valid->passes()){
                return response()->json([
                    'status' => 'error',
                    'error' => $valid->errors()->toArray()
                ]);
            }else{
                $category = new Category();
                $category->parent_id = $request->id;
                $category->category_name = $request->input('category_name');
                $category->cat_sku = $request->input('cat_sku');
                $category->category_authorize = $request->category_authorize;
                $category->is_deleted = 0;
                $category->created_at = Carbon::now()->timestamp;
                $category->save();
                return response()->json([
                    'status' => "success",
                    'id' => $request->id
                ]);
            }
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexEditSubCategory($id){
        $data['sub_category']= Category::where('id', $id)->first();
        $data['id'] = $id;
        $main_category = Category::where('id', $id)->select('parent_id')->first();
        $data['parent_id'] = $main_category->parent_id;
        return view('admin/edit-sub-category', $data);
    }

    public function updateSubCategory(Request $request){
        try{
            Category::where('id', $request->id)->update([
                'category_name' => $request->category_name,
                'cat_sku' => $request->cat_sku,
                'category_authorize' => $request->category_authorize,
            ]);
            Toastr::info('Sub-Category Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect()->to('admin/sub-category/'.$request->parent_id);
        }catch(\Exception $e){
            return $e;
        }
    }

    public function destroySubCategory($id, $parent_id){
        Category::where('id', $id)->update([
            'is_deleted' => 1
        ]);
        Product::where('sub_category', $id)->update([
            'is_deleted' => 1
        ]);
        Toastr::info('Sub-Category deleted.','', ["positionClass" => "toast-top-right"]);
        return redirect()->to('admin/sub-category/'.$parent_id);
    }
}
