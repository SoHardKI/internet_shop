@extends('layouts/app')

@section('content')
    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="product_grid">

                    @foreach($products as $product)
                        <!-- Product -->
                            <div class="product">
                                <div class="product_image"><img src="{{ $product->image_url }}" alt=""></div>
                                <div class="product_extra product_new"><a href="{{route('main.category', ['category' => $product->category_id])}}">{{ \App\Category::find($product->category_id)->name }}</a></div>
                                <div class="product_content">
                                    <div class="product_title"><a href="{{route('main.product', ['category' => \App\Category::find($product->category_id)->name , 'product' => $product->id])}}">{{$product->title}}</a></div>
                                    <div class="product_price">{{$product->price}}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
