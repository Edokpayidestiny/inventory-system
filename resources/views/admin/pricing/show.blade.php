<x-layout>
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Pricing History</h4>
                    <h6>Full details of {{ $product->name }}</h6>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-10 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5>Past Price Changes</h5>

                            <div class="productdetails">
                                <ul class="product-bar">
                                    @forelse ($product->productPricing as $history)
                                        <li class="d-flex justify-content-between">
                                            <div>
                                                <h6>Old Price: ₦{{ number_format($history->old_selling_price, 2) }}</h6>
                                                <h6>New Price: ₦{{ number_format($history->new_selling_price, 2) }}</h6>
                                            </div>
                                            <div>
                                                <small class="text-muted">
                                                    Updated on {{ $history->created_at->format('d M Y, h:i A') }}
                                                </small>
                                            </div>
                                        </li>
                                    @empty
                                        <li>
                                            <h6>No pricing history available for this product.</h6>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
