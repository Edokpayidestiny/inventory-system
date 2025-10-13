<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>📊 Sales Summary Report</h4>
                <h6>Overview of sales performance</h6>
            </div>
            <div class="graph-sets">
                <div class="dropdown">
                    <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Select Range
                        <img src="{{ asset('assets/img/icons/dropdown.svg') }}" alt="img" class="ms-2">
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a href="#" class="dropdown-item" wire:click="$set('range','daily')">Today</a></li>
                        <li><a href="#" class="dropdown-item" wire:click="$set('range','weekly')">This
                                Week</a></li>
                        <li><a href="#" class="dropdown-item" wire:click="$set('range','monthly')">This Month</a>
                        </li>
                        <li><a href="#" class="dropdown-item" wire:click="$set('range','yearly')">This
                                Year</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>₦{{ number_format($totalSalesAmount, 2) }}</h4>
                        <h5>Total Sales Amount</h5>
                    </div>
                    <div class="dash-imgs">
                        <span style="font-size:40px; font-weight:bold;">₦</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>{{ $totalItemsSold }}</h4>
                        <h5>Total Items Sold</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="package"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4>{{ $salesTransactions }}</h4>
                        <h5>Sales Transactions</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="shopping-cart"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4>₦{{ number_format($averageSaleValue, 2) }}</h4>
                        <h5>Average Sale Value</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="bar-chart-2"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4>₦{{ number_format($totalProfit, 2) }}</h4>
                        <h5>Total Profit</h5>
                    </div>
                    <div class="dash-imgs">
                        <span style="font-size:40px; font-weight:bold;">₦</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4>₦{{ number_format($totalLoss, 2) }}</h4>
                        <h5>Total Losses</h5>
                    </div>
                    <div class="dash-imgs">
                        <span style="font-size:40px; font-weight:bold;">₦</span>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <!-- Sales Trend Chart -->
            <div class="col-lg-7 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Sales Trend</h5>

                    </div>

                    <div class="card-body">
                        <div id="salesChart" wire:ignore></div>


                    </div>
                </div>
            </div>

            <!-- Best Selling Products -->
            <div class="col-lg-5 col-sm-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">Best Selling Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive dataview">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Product</th>
                                        <th>Qty Sold</th>
                                        <th>Total Sales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($topProducts as $index => $p)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="productimgname">
                                                <a href="#">{{ $p->name }}</a>
                                            </td>
                                            <td>{{ $p->qty_sold }}</td>
                                            <td>₦{{ number_format($p->total_sales ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No sales in this range.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</div>

<script>
    let chart = null;

    document.addEventListener('DOMContentLoaded', function() {
        // Initial chart render
        chart = new ApexCharts(document.querySelector("#salesChart"), {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Sales',
                data: @json($chartData['data'])
            }],
            xaxis: {
                categories: @json($chartData['labels'])
            }
        });
        chart.render();
    });

    // Listen for Livewire refresh event
    Livewire.on('refreshChart', (chartData) => {
        if (chart) {
            chart.updateSeries([{
                data: chartData.data
            }]);
            chart.updateOptions({
                xaxis: {
                    categories: chartData.labels
                }
            });
        }
    });
</script>
