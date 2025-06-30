@extends('back.layouts.app')

@section('title')
    الأذونات والتراخيص
@endsection

@section('header')
    <style>
        input[type="checkbox"]{
            width: 1.50em;
            height: 1.50em;
            margin-top: .165em;
            vertical-align: top;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            border: 1px solid #e3d9da;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            margin: 0px 8px;
            position: relative;
            top: 3px;
        }

        #facebook_reviews #update input,
        #facebook_reviews #update label, 
        #privacy_policy #create input,
        #privacy_policy #create label,
        #privacy_policy #delete input,
        #privacy_policy #delete label,
        #policy_to_parent #create input,
        #policy_to_parent #create label,
        #policy_to_parent #delete input,
        #policy_to_parent #delete label,
        #policy_to_teacher #create input,
        #policy_to_teacher #create label,
        #policy_to_teacher #delete input,
        #policy_to_teacher #delete label,
        #settings #create input,
        #settings #create label,
        #settings #delete input,
        #settings #delete label,
        #table_prices #delete input,
        #table_prices #delete label
        {
            display: none;
            cursor: auto;
        }
                
        #facebook_reviews #update:after,
        #privacy_policy #create:after,
        #privacy_policy #delete:after,
        #policy_to_parent #create:after,
        #policy_to_parent #delete:after,
        #policy_to_teacher #create:after,
        #policy_to_teacher #delete:after,
        #settings #create:after,
        #settings #delete:after,
        #table_prices #delete:after
        {
            content: '--------';
            cursor: auto;
        }
    </style>
@endsection

@section('footer')
    <script>
        $(document).ready(function () {
            $('#selectAll').click(function(event) {
                if(this.checked) {
                    $('input[type="checkbox"]').each(function() {
                        this.checked = true;
                    });
                } else {
                    $('input[type="checkbox"]').each(function() {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
@endsection

@section('content')

    <div class="main-content">

        <div class="page-content">
            @if (auth()->user()->role_relation->permissions_update == 1 )
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0 font-size-18">الأذونات والتراخيص</h4>
                            </div>
                        </div>
                    </div>

                    @php
                        $models = ['admins', 'teachers', 'teacher_feedback', 'about_acadmy', 'table_prices', 'blog_category', 'blog', 'langs_course', 'courses', 'facebook_reviews', 'faq', 'privacy_policy', 'policy_to_parent', 'policy_to_teacher', 'settings','permissions'];

                        $count = 1;
                    @endphp

                    {{-- /////////////////////////////////////  Table  ///////////////////////////////////////////////////////////// --}}
                    <form action="{{ url('admin/roles_permissions/update/'.$find['id']) }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div style="overflow: auto;">
                                    <div style="padding: 0px 5px 20px;">
                                        <label for="role_name">اسم الإذن</label>
                                        
                                        <input type="text" class="form-control" name="role_name" id="role_name" placeholder="اسم الإذن" value="{{ old('role_name', $find['role_name']) }}" required />

                                        @if($errors->has('role_name'))
                                            <div class="error">{{ $errors->first('role_name') }}</div>
                                        @endif
                                    </div>

                                    <table class="table table-responsive table-hover table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <td>#</td>
                                                <td>الأسم</td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                                        <label class="form-check-label" for="selectAll">
                                                        إختر الكل
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($models as $model)
                                            <tr style="font-weight: bold;" id="{{ $model }}">
                                                <td class="text-nowrap fw-semibold">{{ $count++ }}</td>
                                                <td class="text-nowrap fw-semibold">@lang('app.'.$model)</td>
                                                <td>
                                                    <div class="d-flex">
                                                    <div class="form-check me-3 me-lg-5" id="create">
                                                        <input class="form-check-input" type="checkbox" name="{{ $model }}_create" {{ old(''.$model.'_create') ? 'checked' : '' }} {{ $find[''.$model.'_create'] == 1 ? 'checked' : '' }} id="{{ $model }}_create" />
                                                        <label class="form-check-label" for="{{ $model }}_create">
                                                        اضافة
                                                        </label>
                                                    </div>

                                                    <div class="form-check me-3 me-lg-5" id="view">
                                                        <input class="form-check-input" type="checkbox" name="{{ $model }}_view" {{ old(''.$model.'_view') ? 'checked' : '' }}  {{ $find[''.$model.'_view'] == 1 ? 'checked' : '' }} id="{{ $model }}_view" />
                                                        <label class="form-check-label" for="{{ $model }}_view">
                                                        عرض
                                                        </label>
                                                    </div>

                                                    <div class="form-check me-3 me-lg-5" id="update">
                                                        <input class="form-check-input" type="checkbox" name="{{ $model }}_update" {{ old(''.$model.'_update') ? 'checked' : '' }}  {{ $find[''.$model.'_update'] == 1 ? 'checked' : '' }} id="{{ $model }}_update" />
                                                        <label class="form-check-label" for="{{ $model }}_update">
                                                        تحديث
                                                        </label>
                                                    </div>

                                                    <div class="form-check me-3 me-lg-5" id="delete">
                                                        <input class="form-check-input" type="checkbox" name="{{ $model }}_delete" {{ old(''.$model.'_delete') ? 'checked' : '' }}  {{ $find[''.$model.'_delete'] == 1 ? 'checked' : '' }} id="{{ $model }}_delete" />
                                                        <label class="form-check-label" for="{{ $model }}_delete">
                                                        حذف
                                                        </label>
                                                    </div>

                                                    @if ($model == 'admins')                                                
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox" name="{{ $model }}_change_password" {{ old(''.$model.'_change_password') ? 'checked' : '' }} {{ $find[''.$model.'_change_password'] == 1 ? 'checked' : '' }} id="{{ $model }}_change_password"/>
                                                            <label class="form-check-label" for="{{ $model }}_change_password">
                                                            تغير كلمة المرور
                                                            </label>
                                                        </div>
                                                    @endif

                                                    @if ($model == 'blog')                                                
                                                        <div class="form-check me-3 me-lg-5">
                                                            <input class="form-check-input" type="checkbox" name="{{ $model }}_comment" {{ old(''.$model.'_comment') ? 'checked' : '' }} {{ $find[''.$model.'_comment'] == 1 ? 'checked' : '' }} id="{{ $model }}_comment"/>
                                                            <label class="form-check-label" for="{{ $model }}_comment">
                                                            تعليقات المدونات
                                                            </label>
                                                        </div>
                                                    @endif

                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <br>
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="save" style="display: block;width: 100%;height: 50px;">حفظ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <h4 class="text-center" style="margin: 100px auto;">
                    لاتمتلك الصلاحيات لرؤيه محتوي الصفحة
                    <img src="{{ url('back/images/rej2.png') }}" style="width: 80px;height: 78px;position: relative;bottom: 7px;bo"/>
                </h4>
            @endif    

        </div>


        {{-- Include Footer --}}
        @include('back.layouts.footer')
    </div>
@endsection
