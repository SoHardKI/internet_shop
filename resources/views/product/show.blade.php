@extends('layouts.app')

@section('content')
    <script src="/js/product.js"></script>
    <script src="/js/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/styles/product.css">
    <link rel="stylesheet" type="text/css" href="/styles/product_responsive.css">
    <!-- Product Details -->

    <div class="product_details">
        <div class="container">
            <div class="row details_row">

                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="details_image">
                        <div class="details_image_large"><img src="/{{$product->image_url }}" alt=""><div class="product_extra product_new"><a href="{{route('main.category', ['category' => $product->category_id])}}">{{ \App\Category::find($product->category_id)->name }}</a></div></div>
                    </div>
                </div>

                <!-- Product Content -->
                <div class="col-lg-6">
                    <div class="details_content">
                        <div class="details_name">{{ $product->title }}</div>
                        <div class="details_price">{{ $product->price }} р</div>

                        <div class="details_text">
                            <p>{{ $product->description }}</p>
                        </div>

                        <!-- Product Quantity -->
                        <div class="product_quantity_container">
                            <div class="product_quantity clearfix">
                                <span>Qty</span>
                                <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                <div class="quantity_buttons">
                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                </div>
                            </div>
                            <div class="button cart_button"><a href="#">Add to cart</a></div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row description_row">
                <div class="col">
                    <div class="description_title_container">
                        <div class="description_title">Description</div>
                    </div>
                    <div class="description_text">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <div class="products_title">Related Products</div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php
                        $relatedProducts = \App\Product::where(['category_id' => $product->category_id])->take(4)->get();
                    ?>
                    <div class="product_grid">

                        @foreach($relatedProducts as $relatedProduct)
                            <!-- Product -->
                                <div class="product">
                                    <div class="product_image"><img src="/{{$relatedProduct->image_url}}" alt=""></div>
                                    <div class="product_extra product_new"><a href="{{route('main.category', ['category' => $relatedProduct->category_id])}}">{{ \App\Category::find($relatedProduct->category_id)->name }}</a></div>
                                    <div class="product_content">
                                        <div class="product_title"><a href="{{route('main.product', ['category' => \App\Category::find($relatedProduct->category_id)->name , 'product' => $relatedProduct->id])}}">{{$relatedProduct->title}}</a></div>
                                        <div class="product_price">{{$relatedProduct->price}}</div>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.cart_button').on('click', function (){
                let count = $('#quantity_input').val();

                if(localStorage.getItem({{$product->id}})) {
                    localStorage.setItem( {{$product->id}}, parseInt(localStorage.getItem({{$product->id}})) + parseInt(count))
                } else {
                    localStorage.setItem({{$product->id}}, parseInt(count));
                }
                setCountFunction();
            });
        })
    </script>
@endsection

