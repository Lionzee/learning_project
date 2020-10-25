@extends('layouts.app')
@section('content')

        <div class="row">
            <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
                <!-- Search for small screen-->
                    <div class="row">
                        <div class="col s10 m6 l6">
                            <h5 class="breadcrumbs-title mt-0 mb-0"><span>Dashboard</span></h5>
                            <ol class="breadcrumbs mb-0">
                                <li class="breadcrumb-item"><a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Dashboard</a>
                                </li>
                            </ol>
                        </div>
                    </div>
            </div>

            <div class="col s12">
                <div class="container">
                    <div class="section">
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div id="change-font" class="card card card-default">
                                    <div class="card-content">
                                        <h4 class="card-title">Welcome, <b> {{\Illuminate\Support\Facades\Auth::user()->username}} </b></h4>
                                        <p>This is learning project admin panel. You are logged in as <b> {{\Illuminate\Support\Facades\Auth::user()->username}} </b> </p>
                                        <p>Hope you have a nice working day !</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="row">
                            <div class="col s4">
                                <div class="card padding-4 animate fadeLeft">
                                    <div class="row">
                                        <div class="col s5 m5">
                                            <h5 class="mb-0">1885</h5>
                                            <p class="no-margin">New</p>
                                            <p class="mb-0 pt-8">1,12,900</p>
                                        </div>
                                        <div class="col s7 m7 right-align">
                                            <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
                                            <p class="mb-0">Total Clients</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s4">
                                <div class="card padding-4 animate fadeLeft">
                                    <div class="row">
                                        <div class="col s5 m5">
                                            <h5 class="mb-0">1885</h5>
                                            <p class="no-margin">New</p>
                                            <p class="mb-0 pt-8">1,12,900</p>
                                        </div>
                                        <div class="col s7 m7 right-align">
                                            <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
                                            <p class="mb-0">Total Clients</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s4">
                                <div class="card padding-4 animate fadeLeft">
                                    <div class="row">
                                        <div class="col s5 m5">
                                            <h5 class="mb-0">1885</h5>
                                            <p class="no-margin">New</p>
                                            <p class="mb-0 pt-8">1,12,900</p>
                                        </div>
                                        <div class="col s7 m7 right-align">
                                            <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
                                            <p class="mb-0">Total Clients</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <div class="card card-border z-depth-2">
                                    <div class="card-image">
                                        <img src="../../../app-assets/images/gallery/dc-1.png" alt="">
                                    </div>
                                    <div class="card-content">
                                        <h6 class="font-weight-900 text-uppercase"><a href="#">Learning Project</a></h6>
                                        <p>Created with Materialize</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="content-overlay"></div>
            </div>
        </div>

@endsection
