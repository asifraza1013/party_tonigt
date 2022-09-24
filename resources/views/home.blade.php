@extends('layouts.app')

@section('content')
    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics" style="margin-top: 10px">
        <div class="row">
            <!-- Website Analytics Starts-->
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Website Analytics</h4>
                        <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                    </div>
                    <div class="card-content">
                        <div class="card-body pb-1">
                            <div class="d-flex justify-content-around align-items-center flex-wrap">
                                <div class="user-analytics">
                                    <i class="bx bx-user mr-25 align-middle"></i>
                                    <span class="align-middle text-muted">Users</span>
                                    <div class="d-flex">
                                        <div id="radial-success-chart"></div>
                                        <h3 class="mt-1 ml-50">61K</h3>
                                    </div>
                                </div>
                                <div class="sessions-analytics">
                                    <i class="bx bx-trending-up align-middle mr-25"></i>
                                    <span class="align-middle text-muted">Sessions</span>
                                    <div class="d-flex">
                                        <div id="radial-warning-chart"></div>
                                        <h3 class="mt-1 ml-50">92K</h3>
                                    </div>
                                </div>
                                <div class="bounce-rate-analytics">
                                    <i class="bx bx-pie-chart-alt align-middle mr-25"></i>
                                    <span class="align-middle text-muted">Bounce Rate</span>
                                    <div class="d-flex">
                                        <div id="radial-danger-chart"></div>
                                        <h3 class="mt-1 ml-50">72.6%</h3>
                                    </div>
                                </div>
                            </div>
                            <div id="analytics-bar-chart"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-md-6 col-sm-12 dashboard-referral-impression">
                <div class="row">
                    <!-- Referral Chart Starts-->
                    <div class="col-xl-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body text-center pb-0">
                                    <h2>$32,690</h2>
                                    <span class="text-muted">Referral</span> 40%
                                    <div id="success-line-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-12 col-sm-12">
                <div class="row">
                    <!-- Conversion Chart Starts-->
                    <div class="col-xl-12 col-md-6 col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between pb-xl-0 pt-xl-1">
                                <div class="conversion-title">
                                    <h4 class="card-title">Conversion</h4>
                                    <p>60%
                                        <i class="bx bx-trending-up text-success font-size-small align-middle mr-25"></i>
                                    </p>
                                </div>
                                <div class="conversion-rate">
                                    <h2>89k</h2>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body text-center">
                                    <div id="bar-negative-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-6 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-rgba-warning m-0 p-25 mr-75 mr-xl-2">
                                                <div class="avatar-content">
                                                    <i class="bx bx-dollar text-warning font-medium-2"></i>
                                                </div>
                                            </div>
                                            <div class="total-amount">
                                                <h5 class="mb-0">$53,659</h5>
                                                <small class="text-muted">Income</small>
                                            </div>
                                        </div>
                                        <div id="warning-line-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Task Card Starts -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card widget-todo">
                            <div
                                class="card-header border-bottom d-flex justify-content-between align-items-center flex-wrap">
                                <h4 class="card-title d-flex mb-25 mb-sm-0">
                                    <i class='bx bx-check font-medium-5 pl-25 pr-75'></i>Tasks
                                </h4>
                                <ul class="list-inline d-flex mb-25 mb-sm-0">
                                    <li class="d-flex align-items-center">
                                        <i class='bx bx-check-circle font-medium-3 mr-50'></i>
                                        <div class="dropdown">
                                            <div class="dropdown-toggle mr-1 cursor-pointer" role="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">All Task
                                            </div>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="#">Option 1</a>
                                                <a class="dropdown-item" href="#">Option 2</a>
                                                <a class="dropdown-item" href="#">Option 3</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                        <i class='bx bx-sort mr-50 font-medium-3'></i>
                                        <div class="dropdown">
                                            <div class="dropdown-toggle cursor-pointer" role="button"
                                                id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">All Task</div>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                                <a class="dropdown-item" href="#">Option 1</a>
                                                <a class="dropdown-item" href="#">Option 2</a>
                                                <a class="dropdown-item" href="#">Option 3</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body px-0 py-1">
                                <ul class="widget-todo-list-wrapper" id="widget-todo-list">
                                    <li class="widget-todo-item">
                                        <div
                                            class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                            <div class="widget-todo-title-area d-flex align-items-center">
                                                <i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
                                                <div class="checkbox checkbox-shadow">
                                                    <input type="checkbox" class="checkbox__input" id="checkbox1">
                                                    <label for="checkbox1"></label>
                                                </div>
                                                <span class="widget-todo-title ml-50">Add SCSS and JS files if
                                                    required</span>
                                            </div>
                                            <div class="widget-todo-item-action d-flex align-items-center">
                                                <div class="badge badge-pill badge-light-success mr-1">frontend</div>
                                                <div class="avatar bg-rgba-primary m-0 mr-50">
                                                    <div class="avatar-content">
                                                        <span class="font-size-base text-primary">RA</span>
                                                    </div>
                                                </div>
                                                <div class="dropdown">
                                                    <span
                                                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer icon-light"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        role="menu"></span>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-edit-alt mr-1"></i> edit</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-trash mr-1"></i> delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="widget-todo-item">
                                        <div
                                            class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                            <div class="widget-todo-title-area d-flex align-items-center">
                                                <i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
                                                <div class="checkbox checkbox-shadow">
                                                    <input type="checkbox" class="checkbox__input" id="checkbox2">
                                                    <label for="checkbox2"></label>
                                                </div>
                                                <span class="widget-todo-title ml-50">Check your changes, before
                                                    commiting</span>
                                            </div>
                                            <div class="widget-todo-item-action d-flex align-items-center">
                                                <div class="badge badge-pill badge-light-danger mr-1">backend</div>
                                                <div class="avatar m-0 mr-50">
                                                    <img src="../../../app-assets/images/profile/user-uploads/social-2.jpg"
                                                        alt="img placeholder" height="32" width="32">
                                                </div>
                                                <div class="dropdown">
                                                    <span
                                                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer icon-light"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        role="menu"></span>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-edit-alt mr-1"></i> edit</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-trash mr-1"></i> delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="widget-todo-item completed">
                                        <div
                                            class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                            <div class="widget-todo-title-area d-flex align-items-center">
                                                <i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
                                                <div class="checkbox checkbox-shadow">
                                                    <input type="checkbox" class="checkbox__input" id="checkbox3"
                                                        checked>
                                                    <label for="checkbox3"></label>
                                                </div>
                                                <span class="widget-todo-title ml-50">Dribble, Behance, UpLabs & Pinterest
                                                    Post</span>
                                            </div>
                                            <div class="widget-todo-item-action d-flex align-items-center">
                                                <div class="badge badge-pill badge-light-primary mr-1">UI/UX</div>
                                                <div class="avatar bg-rgba-primary m-0 mr-50">
                                                    <div class="avatar-content">
                                                        <span class="font-size-base text-primary">JP</span>
                                                    </div>
                                                </div>
                                                <div class="dropdown">
                                                    <span
                                                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer icon-light"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        role="menu"></span>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-edit-alt mr-1"></i> edit</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-trash mr-1"></i> delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="widget-todo-item">
                                        <div
                                            class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                            <div class="widget-todo-title-area d-flex align-items-center">
                                                <i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
                                                <div class="checkbox checkbox-shadow">
                                                    <input type="checkbox" class="checkbox__input" id="checkbox4">
                                                    <label for="checkbox4"></label>
                                                </div>
                                                <span class="widget-todo-title ml-50">Fresh Design Web & Responsive
                                                    Miracle</span>
                                            </div>
                                            <div class="widget-todo-item-action d-flex align-items-center">
                                                <div class="badge badge-pill badge-light-info mr-1">Design</div>
                                                <div class="avatar m-0 mr-50">
                                                    <img src="../../../app-assets/images/profile/user-uploads/user-05.jpg"
                                                        alt="img placeholder" height="32" width="32">
                                                </div>
                                                <div class="dropdown">
                                                    <span
                                                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer icon-light"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        role="menu"></span>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-edit-alt mr-1"></i> edit</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-trash mr-1"></i> delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="widget-todo-item">
                                        <div
                                            class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                            <div class="widget-todo-title-area d-flex align-items-center">
                                                <i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
                                                <div class="checkbox checkbox-shadow">
                                                    <input type="checkbox" class="checkbox__input" id="checkbox5">
                                                    <label for="checkbox5"></label>
                                                </div>
                                                <span class="widget-todo-title ml-50">Add Calendar page, source, credit
                                                    page in
                                                    documentation</span>
                                            </div>
                                            <div class="widget-todo-item-action d-flex align-items-center">
                                                <div class="badge badge-pill badge-light-warning mr-1">Javascript</div>
                                                <div class="avatar bg-rgba-primary m-0 mr-50">
                                                    <div class="avatar-content">
                                                        <span class="font-size-base text-primary">AK</span>
                                                    </div>
                                                </div>
                                                <div class="dropdown">
                                                    <span
                                                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer icon-light"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        role="menu"></span>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-edit-alt mr-1"></i> edit</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-trash mr-1"></i> delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="widget-todo-item">
                                        <div
                                            class="widget-todo-title-wrapper d-flex justify-content-between align-items-center mb-50">
                                            <div class="widget-todo-title-area d-flex align-items-center">
                                                <i class='bx bx-grid-vertical mr-25 font-medium-4 cursor-move'></i>
                                                <div class="checkbox checkbox-shadow">
                                                    <input type="checkbox" class="checkbox__input" id="checkbox6">
                                                    <label for="checkbox6"></label>
                                                </div>
                                                <span class="widget-todo-title ml-50">Add Angular Starter-kit</span>
                                            </div>
                                            <div class="widget-todo-item-action d-flex align-items-center">
                                                <div class="badge badge-pill badge-light-primary mr-1">UI/UX</div>
                                                <div class="avatar m-0 mr-50">
                                                    <img src="../../../app-assets/images/profile/user-uploads/user-05.jpg"
                                                        alt="img placeholder" height="32" width="32">
                                                </div>
                                                <div class="dropdown">
                                                    <span
                                                        class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer icon-light"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                        role="menu"></span>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-edit-alt mr-1"></i> edit</a>
                                                        <a class="dropdown-item" href="#"><i
                                                                class="bx bx-trash mr-1"></i> delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Dashboard Analytics end -->
@endsection
