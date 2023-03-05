<?php

namespace App\Http\Controllers\Admin;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\EditProductRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductImageGallery;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use \Toastr;
use DB;
use URL;
// use Excel;

class ProductController extends Controller
{
    public function index(){
        $data['product'] = Product::where('is_deleted', 0)->get();
        return view('admin/product', $data);
    }

    public function indexAddProduct(){
        $data['category'] = Category::where('parent_id', null)->where('is_deleted', 0)->get();
        $data['sub_category'] = Category::where('parent_id', '!=', null)->where('is_deleted', 0)->get();
        return view('admin/add-product', $data);
    }

    public function storeProduct(Request $request){
        $valid = Validator::make($request->all(),[
            'name' => 'required | string | unique:tbl_product',
            'sku' => 'required | string | unique:tbl_product',
            'category' => 'required',
            'sub_category' => 'required',
            'image' => 'required',
        ]);
        if(!$valid->passes()){
            return response()->json([
                'status' => 'error',
                'error' => $valid->errors()->toArray()
            ]);
        }else{
            $product = new Product();
            $product->sku = $request->sku;
            $product->name = $request->name;
            $product->category = $request->category;
            $product->sub_category = $request->sub_category;
            $product->size = $request->size;
            $product->size_unit = $request->size_unit;
            $product->color = $request->color;
            $product->material_grade = $request->material_grade;
            $product->weight = $request->weight;
            $product->weight_unit = $request->weight_unit;
            $product->ctn_length = $request->ctn_length;
            $product->ctn_height = $request->ctn_height;
            $product->ctn_width = $request->ctn_width;
            $product->cbm_ctn = (($request->ctn_length * $request->ctn_height * $request->ctn_width) / 1000000);
            $product->quantity_ctn = ($request->inner_pack_qty * $request->mid_pack_qty * $request->big_pack_qty);
            $product->quantity_unit = "pcs/ctn";
            $product->g_w = $request->g_w;
            $product->moq = $request->moq;
            $product->moq_unit = $request->moq_unit;
            $product->hs_code = $request->hs_code;
            $product->moq_unit = $request->moq_unit;
            $product->inner_pack_qty = $request->inner_pack_qty;
            $product->inner_pack_unit = $request->inner_pack_unit;
            $product->mid_pack_qty = $request->mid_pack_qty;
            $product->mid_pack_unit = $request->mid_pack_unit;
            $product->big_pack_qty = $request->big_pack_qty;
            $product->big_pack_unit = $request->big_pack_unit;
            $product->description = $request->description;
            $product->product_authorize = $request->product_authorize;
            $product->price = $request->price;
            $product->price_term = $request->price_term;
            $product->currency = $request->currency;
            $product->price_per_unit = $request->price_per_unit;
            $product->price_per_quantity = $request->price_per_quantity;
            $product->price_quantity_unit = $request->price_quantity_unit;
            $product->created_at = Carbon::now()->timestamp;
            $product->save();

            
            if($files = $request->file('image')){
                foreach($files as $file){
                    $image_name =  rand(11111, 99999);
                    $extension = strtolower($file->getClientOriginalExtension());
                    $fullName = $image_name.'.'.$extension;
                    $filePath = $fullName;
                    $file->move('products',$filePath);
                    $image = new ProductImageGallery();
                    $image->product_id = $product->id;
                    $image->image = $fullName;
                    $image->created_at = Carbon::now()->timestamp;
                    $image->save();
                }
            }
            return response()->json([
                'status' => "success",
                'id' => $product->id,
            ]);
        }
    }

    public function indexEditProduct($id){
        $data['category'] = Category::where('parent_id', null)->where('is_deleted', 0)->get();
        $cat_id = Category::join('tbl_product', 'tbl_category.id','tbl_product.sub_category')
                            ->where('tbl_category.is_deleted', 0)
                            ->where('tbl_product.id', $id)
                            ->first(['tbl_category.parent_id']);
        $data['sub_category'] = Category::where('parent_id', $cat_id->parent_id)
                                        ->where('is_deleted', 0)
                                        ->get();
        $data['product'] = Product::where('id', $id)->first();
        return view('admin/edit-product', $data);
    }

