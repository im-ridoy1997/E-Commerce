<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;

class MemberController extends Controller
{
    public function index(){
        $data['member'] = Member::where('is_deleted', 0)->orderBy('id', 'DESC')->get();
        return view('admin/member', $data);
    }

    public function destroyMember($id){
        try{
            Member::where('id', $id)->update([
                'is_deleted' => 1
            ]);
            echo "success";
        } catch( \Exception $e){
            DB::rollback();
            return $e;
        }
    }

    public function memberApprove(Request $request){
        Member::where('id', $request->id)->update([
            'approve' => $request->approve,
            'approve_time' => date('Y-m-d H:i:s')
        ]);
    }

    public function memberRecord(Request $request){
        $data = Member::where('id', $request->id)->first();
        if($data->approve == 1){ 
            $status = "Approved";
        }else{ 
            $status = "not Approved";
        }
        $register_time = $data->register_time;
        $ip_address = $data->ip_address;
        $name = $data->name;
        $company_name = $data->company_name;
        $country = $data->country;
        $website = $data->website;
        $email = $data->email;
        $year = $data->year;
        $address_one = $data->address_one;
        $address_two = $data->address_two;
        $city = $data->city;
        $state = $data->state;
        $zip = $data->zip;
        $phone = $data->phone;
        $skype = $data->skype;
        $whatsapp = $data->whatsapp;
        $business = $data->business;
        $message = $data->message;
        $html = '';
        $html .= '
                <div class="card-body">
                    <div class="record">
                        <div style="display:flex;">
                            <h5>Individual Registration Record</h5>
                            <p style="margin-left: 70px; color: black;">Status:'. $status .'</p>
                        </div>
                        <div style="display:flex;">
                            <div>
                                <p style="color: black;">Registered Time: '. $register_time .'</p>
                                <p style="color: black;">Company Name: '. $company_name .'</p>
                                <p style="color: black;">Year of Establishment: '. $year .'</p>
                                <p style="color: black;">Address line 1: '. $address_one .'</p>
                                <p style="color: black;">Address line 1: '. $address_two .'</p>
                                <p style="color: black;">City: '. $city .'</p>
                                <p style="color: black;">Province/State: '. $state .'</p>
                                <p style="color: black;">Zip: '. $zip .'</p>
                                <p style="color: black;">Country: '. $country .'</p>
                                <p style="color: black;">Contact Person: '. $name .'</p>
                            </div>
                            <div style="margin-left: 70px;">
                            <p style="color: black;">Register Local IP Address: '. $ip_address .'</p>
                                <p style="color: black;">Phone: '. $phone .'</p>
                                <p style="color: black;">Website: '. $website .'</p>
                                <p style="color: black;">Skype: '. $skype .'</p>
                                <p style="color: black;">Whatsapp: '. $whatsapp .'</p>
                                <p style="color: black;">Email: '. $email .'</p>
                                <p style="color: black;">Password: .....</p>
                            </div>
                        </div>
                        <div>
                            <p style="color: black;">Company profile, main business</p>
                            <textarea row="10" style="width: 60%;">'.$business.'</textarea>
                        </div>
                        <div>
                            <p style="color: black;">Message</p>
                            <textarea row="10" style="width: 60%;">'.$message.'</textarea>
                        </div>
                    </div>
                </div>
                ';
        echo $html;
    }
}
