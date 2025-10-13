<div>
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count">
                <div class="dash-counts">
                    <h4>₦{{ number_format($stats['today_sales'] ?? 0, 2) }}</h4>
                    <h5>Today’s Sales</h5>
                </div>
                <div class="dash-imgs"><i data-feather="shopping-cart"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count das2">
                <div class="dash-counts">
                    <h4>{{ $stats['total_products'] ?? 0 }}</h4>
                    <h5>Total Products</h5>
                </div>
                <div class="dash-imgs"><i data-feather="package"></i></div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 col-12 d-flex">
            <div class="dash-count das3">
                <div class="dash-counts">
                    <h4>{{ $stats['total_purchases'] ?? 0 }}</h4>
                    <h5>Total Purchases</h5>
                </div>
                <div class="dash-imgs"><i data-feather="file-text"></i></div>
            </div>
        </div>
    </div>

    {{-- Chart Section --}}
    <div class="row mt-4">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Sales Overview (Last 7 Days)</h5>
                </div>
                <div class="card-body">
                   <div id="salesChart"></div>
                </div>
            </div>
        </div>

        {{-- Top Products --}}
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Top Selling Products</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive dataview">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Sold</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topProducts as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->total_sold }}</td>
                                        <td>₦{{ number_format($product->price, 2) }}</td>
                                    </tr>
                                @endforeach
                                @if($topProducts->isEmpty())
                                    <tr><td colspan="4" class="text-center">No data available</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ApexCharts Script --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'line',
                height: 450
            },
            series: [{
                name: 'Sales',
                data: @json($chartData['sales'])
            }],
            xaxis: {
                categories: @json($chartData['labels'])
            }
        };

        var chart = new ApexCharts(document.querySelector("#salesChart"), options);
        chart.render();
    });
</script>

</div>
