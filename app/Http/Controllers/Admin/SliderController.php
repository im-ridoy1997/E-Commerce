<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Privacy;
use App\Models\Sitemap;
use \Toastr;
use Carbon\Carbon;

class SliderController extends Controller
{
    public function index(){
        $data['slider'] = Slider::where('is_deleted', 0)->get();
        $data['privacy'] = Privacy::first();
        $data['sitemap'] = Sitemap::get();
        return view('admin/slider', $data);
    }
    
    public function indexAddSlider(){
        return view('admin/add-slider');
    }

    public function storeSlider(Request $request){
        try{
            if($request->file('image')){
                $image_name =  rand(11111, 99999);
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $fullName = $image_name.'.'.$extension;
                $filePath = $fullName;
                $request->file('image')->move('products',$filePath);
                $image = new Slider();
                $image->image = $fullName;
                $image->created_at = Carbon::now()->timestamp;
                $image->save();
            }
            Toastr::info('Slider added.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/slider');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexEditSlider($id){
        $data['slider']= Slider::where('id', $id)->first();
        return view('admin/edit-slider',$data);
    }

    public function updateSlider(Request $request){
        try{
            if($request->file('image')){
                $image_name =  rand(11111, 99999);
                $extension = strtolower($request->file('image')->getClientOriginalExtension());
                $fullName = $image_name.'.'.$extension;
                $filePath = $fullName;
                $request->file('image')->move('products',$filePath);
                Slider::where('id', $request->id)->update([
                    'image' => $fullName
                ]);
            }
            Toastr::info('Slider Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/slider');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function destroySlider($id){
        Slider::where('id', $id)->update([
            'is_deleted' => 1
        ]);
        Toastr::info('Slider deleted.','', ["positionClass" => "toast-top-right"]);
        return redirect('admin/slider');
    }

    public function indexEditPrivacy($id){
        $data['privacy']= Privacy::where('id', $id)->first();
        return view('admin/edit-privacy', $data);
    }

    public function updatePrivacy(Request $request){
        try{
            Privacy::where('id', $request->id)->update([
                'name' => $request->name
            ]);
            Toastr::info('Privacy Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/slider');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexAddSitemap(){
        return view('admin/add-sitemap');
    }

    public function storeSitemap(Request $request){
        try{
            $sitemap = new Sitemap();
            $sitemap->link = $request->link;
            $sitemap->created_at = Carbon::now()->timestamp;
            if($sitemap->save()){
                Toastr::info('Sitemap added.','', ["positionClass" => "toast-top-right"]);
                return redirect('admin/slider');
            }
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexEditSitemap($id){
        $data['sitemap']= Sitemap::where('id', $id)->first();
        return view('admin/edit-sitemap', $data);
    }

    public function updateSitemap(Request $request){
        try{
            Sitemap::where('id', $request->id)->update([
                'link' => $request->link
            ]);
            Toastr::info('Sitemap Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/slider');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function sitemapApprove(Request $request){
        Sitemap::where('id', $request->id)->update([
            'is_deleted' => $request->val
        ]);
        echo "success";
    }
}
