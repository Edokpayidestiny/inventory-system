<x-layout>
    <x-navbar></x-navbar>

    <x-sidebar></x-sidebar>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>PURCHASE LIST</h4>
                    <h6>Manage your productPricing</h6>
                </div>

            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img">
                                    <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset">
                                    <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                                </a>
                            </div>
                        </div>
                       
                    </div>


                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="checkboxs">
                                            <input type="checkbox" id="select-all">
                                            <span class="checkmarks"></span>
                                        </label>
                                    </th>
                                    <th>Product Name</th>
                                    <th>Old Selling Price</th>
                                    <th>New Selling Price</th>
                                    <th>Last Updated</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($productPricing as $pricingHistory)
                                    <tr>
                                        <td>
                                            <label class="checkboxs">
                                                <input type="checkbox">
                                                <span class="checkmarks"></span>
                                            </label>
                                        </td>
                                        <td class="text-bolds">{{ $pricingHistory->product->name }}</td>
                                        <td>{{ $pricingHistory->old_selling_price }}</td>
                                        <td>{{ $pricingHistory->new_selling_price }}</td>
                                        <td>{{ $pricingHistory->updated_at }}</td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
