@extends('layouts.main')
@section('content')
    <div class="container product_section_container" style="padding: 30px;">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name Surname</th>
                        <th>E-Mail</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Mobile Phone</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Zip Code</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userDetails as $userDetail)
                        <tr>
                            <td>{{ $userDetail->user->name }} {{ $userDetail->user->surname }}</td>
                            <td>{{ $userDetail->user->email }}</td>
                            <td>{{ $userDetail->address }} </td>
                            <td>{{ $userDetail->phone }}</td>
                            <td>{{ $userDetail->m_phone }}</td>
                            <td>{{ $userDetail->city }}</td>
                            <td>{{ $userDetail->country }}</td>
                            <td>{{ $userDetail->zipcode }}</td>
                            <td>
                                <a href="/profile/{{$userDetail->id}}/edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
@endsection
