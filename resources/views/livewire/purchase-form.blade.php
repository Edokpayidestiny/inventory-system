<div>
    <div class="content">
    <!-- Page Header -->
    {{-- <div class="page-header d-flex justify-content-between align-items-center">
        <div class="page-title">
            <h4 class="mb-1">Add Purchase</h4>
            <h6 class="text-muted">Create a new purchase record</h6>
        </div>
        <div>
            <a href="{{ route('admin.purchase.index') }}" class="btn btn-sm btn-outline-secondary">Back to Purchases</a>
        </div>
    </div> --}}
    <div class="page-header">
                <div class="page-title">
                    <h4>Add Purchase</h4>
                    <h6>Create a new purchase record</h6>
                </div>
                <div class="page-btn">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-added">
                        <img src="{{ asset('assets/img/icons/plus.svg') }}" alt="img">Add New Products
                    </a>
                </div>
            </div>
    <!-- Card -->
    <div class="card">
        <div class="card-body">

            <!-- Purchase Info -->
            <h5 class="mb-3">Purchase Details</h5>
            <div class="row">

                <!-- Supplier -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Supplier <span class="text-danger">*</span></label>
                        <input type="text" wire:model="supplier" class="form-control" placeholder="Enter Supplier Name">
                        @error('supplier') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Purchase Date -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Purchase Date</label>
                        <input type="date" wire:model="purchase_date" class="form-control">
                        @error('purchase_date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Notes -->
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="form-group">
                        <label>Notes</label>
                        <input type="text" wire:model="notes" class="form-control" placeholder="Optional notes">
                    </div>
                </div>

            </div>

            <hr>

            <!-- Product Table -->
            <h5 class="mb-3">Products</h5>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="40%">Product</th>
                            <th width="15%">Quantity</th>
                            <th width="20%">Purchase Price (₦)</th>
                            <th width="20%" class="text-end">Subtotal (₦)</th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $index => $row)
                            <tr>
                                <!-- Product Select -->
                                <td>
                                    <select wire:model="products.{{ $index }}.product_id" class="form-control">
                                        <option value="">Select Product</option>
                                        @foreach($allProducts as $p)
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("products.$index.product_id") <small class="text-danger">{{ $message }}</small> @enderror
                                </td>

                                <!-- Qty -->
                                <td>
                                    <input type="number" wire:model="products.{{ $index }}.qty" class="form-control" min="1">
                                    @error("products.$index.qty") <small class="text-danger">{{ $message }}</small> @enderror
                                </td>

                                <!-- Purchase Price -->
                                <td>
                                    <input type="number" wire:model="products.{{ $index }}.price" class="form-control" step="0.01">
                                    @error("products.$index.price") <small class="text-danger">{{ $message }}</small> @enderror
                                </td>

                                <!-- Subtotal -->
                                <td class="text-end">
                                    ₦ {{ number_format($row['subtotal'], 2) }}
                                </td>

                                <!-- Delete Button -->
                                <td class="text-center">
                                    <a href="javascript:void(0);" wire:click="removeProductRow({{ $index }})" class="text-danger">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="delete">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Add Product Button -->
            <div class="row mb-3">
                <div class="col-lg-12">
                    <button type="button" wire:click="addProductRow" class="btn btn-outline-primary btn-sm">
                        + Add Product
                    </button>
                </div>
            </div>

            <!-- Grand Total -->
            <div class="row">
                <div class="col-lg-12 d-flex justify-content-end">
                    <div class="total-order mt-3">
                        <ul class="list-unstyled">
                            <li class="total d-flex justify-content-between">
                                <h4>Grand Total</h4>
                                <h5>₦ {{ number_format($this->grandTotal, 2) }}</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr>

            <!-- Action Buttons -->
            <div class="row mt-4">
                <div class="col-lg-12 text-end">
                    <button type="button" wire:click="save" class="btn btn-submit me-2">Submit</button>
                    <a href="{{ route('admin.purchase.index') }}" class="btn btn-cancel">Cancel</a>
                </div>
            </div>

        </div>
    </div>
</div>

</div>
