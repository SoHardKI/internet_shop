@extends('layouts/app')
<link rel="stylesheet" type="text/css" href="/styles/cart.css">
<link rel="stylesheet" type="text/css" href="/styles/cart_responsive.css">
@section('content')
    <!-- Cart Info -->

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="cart_info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Column Titles -->
                    <div class="cart_info_columns clearfix">
                        <div class="cart_info_col cart_info_col_product">Product</div>
                        <div class="cart_info_col cart_info_col_price">Price</div>
                        <div class="cart_info_col cart_info_col_quantity">Quantity</div>
                        <div class="cart_info_col cart_info_col_total">Total</div>
                    </div>
                </div>
            </div>
            <div class="row cart_items_row">

                <div class="col">
                    <?php
                        $totalCount = 0;
                    ?>
                    {!! Form::open(array('route' => ['cart.checkout'],'method'=>'POST', 'class' => 'cart-form')) !!}
                @foreach($products as $id => $count)
                    <?php
                    $product = \App\Product::find($id);
                    ?>
                    <!-- Cart Item -->

                    <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                        <!-- Name -->
                        <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                            <div class="cart_item_image">
                                <div><img src="{{$product->image_url}}" alt=""></div>
                            </div>
                            <div class="cart_item_name_container">
                                <div class="cart_item_name"><a href="{{ route('main.product', ['category' => $product->category->id, 'product' => $product->id]) }}">{{$product->title}}</a></div>
                            </div>
                            {!! Form::hidden('products[' . $product->id . ']', $count) !!}
                        </div>
                        <!-- Price -->
                        <div class="cart_item_price">{{$product->price}} р</div>
                        <!-- Quantity -->
                        <div class="cart_item_quantity">
                            <div class="product_quantity_container">
                                <div class="product_quantity clearfix">
                                    <span>Qty</span>
                                    <input class="quantity_input_field" data-id={{$product->id}} id="quantity_input" type="text" pattern="[0-9]*" value="{{ $count }}">
                                    <div class="quantity_buttons">
                                        <div class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                        <div class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total -->
                        <div class="cart_item_total">{{ $product->price * $count}} р</div>
                        <?php
                            $totalCount += $product->price * $count;
                        ?>
                    </div>
                    @endforeach

                </div>

            </div>
            <div class="row row_cart_buttons">
                <div class="col">
                    <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                        <div class="button continue_shopping_button"><a href="{{ route('main.index') }}">Continue shopping</a></div>
                        <div class="cart_buttons_right ml-lg-auto">
                            <div class="button clear_cart_button"><a href="#">Clear cart</a></div>
                            <div class="button update_cart_button"><a href="#">Update cart</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row_extra">

                <div class="col-lg-6 offset-lg-2">
                    <div class="cart_total">
                        <div class="section_title">Cart total</div>
                        <div class="section_subtitle">Final info</div>
                        <div class="cart_total_container">
                            <ul>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Total</div>
                                    <div class="cart_total_value ml-auto">{{$totalCount}} р</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    {!! Form::label('first_name', 'Имя') !!}
                                    {!! Form::text('first_name', null, ['placeholder' => 'Имя','class' => 'form-control', 'required']) !!}
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    {!! Form::label('second_name', 'Фамилия') !!}
                                    {!! Form::text('second_name', null, ['placeholder' => 'Фамилия','class' => 'form-control', 'required']) !!}
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::text('email', null, ['placeholder' => 'Email','class' => 'form-control', 'required']) !!}
                                </li>
                            </ul>
                        </div>
                        {!! Form::button('Proceed to checkout', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/cart.js"></script>

    <script>
        $('.cart-form').on('submit', function (){
            localStorage.clear();
        });

        $('.clear_cart_button').on('click', function (){
            localStorage.clear();
            window.location = "{{route('cart.index')}}";
        });

        $('.update_cart_button').on('click', function (){
            $('.quantity_input_field').each(function (){
                localStorage.setItem($(this).data('id'), $(this).val());
            });
        });
    </script>
@endsection
