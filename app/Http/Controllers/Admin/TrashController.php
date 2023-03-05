<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Member;

class TrashController extends Controller
{
    public function index(){
        $data['category'] = Category::where('is_deleted', 1)->get();
        $data['product'] = Product::where('is_deleted', 1)->get();
        $data['member'] = Member::where('is_deleted', 1)->get();
        return view('admin/trash', $data);
    }

    public function recoverTrashCategory(Request $request){
        $ids = json_decode($request->id);
        foreach($ids as $id){
            Category::where('id', $id)->update([
                'is_deleted' => 0,
            ]);
        }
        echo "success";
    }

    public function destroyTrashCategory(Request $request){
        $ids = json_decode($request->id);
        if(is_array($ids)){
            foreach($ids as $id){
                Category::where('id', $id)->delete();
            }
        }else{
            Category::where('id', $request->id)->delete();
        }
        echo "success";
    }

    public function recoverTrashProduct(Request $request){
        $ids = json_decode($request->id);
        foreach($ids as $id){
            Product::where('id', $id)->update([
                'is_deleted' => 0,
            ]);
        }
        echo "success";
    }

    public function destroyTrashProduct(Request $request){
        $ids = json_decode($request->id);
        if(is_array($ids)){
            foreach($ids as $id){
                Product::where('id', $id)->delete();
            }
        }else{
            Product::where('id', $request->id)->delete();
        }
        echo "success";
    }

    public function recoverTrashMember(Request $request){
        $ids = json_decode($request->id);
        foreach($ids as $id){
            Member::where('id', $id)->update([
                'is_deleted' => 0,
            ]);
        }
        echo "success";
    }

    public function destroyTrashMember(Request $request){
        $ids = json_decode($request->id);
        if(is_array($ids)){
            foreach($ids as $id){
                Member::where('id', $id)->delete();
            }
        }else{
            Member::where('id', $request->id)->delete();
        }
        echo "success";
    }
}
