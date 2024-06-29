{{-- @if (auth()->user()->role_relation->settings_update == 1 ) --}}
    <form class="" id="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body form_bordred_sections">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#general" role="tab" aria-selected="true" style="font-weight: bold;color:blue;">
                        <span class="d-block d-sm-none"><i class="fas fa-info-circle"></i></span>
                        <span class="d-none d-sm-block">@lang('app.General')</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#images" role="tab" aria-selected="false" style="font-weight: bold;color:blue;">
                        <span class="d-block d-sm-none"><i class="fas fa-images"></i></span>
                        <span class="d-none d-sm-block">@lang('app.Images')</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#mail" role="tab" aria-selected="false" style="font-weight: bold;color:blue;">
                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                        <span class="d-none d-sm-block">@lang('app.Mail')</span>    
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                {{--------------------- tab 1 general ---------------------}}
                <div class="tab-pane active" id="general" role="tabpanel">
                    <h5 style="text-decoration: underline;font-weight: bold;">@lang('app.basic_info')</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <i class="fas fa-star require_input"></i>
                            <div class="mb-3">
                                <label for="name" class="form-label">@lang('app.name')</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $find['name'] }}" placeholder="@lang('app.name')">
                                <bold class="text-danger" id="errors-name" style="display: none;"></bold>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="description" class="form-label">@lang('app.description')</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $find['description'] }}" placeholder="@lang('app.description')">
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="footer_text" class="form-label">@lang('app.footer_text')</label>
                                <input type="text" class="form-control" id="footer_text" name="footer_text" value="{{ $find['footer_text'] }}" placeholder="@lang('app.footer_text')">
                            </div>
                        </div>                        
                    </div>

                    <hr />
                    <div class="row">
                        <h5 style="text-decoration: underline;font-weight: bold;">@lang('app.address')</h5>
                        <div class="col-md-6">
                            <i class="fas fa-star require_input"></i>
                            <div class="mb-3">
                                <label for="address" class="form-label">@lang('app.address')</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $find['address'] }}" placeholder="@lang('app.address')">
                                <bold class="text-danger" id="errors-address" style="display: none;"></bold>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="city" class="form-label">@lang('app.city')</label>
                                <input type="text" class="form-control" id="city" name="city" value="{{ $find['city'] }}" placeholder="@lang('app.city')">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label for="zip_code" class="form-label">@lang('app.zip_code')</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ $find['zip_code'] }}" placeholder="@lang('app.zip_code')">
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="row">
                        <h5 style="text-decoration: underline;font-weight: bold;">@lang('app.contact_details')</h5>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="email" class="form-label">@lang('app.email')</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $find['email'] }}" placeholder="@lang('app.email')">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <i class="fas fa-star require_input"></i>
                            <div class="mb-3">
                                <label for="phone1" class="form-label">@lang('app.phone1')</label>
                                <input type="number" class="form-control" id="phone1" name="phone1" value="{{ $find['phone1'] }}" placeholder="@lang('app.phone1')">
                                <bold class="text-danger" id="errors-phone1" style="display: none;"></bold>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="phone2" class="form-label">@lang('app.phone2')</label>
                                <input type="number" class="form-control" id="phone2" name="phone2" value="{{ $find['phone2'] }}" placeholder="@lang('app.phone2')">
                            </div>
                        </div>
                    </div>
                </div>

                {{--------------------- tab 2 images ---------------------}}
                <div class="tab-pane" id="images" role="tabpanel">
                    <div class="row">
                        <h5 style="text-decoration: underline;font-weight: bold;">@lang('app.images')</h5>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="logo" class="form-label">@lang('app.logo')</label>
                                <input type="file" class="form-control" id="logo" name="logo" value="{{ $find['logo'] }}" placeholder="@lang('app.logo')">

                                <input type="hidden" name="image_hidden_logo" value="{{ $find['logo'] }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fav_icon" class="form-label">@lang('app.fav_icon')</label>
                                <input type="file" class="form-control" id="fav_icon" name="fav_icon" value="{{ $find['fav_icon'] }}" placeholder="@lang('app.fav_icon')">

                                <input type="hidden" name="image_hidden_fav_icon" value="{{ $find['fav_icon'] }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{--------------------- tab 3 mail ---------------------}}
                <div class="tab-pane" id="mail" role="tabpanel">
                    <div class="row">
                        <h5 style="text-decoration: underline;font-weight: bold;">@lang('app.mail_conifg')</h5>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="mail_driver" class="form-label">@lang('app.mail_driver')</label>
                                <select class="form-control" id="mail_driver" name="mail_driver" value="{{ $find['mail_driver'] }}">
                                    <option value="">---</option>
                                    <option value="log" {{ $find['mail_driver'] === 'log' ? 'selected' : null }}>log</option>
                                    <option value="mailgun" {{ $find['mail_driver'] === 'mailgun' ? 'selected' : null }}>mailgun</option>
                                    <option value="sendmail" {{ $find['mail_driver'] === 'sendmail' ? 'selected' : null }}>sendmail</option>
                                    <option value="smtp" {{ $find['mail_driver'] === 'smtp' ? 'selected' : null }}>smtp</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="from" class="form-label">@lang('app.from')</label>
                                <input type="text" class="form-control" id="from" name="from" value="{{ $find['from'] }}" placeholder="@lang('app.from')">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="to" class="form-label">@lang('app.to')</label>
                                <input type="text" class="form-control" id="to" name="to" value="{{ $find['to'] }}" placeholder="@lang('app.to')">
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="row">
                        <h5 style="text-decoration: underline;font-weight: bold;">smtp config</h5>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="host" class="form-label">@lang('app.host')</label>
                                <input type="text" class="form-control" id="host" name="host" value="{{ $find['host'] }}" placeholder="@lang('app.host')">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="port" class="form-label">@lang('app.port')</label>
                                <input type="text" class="form-control" id="port" name="port" value="{{ $find['port'] }}" placeholder="@lang('app.port')">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="encryption" class="form-label">@lang('app.encryption')</label>
                                <input type="text" class="form-control" id="encryption" name="encryption" value="{{ $find['encryption'] }}" placeholder="@lang('app.encryption')">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="username" class="form-label">@lang('app.username')</label>
                                <input type="text" class="form-control" id="username" name="username" value="{{ $find['username'] }}" placeholder="@lang('app.username')">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="password" class="form-label">@lang('app.password')</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="@lang('app.password')">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="button" id="save" class="btn btn-secondary btn-rounded waves-effect waves-light mb-2 me-2" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="fas fa-times me-1"></i>
            @lang('app.close')
        </button>

        <button type="button" id="update" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
            <i class="fas fa-save me-1"></i>
            @lang('app.update')
        </button>
    </form>
{{-- @else --}}
    {{-- <h4 class="text-center" style="margin: 100px auto;">
        لاتمتلك الصلاحيات لرؤيه محتوي الصفحة
        <img src="{{ url('back/images/rej2.png') }}" style="width: 80px;height: 78px;position: relative;bottom: 7px;bo"/>
    </h4>
@endif     --}}