    public function updateProduct(EditProductRequest $request){
        DB::beginTransaction();
        try{
            if($request->has('image')){
                Product::where('id', $request->id)->update([
                    'sku' => $request->sku,
                    'name' => $request->name,
                    'category' => $request->category,
                    'sub_category' => $request->sub_category,
                    'size' => $request->size,
                    'size_unit' => $request->size_unit,
                    'color' => $request->color,
                    'material_grade' => $request->material_grade,
                    'weight' => $request->weight,
                    'weight_unit' => $request->weight_unit,
                    'ctn_length' => $request->ctn_length,
                    'ctn_height' => $request->ctn_height,
                    'ctn_width' => $request->ctn_width,
                    'cbm_ctn' => (($request->ctn_length * $request->ctn_height * $request->ctn_width) / 1000000),
                    'quantity_ctn' => ($request->inner_pack_qty * $request->mid_pack_qty * $request->big_pack_qty),
                    'quantity_unit' => "pcs/ctn",
                    'g_w' => $request->g_w,
                    'moq' => $request->moq,
                    'moq_unit' => $request->moq_unit,
                    'hs_code' => $request->hs_code,
                    'moq_unit' => $request->moq_unit,
                    'inner_pack_qty' => $request->inner_pack_qty,
                    'inner_pack_unit' => $request->inner_pack_unit,
                    'mid_pack_qty' => $request->mid_pack_qty,
                    'mid_pack_unit' => $request->mid_pack_unit,
                    'big_pack_qty' => $request->big_pack_qty,
                    'big_pack_unit' => $request->big_pack_unit,
                    'description' => $request->description,
                    'product_authorize' => $request->product_authorize,
                    'price' => $request->price,
                    "price_term" => $request->price_term,
                    "currency" => $request->currency,
                    "price_per_unit" => $request->price_per_unit,
                    "price_per_quantity" => $request->price_per_quantity,
                    "price_quantity_unit" => $request->price_quantity_unit
                ]);

                if($files = $request->file('image')){
                    foreach($files as $file){
                        $image_name =  rand(11111, 99999);
                        $extension = strtolower($file->getClientOriginalExtension());
                        $fullName = $image_name.'.'.$extension;
                        $filePath = $fullName;
                        $file->move('products',$filePath);
                        $image = new ProductImageGallery();
                        $image->product_id = $request->id;
                        $image->image = $fullName;
                        $image->save();
                    }
                }
                DB::commit();
                Toastr::info('Product updated.','', ["positionClass" => "toast-top-right"]);
                return redirect('admin/product');
            }else{
                Product::where('id', $request->id)->update([
                    'sku' => $request->sku,
                    'name' => $request->name,
                    'category' => $request->category,
                    'sub_category' => $request->sub_category,
                    'size' => $request->size,
                    'size_unit' => $request->size_unit,
                    'color' => $request->color,
                    'material_grade' => $request->material_grade,
                    'weight' => $request->weight,
                    'weight_unit' => $request->weight_unit,
                    'ctn_length' => $request->ctn_length,
                    'ctn_height' => $request->ctn_height,
                    'ctn_width' => $request->ctn_width,
                    'cbm_ctn' => $request->ctn_length * $request->ctn_height * $request->ctn_width / 1000000,
                    'quantity_ctn' => ($request->inner_pack_qty * $request->mid_pack_qty * $request->big_pack_qty),
                    'quantity_unit' => "pcs/ctn",
                    'g_w' => $request->g_w,
                    'moq' => $request->moq,
                    'moq_unit' => $request->moq_unit,
                    'hs_code' => $request->hs_code,
                    'moq_unit' => $request->moq_unit,
                    'inner_pack_qty' => $request->inner_pack_qty,
                    'inner_pack_unit' => $request->inner_pack_unit,
                    'mid_pack_qty' => $request->mid_pack_qty,
                    'mid_pack_unit' => $request->mid_pack_unit,
                    'big_pack_qty' => $request->big_pack_qty,
                    'big_pack_unit' => $request->big_pack_unit,
                    'description' => $request->description,
                    'product_authorize' => $request->product_authorize,
                    'price' => $request->price,
                    "price_per_quantity" => $request->price_per_quantity,
                    "price_quantity_unit" => $request->price_quantity_unit
                ]);
                DB::commit();
                Toastr::info('Product updated.','', ["positionClass" => "toast-top-right"]);
                return redirect('admin/product');
            }
        }catch(\Exception $e){
            DB::rollback();
            return $e;
        }
    }

