@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col s12">
            <div class="container">
                <!-- users edit start -->
                <div class="section users-edit">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title">Edit User</h4>
                            <!-- <div class="card-body"> -->
                            <br>
                            @include('admin.alert.success')
                            <div class="row">
                                <div class="col s12" id="account">
                                    <!-- users edit account form start -->
                                    <div class="row">
                                        <form action="{{ route('admin.user.update', $data->id) }}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            <div class="col s12 m12">
                                                <div class="row">
                                                    <div class="col s12 m12 input-field">
                                                        <input id="username" name="username" type="text" class="validate" value="{{ $data->username }}" data-error=".errorTxt1" required>
                                                        <label for="username">Username</label>
                                                        <small class="errorTxt1"></small>
                                                    </div>

                                                    <div class="col s12 m12 input-field">
                                                        <input id="username" name="email" type="text" class="validate" value="{{ $data->email }}" data-error=".errorTxt1" required>
                                                        <label for="username">Email</label>
                                                        <small class="errorTxt1"></small>
                                                    </div>

                                                    <div class="col s12 m12 input-field">
                                                        <input id="username" name="display_name" type="text" class="validate" value="{{ $data->profile->display_name }}" data-error=".errorTxt1" required>
                                                        <label for="username">Display Name</label>
                                                        <small class="errorTxt1"></small>
                                                    </div>


                                                    <div class="col s12 m2 input-field">
                                                        <label>
                                                            <input type="checkbox" name="verified" value="true"
                                                                   @if ($data->email_verified_at != NULL)
                                                                   checked
                                                                @endif
                                                            >
                                                            <span>Verified</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 display-flex justify-content-end mt-3">
                                                <button type="submit" class="btn indigo">
                                                    Update</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- users edit account form ends -->
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
                <!-- users edit ends -->
                <!-- START RIGHT SIDEBAR NAV -->
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

@endsection
