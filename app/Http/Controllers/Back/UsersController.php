<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Branch;
use App\Models\Back\PersonStatus;
use App\Models\Back\User;
use App\Models\Back\RolesPermissions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index()
    {
        $pageNameAr = 'مستخدمين النظام';
        $pageNameEn = 'users';
        // $permissions = RolesPermissions::all();
        return view('back.users.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'name' => 'required|string|max:100|unique:users,name',
                'email' => 'required|string|email|max:100|unique:users,email',
                'gender' => 'required|in:ذكر,انثي' ,
                'birth_date' => 'nullable|date' ,
                'phone' => 'nullable|numeric',
                'address' => 'nullable|string',
                'nat_id' => 'nullable|min:14|numeric|unique:users,nat_id',
                'password' => ['required', 'string', Password::min(6)], // ->mixedCase()->numbers()->symbols()
                'confirmed_password' => 'required|same:password',
                //'role' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:1500',
                'status' => 'required|in:1,0',
                'note' => 'nullable|string',
            ],[
                'required' => ':attribute مطلوب.',
                'string' => ':attribute غير صحيح.',
                'numeric' => ':attribute غير صحيح.',
                'date' => ':attribute يجب ان يكون تاريخ.',
                'email' => ':attribute البريد الإلكتروني.',
                'unique' => ':attribute مستخدم من قبل.',
                'min' => ':attribute أقل من القيمة المطلوبة.',
                'nat_id.min' => ':attribute يجب أن يكون على الأقل :min رقم.',
                'same' => ':attribute غير مطابقة مع كلمة المرور.',
                'mimes' => ':attribute يجب أن تكون من نوع JPG أو PNG أو JPEG أو GIF.',
                'max' => ':attribute كبير عن المطلوب.',
                'password.min' => ':attribute يجب أن تكون كلمة المرور على الأقل 6 أحرف.',
                'password.mixed_case' => ':attribute يجب أن تحتوي كلمة المرور على أحرف كبيرة وصغيرة.',
                'password.numbers' => ':attribute يجب أن تحتوي كلمة المرور على أرقام.',
                'password.symbols' => ':attribute يجب أن تحتوي كلمة المرور على رموز.',
            ],[
                'name' => 'إسم المستخدم',
                'email' => 'البريد الإلكتروني',
                'gender' => 'نوع المستخدم',
                'birth_date' => 'تاريخ الميلاد',
                'phone' => 'التليفون',
                'address' => 'العنوان',
                'nat_id' => 'الرقم القومي',
                'role' => 'تراخيص المستخدم',
                'status' => 'حالة المستخدم',
                'address' => 'العنوان',
                'nat_id' => 'الرقم القومي',
                'password' => 'كلمة المرور',
                'confirmed_password' => 'تأكيد كلمة المرور',
                'theme' => 'ثيم النظام',
                'image' => 'صورة المستخدم',
            ]);

            if($request->hasFile('image')){
                $file = request('image');
                $name = time() . '.' .$file->getClientOriginalExtension();
                $path = public_path('back/images/users');
                $file->move($path , $name);
            }
            else{
                $name = "df_image.png";
            }

            $data = request()->except(['_token', 'confirmed_password', 'image_hidden']);
            $data['password'] = Hash::make(request()->get('password'));
            $data['role'] = 1;
            $data['theme'] = 1;
            $data['image'] = $name;

            User::insert($data);
        }
    }

    public function edit($id)
    {
        if (request()->ajax()){
            $find = User::where('id', $id)->first();
            return response()->json($find);
        }
        return response()->json(['failed' => 'Access Denied']);
    }

    public function update(Request $request, $id)
    {
        if (request()->ajax()){

            $find = User::where('id', $id)->first();

            $this->validate($request , [
                'name' => 'required|string|max:100|unique:users,name,'.$id,
                'email' => 'required|string|email|max:100|unique:users,email,'.$id,
                'gender' => 'required|in:ذكر,انثي' ,
                'birth_date' => 'nullable|date' ,
                'phone' => 'nullable|numeric',
                'address' => 'nullable|string',
                'nat_id' => 'nullable|min:14|numeric|unique:users,nat_id,'.$id,
                'password' => ['nullable', 'string', Password::min(6)], // ->mixedCase()->numbers()->symbols()
                'confirmed_password' => 'nullable|same:password',
                //'role' => 'required',
                'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:1500',
                'status' => 'required|in:1,0',
                'note' => 'nullable|string',
            ],[
                'required' => ':attribute مطلوب.',
                'string' => ':attribute غير صحيح.',
                'numeric' => ':attribute غير صحيح.',
                'date' => ':attribute يجب ان يكون تاريخ.',
                'email' => ':attribute البريد الإلكتروني.',
                'unique' => ':attribute مستخدم من قبل.',
                'min' => ':attribute أقل من القيمة المطلوبة.',
                'nat_id.min' => ':attribute يجب أن يكون على الأقل :min رقم.',
                'same' => ':attribute غير مطابقة مع كلمة المرور.',
                'mimes' => ':attribute يجب أن تكون من نوع JPG أو PNG أو JPEG أو GIF.',
                'max' => ':attribute كبير عن المطلوب.',
                'password.min' => ':attribute يجب أن تكون كلمة المرور على الأقل 6 أحرف.',
                'password.mixed_case' => ':attribute يجب أن تحتوي كلمة المرور على أحرف كبيرة وصغيرة.',
                'password.numbers' => ':attribute يجب أن تحتوي كلمة المرور على أرقام.',
                'password.symbols' => ':attribute يجب أن تحتوي كلمة المرور على رموز.',
            ],[
                'name' => 'إسم المستخدم',
                'email' => 'البريد الإلكتروني',
                'gender' => 'نوع المستخدم',
                'birth_date' => 'تاريخ الميلاد',
                'phone' => 'التليفون',
                'address' => 'العنوان',
                'nat_id' => 'الرقم القومي',
                'role' => 'تراخيص المستخدم',
                'status' => 'حالة المستخدم',
                'address' => 'العنوان',
                'nat_id' => 'الرقم القومي',
                'password' => 'كلمة المرور',
                'confirmed_password' => 'تأكيد كلمة المرور',
                'theme' => 'ثيم النظام',
                'image' => 'صورة المستخدم',
            ]);

            if(request('image') == ""){
                $name = $find['image'];
            }else{
                $file = request('image');
                $name = time() . '.' .$file->getClientOriginalExtension();
                $path = public_path('back/images/users');
                $file->move($path , $name);

                if(request("image_hidden") != "df_image.png"){
                    File::delete(public_path('back/images/users/'.$find['image']));
                }
            }

            $data = request()->except(['_token', 'confirmed_password', 'image_hidden']);
            $data['password'] = request('password') ? Hash::make(request('password')) : $find['password'];
            $data['role'] = 1;
            $data['theme'] = 1;
            $data['image'] = $name;

            $find->update($data);
        }
    }


    ///////////////////////////////////////////////  datatable  ////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function datatable()
    {
        $all = User::all();
        return DataTables::of($all)
            ->addColumn('gender', function($res){
                if($res->gender == 'ذكر'){
                    return '<span class="badge badge-success" style="width: 40px;">ذكر</span>';
                }
                else{
                    return '<span class="badge badge-danger" style="width: 40px;">أنثي</span>';
                }
            })
            ->addColumn('image', function($res){
                return '
                    <a class="spotlight" title="'.$res->name.'" href="'.url('back/images/users/'.$res->image).'">
                        <img src="'.url('back/images/users/'.$res->image).'" alt="'.$res->name.'" style="width: 25px;height: 25px;border-radius: 5px;margin: 0px auto;display: block;">
                    </a>
                ';
            })
            ->addColumn('status', function($res){
                if($res->status == 1){
                    return '<span class="badge badge-success" style="width: 40px;">نشط</span>';
                }else{
                    return '<span class="badge badge-danger" style="width: 40px;">معطل</span>';
                }
            })
            ->addColumn('action', function($res){
                // if (auth()->user()->role_relation->users_update == 1 ){
                // }
                return '
                            <button class="btn btn-sm btn-outline-primary edit" data-effect="effect-scale" data-toggle="modal" href="#exampleModalCenter" data-placement="top" data-toggle="tooltip" title="تعديل" res_id="'.$res->id.'">
                                <i class="fas fa-marker"></i>
                            </button>
                        ';
            })
            ->rawColumns(['gender', 'image', 'status', 'action'])
            ->toJson();
    }

}
