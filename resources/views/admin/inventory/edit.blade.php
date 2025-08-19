<x-layout>
    <x-navbar></x-navbar>

    <x-sidebar></x-sidebar>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Adjust Stock</h4>


                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.inventory.update', $product->uuid) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" disabled value="{{ $product->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Category</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $product->category->name }}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label>Current Stock</label>
                                    <input type="text" class="form-control" disabled value="{{ $product->qty }}">
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="adjustment_type">Adjustment Type</label>
                                    <select name="adjustment_type" id="adjustment_type" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        <option value="increase">Increase</option>
                                        <option value="decrease">Decrease</option>
                                    </select>
                                    <x-form-error name="adjustment_type" />
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" name="qty" id="qty" class="form-control"
                                        min="1" required placeholder="Enter quantity to adjust">
                                    <x-form-error name="qty" />
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <button class="btn btn-submit me-2" type="submit">Submit</button>
                                <a href="{{ route('admin.inventory') }}" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-layout>
