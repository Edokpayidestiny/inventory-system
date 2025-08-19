<x-layout>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Details</h4>
                    <h6>Full details of a product</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="bar-code-view">
                                <img src="{{ asset('assets/img/barcode1.png') }}" alt="barcode">
                               
                            </div>
                            <div class="productdetails">
                                <ul class="product-bar">
                                    <li>
                                        <h4>Product</h4>
                                        <h6>{{ $product->name }}</h6>
                                    </li>
                                    <li>
                                        <h4>Category</h4>
                                        <h6>{{ $product->category->name }}</h6>
                                    </li>

                                    <li>
                                        <h4>Brand</h4>
                                        <h6>{{ $product->brand }}</h6>
                                    </li>

                                    <li>
                                        <h4>Unit</h4>
                                        <h6>{{ $product->unit }}</h6>
                                    </li>

                                    <li>
                                        <h4>Current Stock</h4>
                                        <h6>{{ $product->qty }}</h6>
                                    </li>
                                    
                                    <li>
                                        <h4>Price</h4>
                                        <h6>NGN{{ number_format($product->price) }}</h6>
                                    </li>
                                    <li>
                                        <h4>Status</h4>
                                        <h6>
                                            @if ($product->qty > 20)
                                                <span class="badge bg-success">In Stock</span>
                                            @elseif ($product->qty > 0 && $product->qty <= 20)
                                                <span class="badge bg-warning">Low Stock</span>
                                            @else
                                                <span class="badge bg-danger">Out of Stock</span>
                                            @endif
                                        </h6>
                                    </li>
                                    <li>
                                        <h4>Description</h4>
                                        <h6>{{ $product->description }}</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="slider-product-details">
                                <div class="owl-carousel owl-theme product-slide">
                                    <div class="slider-product">
                                        <img src="{{ asset($product->image) }}" alt="img">
                                        <h4>{{ $product->name }}</h4>
                                        <h6>{{ $product->description }}</h6>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layout>
