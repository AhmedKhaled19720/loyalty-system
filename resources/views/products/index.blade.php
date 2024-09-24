@extends('layouts.app')

@section('content')
    @if (!Auth::check())
        <div class="alert alert-warning text-center ">
            <strong>Please log in to view the products.</strong>
            <a href="{{ route('login') }}" class="btn btn-primary ">Login</a>
        </div>
    @else
        @php
            $view_setting = session('view_setting', 'Cards');
        @endphp
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <!-- Product Header -->
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="text-bg-info">Products</h2>
                            <div class="d-flex">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#createProductModal">
                                    <i class="fas fa-plus"></i> New Product
                                </button>
                                @include('products.create')

                                <div class="dropdown ml-3">
                                    <button class="btn btn-outline-primary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-gears"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('products.index', ['view' => 'Cards']) }}">
                                            <i class="fas fa-th-large"></i> Cards
                                        </a>
                                        <a class="dropdown-item" href="{{ route('products.index', ['view' => 'List']) }}">
                                            <i class="fas fa-list"></i> List
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Flash Messages -->
                        @if (session('success'))
                            <script>
                                window.onload = function() {
                                    toastr.success('{{ session('success') }}', 'Success');
                                }
                            </script>
                        @endif

                        @if (session('error'))
                            <script>
                                window.onload = function() {
                                    toastr.error('{{ session('error') }}', 'Error');
                                }
                            </script>
                        @endif

                        <div class="card-body">
                            <!-- Cards View -->
                            @if ($view_setting == 'Cards')
                                <div id="cards-view" class="row">
                                    @foreach ($products as $product)
                                        <div class="col-sm-6 col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-header d-flex justify-content-between">
                                                    <div>{{ $product->name }}</div>
                                                    <div><span
                                                            class="badge badge-success">{{ $product->gift_points }}</span>
                                                        Points</div>
                                                </div>
                                                <img src="{{ $product->image ? asset('storage/images/products/' . $product->image) : asset('path/to/default-image.png') }}"
                                                    class="card-img-top" alt="{{ $product->name }}" loading="lazy">

                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <span class="text-primary"><i class="fas fa-info-circle"></i>
                                                                Description:</span> {{ $product->description }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="text-primary"><i class="fas fa-tag"></i>
                                                                Category:</span> {{ $product->category }}
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span class="text-primary"><i class="fas fa-dollar-sign"></i>
                                                                Price:</span> {{ $product->price }} LE
                                                        </li>
                                                    </ul>
                                                    <form action="{{ route('cart.add') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        <button type="submit" class="btn btn-primary btn-block">
                                                            <i class="fas fa-shopping-cart"></i> Add to cart
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $products->appends(['view' => 'Cards'])->links('pagination::bootstrap-4') }}
                                </div>
                            @endif

                            <!-- List View -->
                            @if ($view_setting == 'List')
                                <div id="list-view" class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col" class="text-center">Image</th>
                                                <th scope="col" class="text-center">Name</th>
                                                <th scope="col" class="text-center">Stock</th>
                                                <th scope="col" class="text-center">Price</th>
                                                <th scope="col" class="text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr class="text-center align-middle">
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>
                                                        <img src="{{ $product->image ? asset('storage/images/products/' . $product->image) : asset('path/to/default-image.png') }}"
                                                            alt="{{ $product->name }}" class="img-thumbnail"
                                                            style="width: 90px; height: 90px;" loading="lazy">

                                                    </td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>{{ $product->stock }}</td>
                                                    <td>{{ $product->price }} LE</td>
                                                    <td>
                                                        <a href="#" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#productModal{{ $product->id }}"><i
                                                                class="fa-solid fa-binoculars"></i></a>
                                                        <a href="#" class="btn btn-info mx-2" data-toggle="modal"
                                                            data-target="#editProductModal" data-id="{{ $product->id }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger" data-toggle="modal"
                                                            data-target="#deleteModal{{ $product->id }}"><i
                                                                class="fa-solid fa-delete-left"></i></a>
                                                    </td>
                                                </tr>
                                                @include('products.show')
                                                @include('products.edit')
                                                @include('products.delete')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3 d-flex justify-content-center">
                                    {{ $products->appends(['view' => 'List'])->links('pagination::bootstrap-4') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
@endsection
