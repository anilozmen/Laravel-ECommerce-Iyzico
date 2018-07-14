@extends('layouts.main')
@section('content')
    <div class="container product_section_container" style="padding: 30px;">
        <div class="row">
            <div class="col-md-12">
                {!!Form::open(["url" => "/admin-category", "method" => "post"]) !!}
                {!! Form::bsText("category_name","Category Name") !!}
                {!! Form::bsSubmit("Save") !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

