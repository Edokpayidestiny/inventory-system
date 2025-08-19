<x-layout>
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Sales List</h4>
                    <h6>Manage your sales</h6>
                </div>

            </div>

            <div class="card">
                <div class="card-body">
                    <!-- Date Range Filter Form -->
                    <form method="GET" action="{{ route('admin.sales.filter') }}" class="row mb-4">
                        <div class="col-md-6">
                            <label>From Date</label>
                            <input type="date" name="date_from" class="form-control"
                                value="{{ request('date_from') }}">
                            @error('date_from')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('date_error')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label>To Date</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                            @error('date_to')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @error('date_error')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-3 align-self-end mt-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('admin.sales.history') }}" class="btn btn-light">Reset</a>
                        </div>
                    </form>

                    <div class="table-top">
                        {{-- <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img">
                                    <span>
                                        <img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img">
                                    </span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset">
                                    <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                                </a>
                            </div>
                        </div> --}}
                        <div class="wordset">
                            <ul>

                                <li>
                                    <a href="{{ route('admin.sales.print.all') }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="print">
                                        <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if (request('date_from') && request('date_to'))
                        <p class="text-muted">
                            Showing results from <strong>{{ request('date_from') }}</strong> to
                            <strong>{{ request('date_to') }}</strong>.
                        </p>
                    @endif

                        @livewire('sales-search', ['date_from' => request('date_from'), 'date_to' => request('date_to')])
                  
                </div>
            </div>

        </div>
    </div>
</x-layout>
