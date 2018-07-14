@extends('layouts.main')

@section('content')
    <div class="container product_section_container" style="padding: 30px;">
        <div class="row">
            <div class="col-md-12">

                {!!Form::model($products, ['route' => ['admin-products.update', $products->id], "method" =>  "put","files" => true])!!}
                {!! Form::bsSelect("category_id","Category",null,$categoriess,"Please select a category") !!}
                {!! Form::bsFile("img[]","Product Image") !!}
                {!! Form::bsText("product_name","Product Name") !!}
                {!! Form::bsText("original_price","Original Price") !!}
                {!! Form::bsText("product_price","Product Price") !!}
                {!! Form::bsTextArea("product_detail","Product Detail",null,["class" => "summernote"]) !!}
                {!! Form::bsSubmit("Update") !!}
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.summernote').summernote({
            tabsize: 2,
            height: 100
        });
    </script>
@endsection
