<!-- main-header -->
<div class="main-header nav nav-item hor-header">
    <div class="container-fluid">
        <div class="main-header-left ">
            <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a>
            <a class="header-brand" href="{{ url('') }}">
                <img src="{{ asset('back') }}/assets/img/brand/logo-white.png" class="desktop-dark">
                <img src="{{ asset('back') }}/assets/img/brand/logo.png" class="desktop-logo">
                <img src="{{ asset('back') }}/assets/img/brand/favicon.png" class="desktop-logo-1">
                <img src="{{ asset('back') }}/assets/img/brand/favicon.png" class="desktop-logo-dark">
            </a>



            <div class="horizontal-main header-layout d-none d-md-flex d-lg-flex" style="margin-right: 50px;">
                <div class="horizontal-mainwrapper container clearfix">
                    <nav class="horizontalMenu clearfix"><div class="horizontal-overlapbg"></div>
                        <ul class="horizontalMenu-list">
                            <li aria-haspopup="true"><span class="horizontalMenu-click"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span>
                                <a class="sub-icon active" href="#">
                                <i class="mdi mdi-box-shadow" style="font-size: 17px !important;color: gray;position: relative;top: 2px;"></i>
                                
                                إختصارات <i class="fe fe-chevron-down horizontal-icon"></i></a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true" class="active"><a href="{{ url('products') }}" class="slide-item active">الأصناف</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('clients') }}" class="slide-item active">العملاء</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('suppliers') }}" class="slide-item active">الموردين</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('financial_treasury') }}" class="slide-item active">الخزائن المالية</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('financial_treasury') }}" class="slide-item active">كشكول النواقص</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('') }}" class="slide-item active">الموظفين</a></li>
                                </ul>
                            </li>

                            <li aria-haspopup="true"><span class="horizontalMenu-click"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span>
                                <a class="sub-icon active" href="#">
                                <i class="mdi mdi-file-pdf" style="font-size: 17px !important;color: gray;position: relative;top: 2px;"></i>
                            
                                تقارير <i class="fe fe-chevron-down horizontal-icon"></i></a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true" class="active"><a href="{{ url('') }}" class="slide-item active">تقرير مبيعات</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('') }}" class="slide-item active">تقرير مشتريات</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('') }}" class="slide-item active">تقرير تسليم الدرج</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('') }}" class="slide-item active">تقرير الحضور والإنصراف</a></li>
                                    <li aria-haspopup="true" class="active"><a href="{{ url('') }}" class="slide-item active">تقرير المصروفات</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
           



            {{--<div class="horizontal-main header-layout d-none d-md-flex d-lg-flex">
                <div class="horizontal-mainwrapper container clearfix">
                    <nav class="horizontalMenu clearfix"><div class="horizontal-overlapbg"></div>
                        <ul class="horizontalMenu-list">
                            <li aria-haspopup="true"><span class="horizontalMenu-click"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span>
                                <a class="sub-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                                
                                إختصارات 
                                <i class="fe fe-chevron-down horizontal-icon"></i></a>

                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="http://localhost/edustage_system_2024/public/time_table" class="slide-item">جدول الحصص</a></li>
                                    <li aria-haspopup="true"><a href="http://localhost/edustage_system_2024/public/time_table" class="slide-item">تقيمات الطلاب</a></li>                                   
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>--}}

            
            {{-- <div class="main-header-center  mr-4">
                <input class="form-control" placeholder="Search for anything..." type="search"><button class="btn"><i class="fe fe-search"></i></button>
            </div> --}}
        </div><!-- search -->
    

        <div class="main-header-right">
            {{-- d-none d-md-flex d-lg-flex --}}
            <div>
                <a type="button" style="font-size: 18px;margin: 5px;" data-bs-toggle="tooltip" title="% الالة الحاسبة" data-effect="effect-scale" data-toggle="modal" href=".calc">
                    <i class="mdi mdi-calculator bg-dark text-white product-icon" style="padding: 0 5px;border-radius: 50%;"></i>
                </a>
                
                <a href="{{ url('/') }}" style="font-size: 18px;margin: 5px;" data-bs-toggle="tooltip" title="فاتورة بيع">
                    <i class="mdi mdi-cart-outline bg-danger-gradient text-white product-icon" style="padding: 0 5px;border-radius: 50%;"></i>
                </a>

                <a href="{{ url('/') }}" style="font-size: 18px;margin: 5px;" data-bs-toggle="tooltip" title="فاتورة شراء">
                    <i class="mdi mdi-file-chart bg-success-gradient text-white product-icon" style="padding: 0 5px;border-radius: 50%;"></i>
                </a>

                <a href="{{ url('/treasury_bills/create') }}" style="font-size: 18px;margin: 5px;" data-bs-toggle="tooltip" title="اضافة اذن">
                    <i class="mdi mdi-cash bg-primary-gradient text-white product-icon" style="padding: 0 5px;border-radius: 50%;"></i>
                </a>

                <a class="" href="{{ url('/') }}" style="font-size: 18px;margin: 5px;" data-bs-toggle="tooltip" title="مرتجع شراء">
                    <i class="mdi mdi-currency-usd-off bg-warning-gradient text-white product-icon" style="padding: 0 5px;border-radius: 50%;"></i>
                </a>
                
            </div>


            {{--<div class="nav-item d-none d-md-flex">
                <nav class="horizontalMenu clearfix"><div class="horizontal-overlapbg"></div>
                    <ul class="horizontalMenu-list">
                        <li aria-haspopup="true"><span class="horizontalMenu-click"><i class="horizontalMenu-arrow fe fe-chevron-down"></i></span>
                            <a class="sub-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                            
                            إختصارات <i class="fe fe-chevron-down horizontal-icon"></i></a>
                            <ul class="sub-menu">
                                <li aria-haspopup="true"><a href="http://localhost/edustage_system_2024/public/time_table" class="slide-item">جدول الحصص</a></li>
                                <li aria-haspopup="true"><a href="http://localhost/edustage_system_2024/public/time_table" class="slide-item">تقيمات الطلاب</a></li>

                               
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>--}}
            
            <div class="nav-item dark_theme">
                <a class="new nav-link full-screen-link"style="font-size: 25px;cursor: pointer;">
                    <i class="mdi mdi-lightbulb-on"></i>    
                </a>
            </div>
            
            <div class="nav-item light_theme" style="display: none;">
                <a class="new nav-link full-screen-link" style="font-size: 25px;color: #eec706;cursor: pointer;">
                    <i class="mdi mdi-lightbulb-on-outline"></i>    
                </a>
            </div>
            
            
            <div class="nav nav-item  navbar-nav-right ml-auto">
                {{--<div class="nav-link " id="bs-example-navbar-collapse-1" style="position: relative;bottom: 3px;">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="submit" class="btn btn-default nav-link resp-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>--}}



                <div class="dropdown nav-item main-header-message d-none d-md-flex d-lg-flex">
                    <a class="new nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class=" pulse-danger"></span></a>
                    <div class="dropdown-menu">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Messages</h6>
                                <span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
                            </div>
                            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread messages</p>
                        </div>
                        <div class="main-message-list chat-scroll">
                            <a href="chat.html" class="p-3 d-flex border-bottom">
                                <div class="  drop-img  cover-image  " data-image-src="{{ asset('back') }}/assets/img/faces/3.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Petey Cruiser</h5>
                                    </div>
                                    <p class="mb-0 desc">I'm sorry but i'm not sure how to help you with that......</p>
                                    <p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>
                                </div>
                            </a>
                            <a href="chat.html" class="p-3 d-flex border-bottom">
                                <div class="drop-img cover-image" data-image-src="{{ asset('back') }}/assets/img/faces/2.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Jimmy Changa</h5>
                                    </div>
                                    <p class="mb-0 desc">All set ! Now, time to get to you now......</p>
                                    <p class="time mb-0 text-left float-right mr-2 mt-2">Mar 06 01:12 AM</p>
                                </div>
                            </a>
                            <a href="chat.html" class="p-3 d-flex border-bottom">
                                <div class="drop-img cover-image" data-image-src="{{ asset('back') }}/assets/img/faces/9.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Graham Cracker</h5>
                                    </div>
                                    <p class="mb-0 desc">Are you ready to pickup your Delivery...</p>
                                    <p class="time mb-0 text-left float-right mr-2 mt-2">Feb 25 10:35 AM</p>
                                </div>
                            </a>
                            <a href="chat.html" class="p-3 d-flex border-bottom">
                                <div class="drop-img cover-image" data-image-src="{{ asset('back') }}/assets/img/faces/12.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Donatella Nobatti</h5>
                                    </div>
                                    <p class="mb-0 desc">Here are some products ...</p>
                                    <p class="time mb-0 text-left float-right mr-2 mt-2">Feb 12 05:12 PM</p>
                                </div>
                            </a>
                            <a href="chat.html" class="p-3 d-flex border-bottom">
                                <div class="drop-img cover-image" data-image-src="{{ asset('back') }}/assets/img/faces/5.jpg">
                                    <span class="avatar-status bg-teal"></span>
                                </div>
                                <div class="wd-90p">
                                    <div class="d-flex">
                                        <h5 class="mb-1 name">Anne Fibbiyon</h5>
                                    </div>
                                    <p class="mb-0 desc">I'm sorry but i'm not sure how...</p>
                                    <p class="time mb-0 text-left float-right mr-2 mt-2">Jan 29 03:16 PM</p>
                                </div>
                            </a>
                        </div>
                        <div class="text-center dropdown-footer">
                            <a href="text-center.html">VIEW ALL</a>
                        </div>
                    </div>
                </div>

                
                <div class="dropdown nav-item main-header-notification d-none d-md-flex d-lg-flex">
                    <a class="new nav-link" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg><span class=" pulse"></span></a>
                    <div class="dropdown-menu">
                        <div class="menu-header-content bg-primary text-right">
                            <div class="d-flex">
                                <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Notifications</h6>
                                <span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>
                            </div>
                            <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread Notifications</p>
                        </div>
                        <div class="main-notification-list Notification-scroll">
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-pink">
                                    <i class="la la-file-alt text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <h5 class="notification-label mb-1">New files available</h5>
                                    <div class="notification-subtext">10 hour ago</div>
                                </div>
                                <div class="mr-auto" >
                                    <i class="las la-angle-left text-left text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-purple">
                                    <i class="la la-gem text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <h5 class="notification-label mb-1">Updates Available</h5>
                                    <div class="notification-subtext">2 days ago</div>
                                </div>
                                <div class="mr-auto" >
                                    <i class="las la-angle-left text-left text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-success">
                                    <i class="la la-shopping-basket text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <h5 class="notification-label mb-1">New Order Received</h5>
                                    <div class="notification-subtext">1 hour ago</div>
                                </div>
                                <div class="mr-auto" >
                                    <i class="las la-angle-left text-left text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-warning">
                                    <i class="la la-envelope-open text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <h5 class="notification-label mb-1">New review received</h5>
                                    <div class="notification-subtext">1 day ago</div>
                                </div>
                                <div class="mr-auto" >
                                    <i class="las la-angle-left text-left text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-danger">
                                    <i class="la la-user-check text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <h5 class="notification-label mb-1">22 verified registrations</h5>
                                    <div class="notification-subtext">2 hour ago</div>
                                </div>
                                <div class="mr-auto" >
                                    <i class="las la-angle-left text-left text-muted"></i>
                                </div>
                            </a>
                            <a class="d-flex p-3 border-bottom" href="#">
                                <div class="notifyimg bg-primary">
                                    <i class="la la-check-circle text-white"></i>
                                </div>
                                <div class="mr-3">
                                    <h5 class="notification-label mb-1">Project has been approved</h5>
                                    <div class="notification-subtext">4 hour ago</div>
                                </div>
                                <div class="mr-auto" >
                                    <i class="las la-angle-left text-left text-muted"></i>
                                </div>
                            </a>
                        </div>
                        <div class="dropdown-footer">
                            <a href="#">VIEW ALL</a>
                        </div>
                    </div>
                </div>

                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
                </div>

                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href="#"><img alt="" src="{{ asset('back/images/users/'.authUserInfo()->image) }}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt="" src="{{ asset('back/images/users/'.authUserInfo()->image) }}" class=""></div>
                                <div class="mr-3 my-auto">
                                    <h6>{{ authUserInfo()->name }}</h6>
                                    <span>{{ authUserInfo()->role }}</span>
                                </div> 
                            </div>
                        </div>
                        <a class="dropdown-item" href="profile.html"><i class="bx bx-user-circle"></i>Profile</a>
                        <a class="dropdown-item" href="editprofile.html"><i class="bx bx-cog"></i> Edit Profile</a>
                        <a class="dropdown-item" href="mail-compose.html"><i class="bx bxs-inbox"></i>Inbox</a>
                        <a class="dropdown-item" href="mail.html"><i class="bx bx-envelope"></i>Messages</a>
                        <a class="dropdown-item" href="mail-settings.html"><i class="bx bx-slider-alt"></i> Account Settings</a>
                        <a class="dropdown-item text-danger" href="{{ url('logout') }}"><i class="bx bx-log-out"></i> تسجيل خروج</a>
                    </div>
                </div>

                <div class="dropdown main-header-message right-toggle">
                    <a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /main-header -->