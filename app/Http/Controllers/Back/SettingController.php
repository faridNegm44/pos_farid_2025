<?php

namespace App\Http\Controllers\Back;

use DB;
use App\Models\Back\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Back\Branch;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    public function index()
    {
        $pageNameAr = 'الإعدادات';
        $pageNameEn = 'settings';
        return view('back.settings.index', compact('pageNameAr', 'pageNameEn'));
    }

    public function show($id)
    {
        $find = Setting::where('id' , $id)->first();
        return view('back.settings.show', compact('find'));
    }

    public function edit($id)
    {
        $find = Setting::where('id' , $id)->first();
        return view('back.settings.edit', compact('find'));
    }

    public function update(Request $request, $id)
    {
        $find = Setting::where('id', $id)->first();
        
        $this->validate($request , [
            'name' => 'required',
            'phone1' => 'required',
            'address' => 'required',
        ],[
            'name.required' => 'الإسم مطلوب',
            'phone1.required' => 'رقم التلفون الأول مطلوب',
            'address.required' => 'العنوان مطلوب',
        ]);

        if(request('logo') == ""){
            $logo = request("image_hidden_logo");
        }else{
            $file = request('logo');
            $logo = rand(1,100) . '.' .$file->getClientOriginalName();
            $path = public_path('back/images/settings');
            $file->move($path , $logo);
            
            File::delete(public_path('back/images/settings/'.$find['logo']));
        }
                
        if(request('fav_icon') == ""){
            $fav_icon = request("image_hidden_fav_icon");
        }else{
            $file = request('fav_icon');
            $fav_icon = rand(200,300) . '.' .$file->getClientOriginalName();
            $path = public_path('back/images/settings');
            $file->move($path , $fav_icon);
            
            File::delete(public_path('back/images/settings/'.$find['fav_icon']));
        }

        $data = [
            'branch' => request('branch'),
            'name' => request('name'),
            'description' => request('description'),
            'footer_text' => request('footer_text'),
            'address' => request('address'),
            'city' => request('city'),
            'zip_code' => request('zip_code'),
            'email' => request('email'),
            'phone1' => request('phone1'),
            'phone2' => request('phone2'),
            'logo' => $logo,
            'fav_icon' => $fav_icon,
            'mail_driver' => request('mail_driver'),
            'from' => request('from'),
            'to' => request('to'),
            'host' => request('host'),
            'port' => request('port'),
            'encryption' => request('encryption'),
            'username' => request('username'),
            'password' => request('password'),
        ];

        $find->update($data);
    }





    ///////////////////////////////////////////////  datatableSettings  /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function datatableSettings()
    {
        $all = Setting::all();
        return DataTables::of($all)
        ->addColumn('name', function($res){
            return "
                <div style='padding:2px;'>
                    <a style='color:#24ABF2;margin: 0px 5px;font-weight: bold;font-size: 15px;'>"
                        .$res->name.
                    "</a>
                </div>                    
            ";
        })
        ->addColumn('phone', function($res){
            return "
                <div style='padding:2px;'>
                    <i class='fa fa-phone'></i>
                    <span style='margin: 0px 5px;'>"
                        .$res->phone1.
                    "</span>
                </div>

                <div style='padding:2px;'>
                    <i class='fa fa-phone'></i>
                    <span style='margin: 0px 5px;'>"
                        .$res->phone2.
                    "</span>
                </div>
            ";
        })
        ->addColumn('address', function($res){
            return $res->address;
        })
        ->addColumn('logo', function($res){
            $logo ='
                <a class="spotlight" href="'.url('back/images/settings/'.$res->logo).'">
                    <img src="'.url('back/images/settings/'.$res->logo).'" style="width: 40px;height: 40px;border-radius: 5px;margin: 0px auto;display: block;">
                </a>
            ';
            return $logo;
        })
        ->addColumn('fav_icon', function($res){
            $fav_icon ='
                <a class="spotlight" href="'.url('back/images/settings/'.$res->fav_icon).'">
                    <img src="'.url('back/images/settings/'.$res->fav_icon).'" style="width: 40px;height: 40px;border-radius: 5px;margin: 0px auto;display: block;">
                </a>
            ';
            return $fav_icon;
        })
        ->addColumn('action', function($res){
            return '<a class="btn btn-outline-success btn-sm edit bt_modal" title="Edit" act="'.url('settings/edit/'.$res->id).'"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                <i class="fas fa-pencil-alt"></i>
            </a>';
        })
        ->rawColumns(['name', 'phone', 'address', 'logo', 'fav_icon', 'action'])
        ->make(true);
    }
}
