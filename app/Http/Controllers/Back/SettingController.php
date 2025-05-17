<?php

namespace App\Http\Controllers\Back;

use DB;
use App\Models\Back\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class SettingController extends Controller
{
    public function index()
    {
        //dd('ss');
        $pageNameAr = 'الإعدادات العامة';
        $pageNameEn = 'settings';
        $find = Setting::where('id', 1)->first();

        return view('back.settings.index', compact('pageNameAr', 'pageNameEn', 'find'));
    }

    public function update(Request $request)
    {
        $find = Setting::where('id', 1)->first();

        $this->validate($request , [
            'app_name' => 'required',
            'phone1' => 'required',
            'address' => 'required',
            //'cost_price' => 'required|in:1,2',
            'logo' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:1500',
            'fav_icon' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:1500',
        ],[
            'app_name.required' => 'اسم البرنامج مطلوب',
            'phone1.required' => 'رقم التلفون الأول مطلوب',
            'address.required' => 'العنوان مطلوب',
            'logo.max' => 'صورة لوحة التحكم حجمها أكبر من :max بيكسل.',
            'cost_price.required' =>  'العنوان طريقه حساب التكلفة',
            'cost_price.in' => 'طريقه حساب التكلفة يجب أن تكون 1 أو 2.',
            'logo.mimes' => 'صورة لوحة التحكم يجب أن تكون من نوع JPG أو PNG أو JPEG أو GIF.',
            'fav_icon.max' => ':attribute حجمها أكبر من :max بيكسل.',
            'fav_icon.mimes' => ':attribute يجب أن تكون من نوع JPG أو PNG أو JPEG أو GIF.',
        ]);


        if(request()->hasFile('logo')){
            File::delete(public_path('back/images/settings/'.$find['logo']));

            $file = request('logo_dashboard');
            $logo = 'logo' . '.' .$file->getClientOriginalExtension();
            $path = public_path('back/images/settings');
            $file->move($path , $logo);

        }else{
            $logo = request('logo_hidden');
        }

        if(request()->hasFile('fav_icon')){
            File::delete(public_path('back/images/settings/'.$find['fav_icon']));

            $file = request('fav_icon');
            $fav_icon = 'fav_icon' . '.' .$file->getClientOriginalExtension();
            $path = public_path('back/images/settings');
            $file->move($path , $fav_icon);

        }else{
            $fav_icon = request('fav_icon_hidden');
        }

        $data = [
            'app_name' => request('app_name'),
            'description' => request('description'),
            'footer_text' => request('footer_text'),
            'address' => request('address'),
            'email' => request('email'),
            'phone1' => request('phone1'),
            'phone2' => request('phone2'),
            'policy' => request('policy'),
            'cost_price' => request('cost_price'),
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
            'maintenance_mode' => request('maintenance_mode') == null ? 0 : 1,
        ];

        $find->update($data);
    }





    ///////////////////////////////////////////////  datatable  /////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function datatable()
    {
        $all = Setting::all();
        return DataTables::of($all)
        ->addColumn('app_name', function($res){
            return "
                <div style='padding:2px;'>
                    <i class='fas fa-globe'></i>
                    <span style='margin: 0px 5px;'>"
                        .$res->app_name.
                    "</span>
                </div>
            ";
        })
        ->addColumn('description', function($res){
            return "
                <div style='padding:2px;'>
                    <i class='fas fa-globe'></i>
                    <span style='margin: 0px 5px;'>"
                        .$res->description.
                    "</span>
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
            //if (userPermissions()->settings_update == 1){
            //}
            return '
            <button type="button" class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                <i class="fas fa-marker"></i>
            </button>';
        })
        ->rawColumns(['app_name', 'description', 'phone', 'address', 'action'])
        ->make(true);
    }
}