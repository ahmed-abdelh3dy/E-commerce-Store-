<x-front-layout title='cart'>

    <x-slot:breadcrumbs>

        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="{{ route('products.index') }}">Shop</a></li>
                            <li>Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->

    </x-slot:breadcrumbs>

    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">
                <!-- Cart List Title -->
                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">

                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Subtotal</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Discount</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>

                <!-- End Cart List Title -->
                @foreach ($cart->get() as $item)
                    <!-- Cart Single List list -->
                    <div class="cart-single-list" id="{{ $item->id }}">
                        <div class="row align-items-center">
                            <div class="col-lg-1 col-md-1 col-12">
                                <a href="{{ route('products.show', $item->product->slug) }}">
                                    <img src="{{ $item->product->image }}" alt="#"></a>
                            </div>
                            <div class="col-lg-4 col-md-3 col-12">
                                <h5 class="product-name"><a href="{{ route('products.show', $item->product->id) }}">
                                        {{ $item->product->name }}</a></h5>
                                <p class="product-des">
                                    <span><em>Type:</em> Mirrorless</span>
                                    <span><em>Color:</em> Black</span>
                                </p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <div class="count-input">
                                    <input class="form-control item-quantity" data-id="{{ $item->id }}"
                                        value="{{ $item->quantity }}">

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ App\Helpers\currency::format($item->quantity * $item->product->price) }}</p>
                            </div>
                            <div class="col-lg-2 col-md-2 col-12">
                                <p>{{ App\Helpers\currency::format(0, 'SAR') }}</p>
                            </div>
                            <div class="col-lg-1 col-md-2 col-12">
                                <form action="{{route('cart.destroy' , $item->id)}}">
                                <a class="remove-item" data-id="{{ $item->id }}" href="javascript:void(0)"><i
                                        class="lni lni-close"></i></a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Single List list -->
                @endforeach

                {{-- @foreach ($cart->get() as $item)
                    @if ($item->product)
                        <!-- Cart Single List list -->
                        <div class="cart-single-list">
                            <div class="row align-items-center">
                                <div class="col-lg-1 col-md-1 col-12">
                                    <a href="{{ route('products.show', $item->product->slug) }}">
                                        <img src="{{ $item->product->image }}" alt="#"></a>
                                </div>
                                <div class="col-lg-4 col-md-3 col-12">
                                    <h5 class="product-name"><a
                                            href="{{ route('products.show', $item->product->slug) }}">
                                            {{ $item->product->name }}</a></h5>
                                    <p class="product-des">
                                        <span><em>Type:</em> Mirrorless</span>
                                        <span><em>Color:</em> Black</span>
                                    </p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <div class="count-input">
                                        <input class="form-control" value="{{ $item->quantity }}">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>{{ App\Helpers\currency::format($item->quantity * $item->product->price) }}</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>{{ App\Helpers\currency::format(0, 'SAR') }}</p>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <a class="remove-item" href="javascript:void(0)"><i class="lni lni-close"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- End Single List list -->
                    @endif
                @endforeach --}}

            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Total Amount -->
                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <div class="button">
                                                <button class="btn">Apply Coupon</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart
                                            Subtotal<span>{{ App\Helpers\currency::format($cart->total()) }}</span>
                                        </li>
                                        <li>Shipping<span>Free</span></li>
                                        <li>You Save<span>$29.00</span></li>
                                        <li class="last">You Pay<span>$2531.00</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{route('checkout')}}" class="btn">Checkout</a>
                                        <a href="product-grids.html" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Total Amount -->
                </div>
            </div>
        </div>
    </div>
    <!--/ End Shopping Cart -->

    {{-- @push('scripts')
    <script>
        const csrf_token = {{ 'csrf_token()' }};
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('js/cart.js')}}"></script>
    @endpush --}}

    @push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> <!-- تحميل jQuery أولاً -->
    <script>
        const csrf_token = '{{ csrf_token() }}';
    
        (function($) {
            $('.item-quantity').on('change', function(e) {
                $.ajax({
                    url: "/cart/" + $(this).data('id'),
                    method: 'put',
                    data: {
                        quantity: $(this).val(),
                        _token: csrf_token
                    },
                    success: function(response) {
                        location.reload(); // إعادة تحميل الصفحة لتحديث القيم
                    }
                });
            });
        })(jQuery);
    
        (function($) {
            $('.remove-item').on('click', function(e) {
                let id = $(this).data('id');
    
                $.ajax({
                    url: "/cart/" + id,
                    method: 'delete',
                    data: {
                        _token: csrf_token
                    },
                    success: response => {
                        $('#item-' + id).remove();
                    }
                });
            });
        })(jQuery);
    </script>
    @endpush
    




</x-front-layout>
