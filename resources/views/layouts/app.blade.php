<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link">Home</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('products.index') }}" class="nav-link">Products</a>
                            </li>
                        @endauth
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('cart.index') }}" class="nav-link">Cart</a>
                            </li>
                        @endauth
                    </ul>

                    <ul class="navbar-nav ml-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('setting.index') }}">
                                        <span><i class="fa-solid fa-gears"></i></span> {{ __('Settings') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span><i class="fa-solid fa-arrow-right-from-bracket"></i></span>
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const apiUrl = 'https://fakestoreapi.com/products/categories';

            axios.get(apiUrl)
                .then(function(response) {
                    let categories = response.data;
                    let categorySelect = document.getElementById('category');

                    categories.forEach(function(category) {
                        let option = document.createElement('option');
                        option.value = category;
                        option.textContent = category.charAt(0).toUpperCase() + category.slice(1);
                        categorySelect.appendChild(option);
                    });
                })
                .catch(function(error) {
                    console.error('Error fetching categories:', error);
                });
        });

        $(document).ready(function() {
            $('#editProductModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var productId = button.data('id');

                var modal = $(this);
                var form = modal.find('#editProductForm');

                form.attr('action', `/products/${productId}`);

                $.ajax({
                    url: `/products/${productId}/edit`,
                    method: 'GET',
                    success: function(product) {
                        modal.find('#editName').val(product.name);
                        modal.find('#editCategory').val(product.category);
                        modal.find('#editDescription').val(product.description);
                        modal.find('#editPrice').val(product.price);
                        modal.find('#editBrand').val(product.brand);
                        modal.find('#editGiftPoints').val(product.gift_points);
                        modal.find('#editStock').val(product.stock);
                        modal.find('#editStatus').val(product.status);

                        var imageUrl = product.image ?
                            `/storage/images/products/${product.image}` : '';
                        modal.find('#productImage').attr('src', imageUrl);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching product details:', textStatus,
                            errorThrown);
                    }
                });
            });
        });
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function updateQuantity(orderId, change) {
    const quantityInput = document.getElementById('quantity-' + orderId);
    let currentQuantity = parseInt(quantityInput.value) + change;

    if (currentQuantity < 0) currentQuantity = 0;
    quantityInput.value = currentQuantity;

    const pricePerUnit = parseFloat(document.getElementById('unit-price-' + orderId).value);
    const totalPrice = pricePerUnit * currentQuantity;

    const priceElement = document.getElementById('price-' + orderId);
    priceElement.textContent = 'LE: ' + totalPrice.toFixed(2);

    // تحديث الإجمالي
    updateCartSummary();

    axios.post('/cart/update', {
        quantities: {
            [orderId]: currentQuantity
        }
    })
    .then(response => {
        if (response.data.success) {
            toastr.success('Quantity updated successfully.');
            updateCartSummary(response.data.total_price, response.data.points); // Pass the updated values
        }
    })
    .catch(error => {
        console.error('Error updating quantity:', error);
        toastr.error('Failed to update quantity.');
    });
}

function updateCartSummary() {
    let total = 0;
    let points = 0;

    // اجمع الأسعار من كل العناصر
    document.querySelectorAll('.card-body .row').forEach(row => {
        const priceElement = row.querySelector('[id^="price-"]');
        if (priceElement) {
            const price = parseFloat(priceElement.textContent.replace('LE: ', ''));
            total += price;
        }
    });

    document.getElementById('total-price').textContent = total.toFixed(2);
    
    points = Math.floor(total / 10); 
    document.getElementById('points').textContent = points;
}

    </script>


</body>

</html>
