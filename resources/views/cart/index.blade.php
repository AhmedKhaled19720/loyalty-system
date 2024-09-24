{{-- resources/views/cart/index.blade.php --}}
@extends('layouts.app')
<style>
    input[type="number"] {
        -moz-appearance: textfield;

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
</style>
@section('content')
    <div class="container">
        <h1>Your Cart</h1>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('success'))
                    toastr.success('{{ session('success') }}');
                @endif

                @if (session('error'))
                    toastr.error('{{ session('error') }}');
                @endif

                @if (session('info'))
                    toastr.info('{{ session('info') }}');
                @endif

                @if (session('warning'))
                    toastr.warning('{{ session('warning') }}');
                @endif
            });
        </script>
        @if ($cart && $cart->orders->isNotEmpty())
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Your Cart</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            @foreach ($cart->orders as $order)
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mt-2">
                                            <div class="row mb-3 d-flex justify-content-between align-items-center">
                                                <div class="col-md-3">
                                                    <div class="col-md-12 d-flex justify-content-center">
                                                        <img src="{{ asset('storage/images/products/' . $order->product->image) }}"
                                                            class="img-fluid card-img mt-3"
                                                            alt="{{ $order->product->name }}"
                                                            style="max-width: 100px; max-height: 100px;">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 d-flex justify-content-center align-items-center">
                                                    <button data-mdb-button-init data-mdb-ripple-init
                                                        class="btn btn-link px-2"
                                                        onclick="updateQuantity('{{ $order->id }}', -1)">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input id="quantity-{{ $order->id }}" min="0" name="quantity"
                                                        value="{{ $order->quantity }}" type="number"
                                                        class="form-control form-control-sm text-center" />
                                                    <button data-mdb-button-init data-mdb-ripple-init
                                                        class="btn btn-link px-2"
                                                        onclick="updateQuantity('{{ $order->id }}', 1)">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                                    <p id="price-{{ $order->id }}" class="mb-0">LE:
                                                        {{ $order->product->price * $order->quantity }}</p>
                                                    <input type="hidden" id="unit-price-{{ $order->id }}"
                                                        value="{{ $order->product->price }}">
                                                </div>
                                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                                    <form action="{{ route('cart.remove', $order->id) }}" method="POST"
                                                        style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="close text-danger"><i
                                                                class="fas fa-xmark"></i></button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="col-md-4">
                            <div class="card mb-4 mt-2">
                                <div class="card-header py-3">
                                    <h4 class="mb-0 text-center ">Summary</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                            Products
                                            <p class="card-text">LE: <span id="total-price">{{ $cart->total_price }}</span>
                                            </p>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            Shipping
                                            <p class="card-text">Points: <span id="points">{{ $cart->points }}</span>
                                            </p>
                                        </li>
                                        </li>
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                            <div>
                                                <strong>Total amount</strong>
                                                <strong>
                                                    <p class="mb-0">(including VAT)</p>
                                                </strong>
                                            </div>
                                            <span><strong>$53.98</strong></span>
                                        </li>
                                    </ul>

                                    <button type="button" data-mdb-button-init="" data-mdb-ripple-init=""
                                        class="btn btn-primary btn-lg btn-block" data-mdb-button-initialized="true">
                                        Go to checkout
                                    </button>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        @else
            <p class="text-center">Your cart is empty.</p>
        @endif
    </div>
@endsection
