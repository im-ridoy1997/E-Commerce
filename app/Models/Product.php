<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tbl_product';

    public function image(){
        $product =  $this->hasOne(ProductImageGallery::class, 'product_id')->orderBy('id', 'ASC')->limit(1);
        if($product){
            return $product;
        }else{
            return null;
        }
    }

    public function multipleImage(){
        $product = $this->hasMany(ProductImageGallery::class, 'product_id');
        if($product){
            return $product;
        }else{
            return null;
        }
    }

    public function singleProductLeftImages(){
        $product = $this->hasMany(ProductImageGallery::class, 'product_id')->orderBy('id', 'DESC')->limit(3);
        if($product){
            return $product;
        }else{
            return null;
        }
    }

    public function singleProductMainImages(){
        $product = $this->hasMany(ProductImageGallery::class, 'product_id')->orderBy('id', 'DESC');
        if($product){
            return $product;
        }else{
            return null;
        }
    }

    public function categoryName(){
        return $this->hasOne(Category::class, 'id', 'category');
    }

    public function subCategoryName(){
        return $this->hasOne(Category::class, 'id', 'sub_category');
    }
}
