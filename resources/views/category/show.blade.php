@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="/styles/categories.css">
<link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">

@section('content')

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Product Sorting -->
                    <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">Showing <span>{{ $products->count() }}</span> results</div>
                        <div class="sorting_container ml-md-auto">
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Sort by</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn" data-sort='default'><span>Default</span></li>
                                            <li class="product_sorting_btn" data-sort='price-asc'><span>Price &#9650;</span></li>
                                            <li class="product_sorting_btn" data-sort='price-desc'><span>Price &#9660;</span></li>
                                            <li class="product_sorting_btn" data-sort='title-asc'><span>Name &#9650;</span></li>
                                            <li class="product_sorting_btn" data-sort='title-desc'><span>Name &#9660;</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="product_grid">

                    @foreach($products as $product)
                        <!-- Product -->
                            <div class="product">
                                <div class="product_image"><img src="/{{ $product->image_url }}" alt=""></div>
                                <div class="product_extra product_new"><a href="{{route('main.category', ['category' => $product->category_id])}}">{{ \App\Category::find($product->category_id)->name }}</a></div>
                                <div class="product_content">
                                    <div class="product_title"><a href="{{route('main.product', ['category' => \App\Category::find($product->category_id)->name , 'product' => $product->id])}}">{{$product->title}}</a></div>
                                    <div class="product_price">{{$product->price}}</div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="product_pagination" style="text-align: center">
                        @php
                            {{
                            /**
                              * @var $products \Illuminate\Pagination\Paginator
                              **/
                            }}
                        @endphp
                        {!! $products->appends(['orderBy' => Request::input('orderBy')])->render() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
<script src="/js/jquery-3.2.1.min.js"></script>
<script src="/js/categories.js"></script>
<script>
    $(document).ready(function (){
        $('.product_sorting_btn').on('click', function (){
            let orderBy = $(this).data('sort');
            window.location = "{{route('main.category', ['category' => $category->id])}}" + '?orderBy=' + orderBy;
            $.get("{{route('main.category', ['category' => $category->id])}}", {'orderBy' : orderBy})
        });
    })
</script>
