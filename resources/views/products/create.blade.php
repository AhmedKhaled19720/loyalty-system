<!-- Create Product Modal -->
<div class="modal fade" id="createProductModal" tabindex="-1" role="dialog" aria-labelledby="createProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- Column 1 -->
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="category">Category</label>
                                <select id="category" name="category" class="form-control" required>
                                    <option value="">Select a Category</option>
                                    <option value="men">Men</option>
                                    <!-- Categories will be populated here using JavaScript -->
                                </select>
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="price">Price</label>
                                <input type="number" id="price" name="price" class="form-control"
                                    value="{{ old('price') }}" required>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Column 2 -->
                        <div class="col-md-6 mb-2">
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" id="brand" name="brand" class="form-control"
                                    value="{{ old('brand') }}">
                                @error('brand')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="gift_points">Gift Points</label>
                                <input type="number" id="gift_points" name="gift_points" class="form-control"
                                    value="{{ old('gift_points') }}">
                                @error('gift_points')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="stock">Stock</label>
                                <input type="number" id="stock" name="stock" class="form-control"
                                    value="{{ old('stock') }}" required>
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                        Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-2">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image" class="form-control-file">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Fetch Categories -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