    public function destroyProduct(Request $request){
        $ids = json_decode($request->id);
        foreach($ids as $id){
            Product::where('id', $id)->update([
                'is_deleted' => 1
            ]);
        }
        echo "success";
    }

    public function productImageGalleryDelete(Request $request){
        DB::beginTransaction();
        try{
            $image = ProductImageGallery::where('id', $request->id)->first();
            if($image){
                $imageDelete = ProductImageGallery::where("id", $image->id)->delete();
                unlink("products/".$image->image);
                DB::commit();
            }
                $allImage = ProductImageGallery::where('product_id',$request->product_id)->get();
                $html = '';
                foreach($allImage as $data){
                    $onclick = "galleryImageDelete($data->id,$data->product_id)";
                    $img_link= url('products/'.$data->image);
                    $file_type = mime_content_type('products/'.$data->image);
                    $file_ext = explode('/', $file_type)[1];
                    if($file_ext == 'mp4'){
                        $video_link = URL::asset('products/'.$data->image);
                        $html .= '<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                    <div class="img-wrapper">
                                        <video height="111px" controls>
                                            <source src="'.$video_link.'" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <div class="img-overlay">
                                            <a href="javascript:void(0)" onclick="'.$onclick.'"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>';
                    }else{
                        $html .='<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                                    <div class="img-wrapper img-edit">
                                        <img src="'.$img_link.'" class="img-responsive">
                                        <div class="img-overlay">
                                            <a href="javascript:void(0)" onclick="'.$onclick.'"><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>';
                    }
                echo $html;
            }
        } catch(\Exception $e){
            DB::rollback();
            return $e;
        }
        
    }

    public function productAuthorizeChange(Request $request){
        $ids = json_decode($request->id);
        foreach($ids as $id){
            Product::where('id', $id)->update([
                'product_authorize' => $request->val,
            ]);
        }
        echo "success";
    }

    public function productClickChange($id){
        try{
            Product::where('id', $id)->update([
                'click' => 0
            ]);
            echo "success";
        } catch( \Exception $e){
            DB::rollback();
            return $e;
        }
    }

    public function getSubCategoryValue(Request $request){
        $data = Category::where('is_deleted', 0)->where('parent_id', '=', $request->id)->orderBy('id', 'ASC')->get();
        $html = '';
        $html .= '<label for="validationCustom01" class="form-label">Sub Category</label>
                    <select class="form-select" id="validationDefault04" name="sub_category">';
                    if(isset($data)){
                        $html .= '<option value="" selected>Select sub category</option>';
                        foreach($data as $sub_cat){
                            $html .= '<option value="'. $sub_cat->id .'">'. $sub_cat->category_name .'</option>';
                        }
                    }else{
                        $html .='<option value="0">not available</option>';
                    }
                    $html .= '</select>';
        echo $html;
    }