<script>
    $("#offcanvasWithBothOptions .offcanvas-title").text("@lang('app.edit')").css("color", "#FFF");
    $("#offcanvasWithBothOptions .offcanvas-header").css("background", "#4ec798");

    $("#offcanvasWithBothOptions #update").click(function(e){
        e.preventDefault();
        var id = {{ $find->id }};

        $.ajax({
            url: "{{ url('settings/update') }}"+'/'+id,
            type: 'POST',
            processData: false,
            contentType: false,
            data: new FormData($('#offcanvasWithBothOptions #form')[0]),
            beforeSend:function () {
                $('form [id^=errors]').text('');
            },
            success: function(res){
                $("#offcanvasWithBothOptions").offcanvas('hide');
                $('#datatable').DataTable().ajax.reload( null, false );

                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 4);
                alertify.success("تم التعديل بنجاح");

            },
            error: function(res){
                alertify.set('notifier','position', 'top-center');
                alertify.set('notifier','delay', 4);
                alertify.error("هناك شيئ ما خطأ");

                $.each(res['responseJSON']['errors'] , function (index , value) {
                    $(`form #errors-${index}`).css('display' , 'block').text(value);
                });
            }
        });
    });


    ///////////////////////////////// Edit By Button Enter /////////////////////////////////
    $("#form").keydown(function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
        }
    });
</script>
