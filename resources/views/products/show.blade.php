<!-- Modal -->
<div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('storage/images/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Description:</strong> {{ $product->description }}</li>
                            <li class="list-group-item"><strong>Category:</strong> {{ $product->category }}</li>
                            <li class="list-group-item"><strong>Brand:</strong> {{ $product->brand }}</li>
                            <li class="list-group-item"><strong>Price:</strong> {{ $product->price }} LE</li>
                            <li class="list-group-item"><strong>Stock:</strong> {{ $product->stock }}</li>
                            <li class="list-group-item"><strong>Gift Points:</strong> {{ $product->gift_points }}</li>
                            <li class="list-group-item"><strong>Status:</strong> {{ ucfirst($product->status) }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
