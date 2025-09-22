<x-layout>
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
     <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Purchase Details</h4>
                    <h6>Full details of a purchase</h6>
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
                                    @foreach ($purchase->purchaseItems as $item )


                                    <li>
                                        <h4>Product</h4>
                                        <h6>{{ $item->product->name }}</h6>
                                    </li>

                                    <li>
                                        <h4>Quantity</h4>
                                        <h6>{{ $item->qty }}</h6>
                                    </li>

                                    <li>
                                        <h4>Cost Price</h4>
                                        <h6>{{ $item->cost_price }}</h6>
                                    </li>
                                    <li>
                                        <h4>Note</h4>
                                        <h6>{{ $purchase->notes }}</h6>
                                    </li>

                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
    </div>

</x-layout>
