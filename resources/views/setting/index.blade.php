@extends('layouts.app')

@section('content')
    @if (!Auth::check())
        <div class="alert alert-warning text-center">
            <strong>Please log in to view the Setting.</strong>
            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="text-bg-info">Settings</h2>
                        </div>

                        <!-- Flash Messages -->
                        @if (session('success'))
                            <script>
                                window.onload = function() {
                                    toastr.success('{{ session('success') }}', 'Success');
                                }
                            </script>
                        @endif
                        @if (session('delete'))
                            <script>
                                window.onload = function() {
                                    toastr.warning('{{ session('delete') }}', 'Deleted');
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
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <span><i class="fa-brands fa-bitcoin fa-xl mr-2 text-success"></i></span>
                                                Points Value
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="row"></div>
                                            <div class="col-9">
                                                <div class="card">
                                                    <div
                                                        class="card-header d-flex justify-content-between align-items-md-center">
                                                        <h5 class="card-title">Points Value</h5>
                                                        <div class="card-tools">
                                                            <a href="" data-toggle="modal"
                                                                data-target="#exampleModal">
                                                                <span><i
                                                                        class="fa-regular fa-square-plus fa-xl text-info"></i></span>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="card-body">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th scope="col">Currency</th>
                                                                    <th scope="col">Points</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($points as $point)
                                                                    <tr>
                                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                                        <td>{{ $point->currency }}</td>
                                                                        <td>{{ $point->points_for_one }}</td>
                                                                        <td>
                                                                            <a href="#" class="btn btn-sm btn-primary"
                                                                                data-toggle="modal"
                                                                                data-target="#editModal{{ $point->id }}">
                                                                                <i
                                                                                    class="fa-solid fa-pen-to-square fa-xl"></i>
                                                                            </a>
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-danger"
                                                                                data-toggle="modal"
                                                                                data-target="#deleteModal{{ $point->id }}">
                                                                                <i class="fas fa-trash-alt"></i>
                                                                            </button>

                                                                            <!-- Delete Confirmation Modal -->
                                                                            <div class="modal fade"
                                                                                id="deleteModal{{ $point->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="deleteModalLabel{{ $point->id }}"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="deleteModalLabel{{ $point->id }}">
                                                                                                Confirm Deletion</h5>
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <span
                                                                                                    aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            Are you sure you want to delete
                                                                                            the Currency
                                                                                            "{{ $point->currency }}"?
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <form
                                                                                                action="{{ route('points.destroy', $point->id) }}"
                                                                                                method="POST">
                                                                                                @csrf
                                                                                                @method('DELETE')
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">Cancel</button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-danger">Delete</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Edit Modal -->
                                                                            <div class="modal fade"
                                                                                id="editModal{{ $point->id }}"
                                                                                tabindex="-1"
                                                                                aria-labelledby="editModalLabel{{ $point->id }}"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 class="modal-title"
                                                                                                id="editModalLabel{{ $point->id }}">
                                                                                                Edit Currency</h5>
                                                                                            <button type="button"
                                                                                                class="close"
                                                                                                data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                                <span
                                                                                                    aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <form
                                                                                            action="{{ route('points.update', $point->id) }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <div class="modal-body">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="currencyInput">Currency</label>
                                                                                                    <input type="text"
                                                                                                        id="currencyInput"
                                                                                                        name="currency"
                                                                                                        class="form-control text-uppercase"
                                                                                                        value="{{ $point->currency }}"
                                                                                                        required>
                                                                                                </div>
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="pointsInput">Points</label>
                                                                                                    <small
                                                                                                        class="form-text text-muted">Enter
                                                                                                        the number of points
                                                                                                        associated with the
                                                                                                        currency.</small>
                                                                                                    <input type="number"
                                                                                                        id="pointsInput"
                                                                                                        name="points"
                                                                                                        class="form-control"
                                                                                                        value="{{ $point->points_for_one }}"
                                                                                                        required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button"
                                                                                                    class="btn btn-secondary"
                                                                                                    data-dismiss="modal">Close</button>
                                                                                                <button type="submit"
                                                                                                    class="btn btn-primary">Save
                                                                                                    changes</button>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add Currency Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">New Currency</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('points.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="currencyInput">Currency</label>
                                                <input type="text" id="currencyInput" name="currency"
                                                    class="form-control text-uppercase"
                                                    placeholder="Enter currency (e.g. USD)" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pointsInput">Points</label>
                                                <small class="form-text text-muted">Enter the number of points associated
                                                    with the currency.</small>
                                                <input type="number" id="pointsInput" name="points"
                                                    class="form-control" placeholder="Enter points value" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
