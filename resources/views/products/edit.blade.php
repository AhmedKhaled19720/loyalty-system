<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Column 1 -->
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="editName">Name</label>
                                <input type="text" id="editName" name="name" class="form-control" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="editCategory">Category</label>
                                <select id="editCategory" name="category" class="form-control" required>
                                    <option value="">Select a Category</option>
                                    <!-- Categories will be populated here using JavaScript -->
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="editDescription">Description</label>
                                <textarea id="editDescription" name="description" class="form-control" rows="4" required></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label for="editPrice">Price</label>
                                <input type="number" id="editPrice" name="price" class="form-control" required>
                            </div>
                        </div>

                        <!-- Column 2 -->
                        <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label for="editBrand">Brand</label>
                                <input type="text" id="editBrand" name="brand" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <label for="editGiftPoints">Gift Points</label>
                                <input type="number" id="editGiftPoints" name="gift_points" class="form-control">
                            </div>
                            <div class="form-group mt-2">
                                <label for="editStock">Stock</label>
                                <input type="number" id="editStock" name="stock" class="form-control" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="editStatus">Status</label>
                                <select id="editStatus" name="status" class="form-control" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="editImage">Image</label>
                                <input type="file" id="editImage" name="image" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <img id="productImage" src="" alt="Product Image" class="img-fluid">
                        </div>
                    </div>
                    <div class="mt-2 text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
