<x-layout>
    <x-navbar></x-navbar>

    <x-sidebar></x-sidebar>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Inventory</h4>
                    <h6>View/Search Inventory</h6>
                </div>

            </div>

            <div class="card">
                <div class="card-body">
                    
                    
                    <div class="table-responsive">
                        <table class="table  datanew">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Previous Quantity</th>
                                    <th>New Quantity</th>
                                    <th>Adjusted By</th>
                                    {{-- <th>Note</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adjustmentHistories as $adjustmentHistory)
                                    <tr>
                                        <td>{{ $adjustmentHistory->created_at }}</td>
                                        <td>{{ $adjustmentHistory->adjustment_type }}</td>
                                        <td>{{ $adjustmentHistory->previous_qty }}</td>
                                        <td>{{ $adjustmentHistory->new_qty }}</td>
                                        <td>{{ $adjustmentHistory->user->name }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>``
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-layout>
