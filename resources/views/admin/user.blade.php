@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Voucher</h4>

                    @include('admin.alert.success')
                    <div class="row">
                        <div class="col s12">
                            <table id="page-length-option" class="display">
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Verified</th>
                                    <th>Display name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $data->username }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td> @if ($data->email_verified_at == NULL)
                                            <p class="card-content orange-text">NO</p>
                                            @else
                                                <p class="card-content green-text">YES</p>
                                            @endif
                                        </td>
                                        <td>{{$data->profile->display_name}}</td>
                                        <td>
                                            <a href="{{ route('admin.user.show', $data->id) }}" class="mb-6 btn waves-effect waves-light cyan">Edit</a>
                                            <a href="" class="mb-6 btn waves-effect waves-light red">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

