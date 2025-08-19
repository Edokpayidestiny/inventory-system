<div class="row">
    <div class="col-lg-8 col-sm-12 tabs_wrapper">
        <div class="page-header">
            <div class="page-title">
                <h4>Categories</h4>
                <h6>Manage your purchases</h6>
            </div>
        </div>

        {{-- Categories --}}
        <div class="row tabs owl-carousel owl-theme owl-product border-0">
            @foreach ($categories as $category)
                <div class="col-2" wire:click="selectCategory({{ $category->id }})" style="cursor: pointer;">
                    <div class="product-details"
                        style="
                border: 2px solid {{ $selectedCategoryId === $category->id ? '#7367F0' : '#7367F0' }};
                border-radius: 6px;
                padding: 5px;
                background-color: {{ $selectedCategoryId === $category->id ? '#7367F0' : '#ffffff' }};
            ">
                        <img src="{{ asset($category->image) }}" alt="img" style="height: 50px; width: 50px;">
                        <h6>{{ $category->name }}</h6>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-3">
            @forelse ($products as $product)
                <div wire:click="addToCart({{ $product->id }})" class="col-lg-3 col-sm-6 d-flex">
                    <div class="productset flex-fill">
                        <div class="productsetimg">
                            <img src="{{ asset($product->image) }}" alt="img">
                            <h6>Qty: {{ $product->qty }}</h6>
                        </div>
                        <div class="productsetcontent">
                            <h5>{{ $product->category->name }}</h5>
                            <h4>{{ $product->name }}</h4>
                            <h6>{{ number_format($product->price) }}</h6>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">Select a category to see products.</p>
                </div>
            @endforelse
        </div>


    </div>








    <!-- Order List Sidebar -->
    <div class="col-lg-4 col-sm-12">
        <div class="order-list">
            <div class="orderid">
                <h4>Order List</h4>
                <h5>Transaction id : #65565</h5>
            </div>
            <div class="actionproducts">
                <ul>
                    <li>
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                            <img src="{{ asset('assets/img/icons/ellipise1.svg') }}" alt="img">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                            data-popper-placement="bottom-end">
                            <li><a href="#" class="dropdown-item">Action</a></li>
                            <li><a href="#" class="dropdown-item">Another Action</a></li>
                            <li><a href="#" class="dropdown-item">Something Else</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card card-order">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <a href="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal"
                            data-bs-target="#create">
                            <i class="fa fa-plus me-2"></i>Add Customer
                        </a>
                    </div>

                    <div class="col-lg-12">
                        <div class="select-split">
                            <div class="select-group w-100">
                                <select class="form-control select">
                                    <option>Walk-in Customer</option>
                                    <option>Chris Moris</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="select-split">
                            <div class="select-group w-100">
                                <select class="form-control select">
                                    <option>Product</option>
                                    <option>Barcode</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="text-end">
                            <a class="btn btn-scanner-set">
                                <img src="{{ asset('assets/img/icons/scanner1.svg') }}" alt="img"
                                    class="me-2">Scan
                                barcode
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="split-card"></div>

            <div class="card-body pt-0">
                <div class="totalitem">
                    <h4>Total items : {{ $this->getTotalItems() }}</h4>
                    <a href="javascript:void(0);" wire:click="clearCart">Clear all</a>
                </div>

                <div class="product-table">
                    @foreach ($cart as $item)
                        <ul class="product-lists">
                            <li>
                                <div class="productimg">
                                    <div class="productimgs">
                                        <img src="{{ asset($item['image']) }}" alt="img">
                                    </div>
                                    <div class="productcontet">
                                        <h4>{{ $item['name'] }}</h4>
                                        <div class="increment-decrement">
                                            <div class="input-groups">
                                                <input type="button" value="-"
                                                    wire:click="decrement('{{ $item['id'] }}')"
                                                    class="button-minus dec button">
                                                <input type="text" value="{{ $item['qty'] }}"
                                                    class="quantity-field" readonly>
                                                <input type="button" value="+"
                                                    wire:click="increment('{{ $item['id'] }}')"
                                                    class="button-plus inc button">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>{{ number_format($item['price'] * $item['qty']) }}</li>
                            <li>
                                <a href="#" wire:click="removeItem('{{ $item['id'] }}')">
                                    <img src="{{ asset('assets/img/icons/delete-2.svg') }}" alt="img">
                                </a>
                            </li>
                        </ul>
                    @endforeach

                </div>
            </div>

            <div class="split-card"></div>

            <div class="card-body pt-0 pb-2">
                <div class="setvalue">
                    <ul>
                        <li>
                            <h5>Subtotal</h5>
                            <h6>NGN{{ number_format($this->getTotal(), 2) }}</h6>
                        </li>
                        <li>
                            <h5>Tax</h5>
                            <h6>NGN 5.0</h6>
                        </li>
                        <li class="total-value">
                            <h5>Total</h5>
                            <h6>NGN{{ number_format($this->getTotal(), 2) }}</h6>
                        </li>
                    </ul>
                </div>

                {{-- <div class="setvaluecash">
                <ul>
                    <li>
                        <a href="javascript:void(0);" class="paymentmethod">
                            <img src="{{ asset('assets/img/icons/cash.svg') }}" alt="img" class="me-2">Cash
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="paymentmethod">
                            <img src="{{ asset('assets/img/icons/debitcard.svg') }}" alt="img"
                                class="me-2">Debit
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="paymentmethod">
                            <img src="{{ asset('assets/img/icons/scan.svg') }}" alt="img" class="me-2">Scan
                        </a>
                    </li>
                </ul>
            </div> --}}
                <div class="setvaluecash">
                    <ul>
                        <li>
                            <a href="javascript:void(0);" class="paymentmethod"
                                wire:click="selectPaymentMethod('Cash')"
                                style="{{ $paymentMethod === 'Cash' ? 'background-color:#e6f7ff; border:2px solid #007bff; border-radius:5px; padding:8px; color:#007bff; font-weight:600;' : '' }}">
                                <img src="{{ asset('assets/img/icons/cash.svg') }}" alt="img"
                                    class="me-2">Cash
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="paymentmethod"
                                wire:click="selectPaymentMethod('Debit')"
                                style="{{ $paymentMethod === 'Debit' ? 'background-color:#e6f7ff; border:2px solid #007bff; border-radius:5px; padding:8px; color:#007bff; font-weight:600;' : '' }}">
                                <img src="{{ asset('assets/img/icons/debitcard.svg') }}" alt="img"
                                    class="me-2">Debit
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0);" class="paymentmethod"
                                wire:click="selectPaymentMethod('Transfer')"
                                style="{{ $paymentMethod === 'Transfer' ? 'background-color:#e6f7ff; border:2px solid #007bff; border-radius:5px; padding:8px; color:#007bff; font-weight:600;' : '' }}">
                                <img src="{{ asset('assets/img/icons/scan.svg') }}" alt="img"
                                    class="me-2">Transfer
                            </a>
                        </li>

                    </ul>
                </div>

                @if (count($cart) > 0 && $paymentMethod)
                    <div class="btn-totallabel" wire:click="checkout" style="cursor: pointer;">
                        <h5>Checkout</h5>
                        <h6>NGN{{ number_format($this->getTotal(), 2) }}</h6>
                    </div>
                @endif


                <div class="btn-pos">
                    <ul>
                        <li><a class="btn"><img src="{{ asset('assets/img/icons/pause1.svg') }}" alt="img"
                                    class="me-1">Hold</a></li>
                        <li><a class="btn"><img src="{{ asset('assets/img/icons/edit-6.svg') }}" alt="img"
                                    class="me-1">Quotation</a></li>
                        <li><a class="btn"><img src="{{ asset('assets/img/icons/trash12.svg') }}" alt="img"
                                    class="me-1">Void</a></li>
                        <li><a class="btn"><img src="{{ asset('assets/img/icons/wallet1.svg') }}" alt="img"
                                    class="me-1">Payment</a></li>
                        <li>
                            <a class="btn" data-bs-toggle="modal" data-bs-target="#recents">
                                <img src="{{ asset('assets/img/icons/transcation.svg') }}" alt="img"
                                    class="me-1"> Transaction
                            </a>
                        </li>
                    </ul>
                </div>
            </div> <!-- End card-body -->

        </div> <!-- End card-order -->
    </div> <!-- End col-lg-4 -->
</div>
