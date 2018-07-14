@extends('layouts.main')

@section('content')
    <div class="container product_section_container" style="padding: 30px;">
        <div class="row">
            <div class="col-md-12">

                {!!Form::model($category, ['route' => ['admin-category.update', $category->id], "method" =>  "put","files" => true])!!}
                {!! Form::bsText("category_name","Category Name") !!}
                {!! Form::bsSubmit("Update") !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection