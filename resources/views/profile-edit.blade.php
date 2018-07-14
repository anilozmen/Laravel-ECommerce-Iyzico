@extends('layouts.main')
@section('content')
    <div class="container product_section_container" style="padding: 30px;">
        <div class="row">
            <div class="col-md-12">
                {!!Form::model($userDetails, ['route' => ['profile.update', $userDetails->id], "method" =>  "put","files" => true])!!}
                {!! Form::bsText("phone","Phone") !!}
                {!! Form::bsText("m_phone","Mobile Phone") !!}
                {!! Form::bsText("address","Address") !!}
                {!! Form::bsText("city","City") !!}
                {!! Form::bsText("country","Country") !!}
                {!! Form::bsText("zipcode","Zip Code") !!}
                {!! Form::bsSubmit("Update") !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection