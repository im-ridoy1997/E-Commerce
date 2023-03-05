<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\Contact;
use App\Models\About;
use App\Models\Certificate;
use App\Models\Cart;
use App\Models\Member;
use App\Models\Product;
use \Toastr;
use Carbon\Carbon;

class FaqController extends Controller
{
    public function index(){
        $data['faq'] = Faq::where('is_deleted', 0)->get();
        $data['contact'] = Contact::get();
        $data['about'] = About::first();
        $data['certificate'] = Certificate::get();
        return view('admin/faq', $data);
    }

    public function indexAddFaq(){
        return view('admin/add-faq');
    }

    public function storeFaq(Request $request){
        try{
            $faq = new Faq();
            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->created_at = Carbon::now()->timestamp;
            if($faq->save()){
                Toastr::info('Inquiry added.','', ["positionClass" => "toast-top-right"]);
                return redirect('admin/faq');
            }
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexEditFaq($id){
        $data['faq']= faq::where('id', $id)->first();
        return view('admin/edit-faq',$data);
    }

    public function updateFaq(Request $request){
        try{
            Faq::where('id', $request->id)->update([
                'question' => $request->question,
                'answer' => $request->answer,
            ]);
            Toastr::info('Inquiry Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/faq');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function destroyFaq($id){
        Faq::where('id', $id)->update([
            'is_deleted' => 1
        ]);
        Toastr::info('Inquiry deleted.','', ["positionClass" => "toast-top-right"]);
        return redirect('admin/faq');
    }

    public function indexAddContact(){
        return view('admin/add-contact');
    }

    public function storeContact(Request $request){
        try{
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->created_at = Carbon::now()->timestamp;
            if($contact->save()){
                Toastr::info('Contact added.','', ["positionClass" => "toast-top-right"]);
                return redirect('admin/faq');
            }
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexEditContact($id){
        $data['contact']= Contact::where('id', $id)->first();
        return view('admin/edit-contact',$data);
    }

    public function updateContact(Request $request){
        try{
            Contact::where('id', $request->id)->update([
                'name' => $request->name
            ]);
            Toastr::info('Contact Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/faq');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function destroyContact($id){
        Contact::where('id', $id)->update([
            'is_deleted' => 1
        ]);
        Toastr::info('Contact deleted.','', ["positionClass" => "toast-top-right"]);
        return redirect('admin/faq');
    }

    public function contactApprove(Request $request){
        Contact::where('id', $request->id)->update([
            'is_deleted' => $request->val
        ]);
        echo "success";
    }

    public function indexEditAbout($id){
        $data['about']= About::where('id', $id)->first();
        return view('admin/edit-about',$data);
    }

    public function updateAbout(Request $request){
        try{
            About::where('id', $request->id)->update([
                'text' => $request->text
            ]);
            Toastr::info('About Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/faq');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexAddCertificate(){
        return view('admin/add-certificate');
    }

    public function storeCertificate(Request $request){
        try{
            if($request->file('pdf')){
                $pdf_name =  rand(11111, 99999);
                $extension = strtolower($request->file('pdf')->getClientOriginalExtension());
                $fullName = $pdf_name.'.'.$extension;
                $filePath = $fullName;
                $certificate = new Certificate();
                $certificate->name = $request->name;
                $certificate->certificate = $request->certificate;
                $certificate->certificate_date = $request->certificate_date;
                $certificate->pdf = $fullName;
                $certificate->created_at = Carbon::now()->timestamp;
                $certificate->save();
            }
            Toastr::info('Certificate added.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/faq');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexEditCertificate($id){
        $data['certificate']= Certificate::where('id', $id)->first();
        return view('admin/edit-certificate',$data);
    }

    public function updateCertificate(Request $request){
        try{
            if($request->file('pdf')){
                $pdf_name =  rand(11111, 99999);
                $extension = strtolower($request->file('pdf')->getClientOriginalExtension());
                $fullName = $pdf_name.'.'.$extension;
                $filePath = $fullName;
                $request->file('pdf')->move('products',$filePath);
                Certificate::where('id', $request->id)->update([
                    'name' => $request->name,
                    'pdf' => $fullName,
                ]);
            }
            Toastr::info('Certificate Updated.','', ["positionClass" => "toast-top-right"]);
            return redirect('admin/faq');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function destroyCertificate($id){
        Certificate::findOrFail($id)->delete();
        Toastr::info('Certificate deleted.','', ["positionClass" => "toast-top-right"]);
        return redirect('admin/faq');
    }

    public function certificateApprove(Request $request){
        Certificate::where('id', $request->id)->update([
            'is_deleted' => $request->val
        ]);
        echo "success";
    }

    public function indexInquiryCart(){
        $data['cart']= Member::join('tbl_cart', 'tbl_member.id', 'tbl_cart.user_id')
                                ->orderBy('tbl_cart.id', 'DESC')->groupBy('tbl_cart.user_id')->get(['tbl_member.*']);
        return view('admin/inquiry-cart',$data);
    }

    public function viewCart($id){
        $data['product'] = Product::join('tbl_cart', 'tbl_product.id', 'tbl_cart.product_id')
                                    ->where('tbl_cart.user_id', $id)
                                    ->get(['tbl_product.*', 'tbl_cart.total_ctn', 'tbl_cart.requirement']);
        return view('admin/inquiry-cart-view', $data);
    }

}