    public function productExport(Request $request){
        $category = Category::get();
        $product = Product::leftJoin('tbl_product_image_gallery', 'tbl_product.id', 'tbl_product_image_gallery.product_id')
                            ->groupBy('tbl_product.id')->get(['tbl_product.*', 'tbl_product_image_gallery.image']);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Image');
        $sheet->setCellValue('D1', 'Category');
        $sheet->setCellValue('E1', 'Sub Category');
        $sheet->setCellValue('F1', 'Price');
        $sheet->setCellValue('G1', 'Size');
        $sheet->setCellValue('H1', 'Size Unit');
        $sheet->setCellValue('I1', 'Color');
        $sheet->setCellValue('J1', 'Material');
        $sheet->setCellValue('K1', 'Weight');
        $sheet->setCellValue('L1', 'Weight Unit');
        $sheet->setCellValue('M1', 'CTN/CBM');
        $sheet->setCellValue('N1', 'Moq');
        $sheet->setCellValue('N1', 'HS Code');
        $rows = 2;

        foreach($product as $data){
            foreach($category as $cat){
                if($cat->id == $data->category){
                    $category_name = $cat->category_name;
                }
                if($cat->id == $data->sub_category){
                    $sub_category = $cat->category_name;
                }
            }
            $sheet->setCellValue('A' . $rows, $data['sku']);
            $sheet->setCellValue('B' . $rows, $data['name']);
            if($data->image != null){
                if(file_exists('./products/'.$data->image)){
                    $objDrawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                    $objDrawing->setPath('./products/'.$data->image);
                    $objDrawing->setCoordinates('C'.$rows);
                    $objDrawing->setHeight(30);
                    $objDrawing->setOffsetX(7);
                    $objDrawing->setWorksheet($spreadsheet->getActiveSheet());
                    $spreadsheet->getActiveSheet()->getRowDimension($rows)->setRowHeight(30);
                }
            }else{
                $sheet->setCellValue('C'.$rows, '');
            }
            $sheet->setCellValue('D' . $rows, $category_name);
            $sheet->setCellValue('E' . $rows, $sub_category);
            $sheet->setCellValue('F' . $rows, $data['price']);
            $sheet->setCellValue('G' . $rows, $data['size']);
            $sheet->setCellValue('H' . $rows, $data['size_unit']);
            $sheet->setCellValue('I' . $rows, $data['color']);
            $sheet->setCellValue('J' . $rows, $data['material_grade']);
            $sheet->setCellValue('K' . $rows, $data['weight']);
            $sheet->setCellValue('L' . $rows, $data['weight_unit']);
            $sheet->setCellValue('M' . $rows, $data['cbm_ctn']);
            $sheet->setCellValue('N' . $rows, $data['moq']);
            $sheet->setCellValue('N' . $rows, $data['hs_code']);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
        $filename = "Product" . '-' . date('c') . '.Xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.urldecode($filename).'"');
        $writer->save('php://output');
    }

    // public function showAllToLevelC(Request $request){
    //     Product::where('product_authorize', 'all')->update(['product_authorize' => 'specific']);
    //     echo "success";
    // }

    public function showAllToLevelC(Request $request){
        $data['product'] = Product::where('product_authorize', 'specific')->where('is_deleted', 0)->get();
        return view('admin/show-all-level-c-product', $data);
    }

    public function batchUpload(Request $request){
        $valid = Validator::make($request->all(),[
            'excel_file' => 'required | mimes:xlsx',
        ]);
        if(!$valid->passes()){
            Toastr::info('Failed, only xlsx file required.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/product');
        }else{
            $path = $request->file('excel_file')->getRealPath();
            $data = Excel::toArray(new ProductImport, $path);
            array_splice($data[0], 0, 1);
            foreach($data[0] as $val){
                $category_id = Category::where('category_name', $val[2])->first(['id']);
                $sub_category_id = Category::where('category_name', $val[3])->first(['id']);
                $product_name = Product::where('name', $val[1])->first(['id']);
                if($product_name == null && $category_id != null && $sub_category_id != null){
                    $product = new Product();
                    $product->sku = $val[0];
                    $product->name = $val[1];
                    $product->category = $category_id->id;
                    $product->sub_category = $sub_category_id->id;
                    $product->price_term = $val[4];
                    $product->currency = $val[5];
                    $product->price = $val[6];
                    $product->price_per_unit = $val[7];
                    $product->size = $val[8];
                    $product->size_unit = $val[9];
                    $product->color = $val[10];
                    $product->material_grade = $val[11];
                    $product->weight = $val[12];
                    $product->weight_unit = $val[13];
                    $product->inner_pack_qty = $val[14];
                    $product->inner_pack_unit = $val[15];
                    $product->mid_pack_qty = $val[16];
                    $product->mid_pack_unit = $val[17];
                    $product->big_pack_qty = $val[18];
                    $product->big_pack_unit = $val[19];
                    $product->ctn_length = $val[20];
                    $product->ctn_height = $val[21];
                    $product->ctn_width = $val[22];
                    $product->cbm_ctn = (($val[20] * $val[21] * $val[22]) / 1000000);
                    $product->quantity_ctn = ($val[14] * $val[16] * $val[18]);
                    $product->quantity_unit = "pcs/ctn";
                    $product->g_w = $val[23];
                    $product->moq = $val[24];
                    $product->moq_unit = $val[25];
                    $product->hs_code = $val[26];
                    $product->description = $val[27];
                    $product->product_authorize = "all";
                    $product->created_at = Carbon::now()->timestamp;
                    $product->save();
                }
                // print_r($product_name->id);exit;
            }
            Toastr::info('Success.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/product');
        }
    }
}
