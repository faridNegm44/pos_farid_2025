<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Branch;
use App\Models\Back\PersonStatus;
use App\Models\Back\User;
use App\Models\Back\RolesPermissions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index()
    {
        $pageNameAr = 'المستخدمين';
        $pageNameEn = 'users';
        // $permissions = RolesPermissions::all();
        return view('back.users.index' , compact('pageNameAr' , 'pageNameEn'));
    }

    public function store(Request $request)
    {
        if (request()->ajax()){
            $this->validate($request , [
                'name' => 'required|string',
                'email' => 'required|unique:users,email',
                'birth_date' => 'date' ,
                'phone' => 'required|integer',
                'address' => 'required|string',
                'nat_id' => 'integer|min:14',                
                'password' => [
                    'required',
                    Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
                ],
                'confirmed_password' => [
                    'required',
                    'same:password',
                    Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(),
                ],
            
            ],[
                'name.required' => 'حقل الإسم مطلوب',
                'name.string' => 'حقل الإسم يجب ان يكون من نوع نص',
                
                'email.required' => 'حقل البريد الإلكتروني مطلوب',
                'email.unique' => ' البريد الإلكتروني مستخدم من قبل',

                'birth_date' => 'حقل تاريخ الميلاد يجب ان يكون من نوع تاريخ',
                
                'phone.required' => 'حقل التليفون مطلوب',
                'phone.integer' => 'حقل التليفون يجب ان يكون من نوع رقم',

                'address.required' => 'حقل العنوان مطلوب',
                'address.string' => 'حقل العنوان يجب ان يكون من نوع نص',
                
                'nat_id.integer' => 'حقل الرقم القومي يجب ان يكون من نوع رقم',
                'nat_id.min' => 'الرقم القومي يجب ان يتكون على الأقل من 14 رقم',
        
                'password.required' => 'كلمة المرور مطلوبة',
                'password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل',
                'password.mixedCase' => 'يجب أن تحتوي كلمة المرور على حروف كبيرة وصغيرة',
                'password.numbers' => 'يجب أن تحتوي كلمة المرور على رقم واحد على الأقل',
                'password.symbols' => 'يجب أن تحتوي كلمة المرور على رمز واحد على الأقل',
                'password.uncompromised' => 'كلمة المرور ضعيفة أو مستخدمة في مكان آخر، يرجى اختيار كلمة مرور أخرى',
                
                'confirmed_password.required' => 'كلمة المرور مطلوبة',
                'confirmed_password.same' => ' كلمني المرور غير متطابقتين',
                'confirmed_password.min' => 'يجب أن تتكون كلمة المرور من 8 أحرف على الأقل',
                'confirmed_password.mixed_case' => 'يجب أن تحتوي كلمة المرور على حروف كبيرة وصغيرة',
                'confirmed_password.numbers' => 'يجب أن تحتوي كلمة المرور على رقم واحد على الأقل',
                'confirmed_password.symbols' => 'يجب أن تحتوي كلمة المرور على رمز واحد على الأقل',
                'confirmed_password.uncompromised' => 'كلمة المرور ضعيفة أو مستخدمة في مكان آخر، يرجى اختيار كلمة مرور أخرى',
                
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


            $request['password_text'] = $request->get('password');
            $request['password'] = Hash::make($request->get('password'));
            $request['role'] = $request->get('user_role');
            $request['image'] = $name;

            User::create($request->all());
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

            $find = User::whereId($id)->first();

            $this->validate($request , [
                'branch' => 'required|integer',
                'name' => 'required|string',
                'email' => [
                    'nullable', 'email',
                    Rule::unique('users')->ignore($id , 'id')->where(function ($query) use ($request) {
                        return $query->where('branch', $request->get('branch'));
                    }),
                ],
                'gender' => 'required|in:ذكر,انثي' ,
                'birth_date' => 'required|date' ,
                'phone' => [
                    'required' , 'numeric',
                    Rule::unique('users')->ignore($id , 'id')->where(function ($query) use ($request) {
                        return $query->where('branch', $request->get('branch'));
                    }),
                ],
                'address' => 'required|string',
                'nat_id' => [
                    'required' , 'numeric',
                    Rule::unique('users')->ignore($id , 'id')->where(function ($query) use ($request) {
                        return $query->where('branch', $request->get('branch'));
                    }),
                ],
                'login_name' => [
                    'required' , 'string',
                    Rule::unique('users')->ignore($id , 'id')->where(function ($query) use ($request) {
                        return $query->where('branch', $request->get('branch'));
                    }),
                ],
                'password' => 'required|min:6',
                'confirmed_password' => 'required|min:6|same:password',
                'theme' => 'required|in:light,dark' ,
                'status' => 'required|boolean'
            ],
                [
                    'required' => 'حقل :attribute إلزامي.',
                    'integer' => 'حقل :attribute غير صحيح.',
                    'unique' => 'حقل :attribute غير صحيح.',
                    'min' => 'حقل :attribute يجب ان يكون مكون من 14 رقم.',
                    'max' => 'حقل :attribute يجب ان يكون مكون من 14 رقم.',
                ],
                [
                    'branch' => 'الفرع',
                    'name' => 'اسم الموظف',
                    'email' => 'ايميل الموظف',
                    'login_name' => 'اسم المستخدم',
                    'birth_date' => 'تاريخ الميلاد',
                    'phone' => 'تليفون الموظف',
                    'address' => 'عنوان الموظف',
                    'nat_id' => 'الرقم القومي',
                    'password' => 'كلمة المرور',
                    'confirmed_password' => 'تاكيد كلمة المرور',
                ]
            );

            if($request->hasFile('image')){
                $file = request('image');
                $name = time() . '.' .$file->getClientOriginalExtension();
                $path = public_path('back/images/users');
                $file->move($path , $name);
            }
            else{
                $name = $find['image'];
            }


            $request['password_text'] = $request->get('password');
            $request['password'] = Hash::make($request->get('password'));
            $request['role'] = $request->get('user_role');
            $request['image'] = $name;

            $find->update($request->all());
        }
    }


    ///////////////////////////////////////////////  datatable  ////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function datatable()
    {
        $all = User::all();
        return DataTables::of($all)
            ->addColumn('status', function($res){
                if($res->status == 1){
                    return '<span class="badge badge-success" style="width: 40px;">نشط</span>';
                }
                else{
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

                            <button class="btn btn-sm btn-outline-danger delete" data-placement="top" data-toggle="tooltip" title="حذف" res_id="'.$res->id.'">
                                <i class="fa fa-trash"></i>
                            </button>
                        
                        ';
            })
            ->rawColumns(['status', 'action'])
            ->toJson();
    }

}
