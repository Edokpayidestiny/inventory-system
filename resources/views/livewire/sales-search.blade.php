<div>
    <!-- Search Bar -->
    {{-- <div class="table-top">
        <div class="search-set">
            <div class="search-input">
                <input type="text" wire:model.live="search" class="form-control" placeholder="Search by product, cashier, or payment...">
                
                @error('search') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
          
        </div>
    </div> --}}
    <div class="search-set">
        <div class="search-path">
            <a class="btn btn-filter" id="filter_search">
                <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img">
                <span>
                    <img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img">
                </span>
            </a>
        </div>
        <div class="search-input">
            <input type="text" wire:model.live="search" class="form-control"
                placeholder="Search by product, cashier, or payment...">

            @error('search')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <!-- Sales Table -->
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
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Cashier</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                    <tr>
                        <td>
                            <label class="checkboxs">
                                <input type="checkbox">
                                <span class="checkmarks"></span>
                            </label>
                        </td>
                        <td>{{ $sale->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>NGN{{ $sale->total_amount }}</td>
                        <td>{{ $sale->payment_method }}</td>
                        <td>{{ $sale->user->name ?? 'N/A' }}</td>
                        <td><span class="badges bg-lightgreen">Completed</span></td>
                        <td class="text-center">
                            <a class="action-set" href="" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('admin.sales.show', $sale->uuid) }}" class="dropdown-item">
                                        <img src="{{ asset('assets/img/icons/eye1.svg') }}" class="me-2"
                                            alt="img">Sale Detail
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.sales.pdf', $sale->uuid) }}" class="dropdown-item">
                                        <img src="{{ asset('assets/img/icons/download.svg') }}" class="me-2"
                                            alt="img">Download pdf
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No sales found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
