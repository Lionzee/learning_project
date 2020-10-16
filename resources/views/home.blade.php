@extends('layouts.app')
@section('content')
    @if (auth()->user()->role->name == "ADMIN" || auth()->user()->role->name == "SUPERADMIN" )
        <div class="row">
            <div class="col s12">
                <div id="carousel-special-options" class="card">
                    <div class="card-content">
                        <div id="view-carousel-carousel-special-options">
                            <div class="row">
                                <div class="col s12">
                                    <div class="carousel carousel-slider center carousel-indicators" data-indicators="true">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 l6 xl6">
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
            <div class="col s12 m6 l6 xl6">
                <div class="card padding-4 animate fadeLeft">
                    <div class="row">
                        <div class="col s5 m5">
                            <h5 class="mb-0">1885</h5>
                            <p class="no-margin">New</p>
                            <p class="mb-0 pt-8">1,12,900</p>
                        </div>
                        <div class="col s7 m7 right-align">
                                <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">donut_small</i>
                            <p class="mb-0">Total Topics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
