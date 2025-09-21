<div>
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="update">
        <h5>Editing Purchase #{{ $purchase->invoice_no }}</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label>Supplier</label>
                <input type="text" class="form-control" wire:model="supplier">
            </div>
            <div class="col-md-6">
                <label>Purchase Date</label>
                <input type="date" class="form-control" wire:model="purchase_date">
            </div>
        </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea class="form-control" wire:model="notes"></textarea>
        </div>

        <h5 class="mt-4">Purchase Items</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Current Qty</th>
                    <th>Action</th>
                    <th>Adjust Qty</th>
                    <th>New Qty</th>
                    <th>Cost Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $row)
                    <tr>
                        <td>{{ $row['product_name'] }}</td>
                        <td>{{ $row['current_qty'] }}</td>

                        <!-- Action -->
                        <td>
                            <select class="form-control action-select"
                                wire:model="items.{{ $index }}.adjustmentType" data-id="{{ $row['id'] }}">
                                <option value="">Select</option>
                                <option value="increase">Increase</option>
                                <option value="decrease">Decrease</option>
                            </select>
                        </td>

                        <!-- Adjustment Qty (hidden until action selected) -->
                        <td>
                            <input type="number" min="0" wire:model="items.{{ $index }}.adjustmentQty"
                                id="qty-input-{{ $row['id'] }}" class="form-control qty-input"
                                style="display: {{ $row['adjustmentType'] ? 'block' : 'none' }};">
                        </td>

                        <!-- New Qty (readonly, shows calculated value) -->
                        <td>
                            <input type="number" class="form-control" wire:model="items.{{ $index }}.new_qty" readonly>
                        </td>

                        <!-- Cost Price -->
                        <td>
                            <input type="number" step="0.01"
                                wire:model.defer="items.{{ $index }}.new_cost_price" class="form-control"
                                placeholder="{{ isset($row['original_cost_price']) ? number_format($row['original_cost_price'], 2) : '' }}">

                            @if (isset($row['original_cost_price']))
                                <small class="text-muted">Original:
                                    {{ number_format($row['original_cost_price'], 2) }}</small>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Update Purchase</button>
    </form>

    <!-- Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".action-select").forEach(select => {
                select.addEventListener("change", function() {
                    let itemId = this.getAttribute("data-id");
                    let qtyInput = document.getElementById("qty-input-" + itemId);

                    if (this.value === "increase" || this.value === "decrease") {
                        qtyInput.style.display = "block"; // Show input immediately
                    } else {
                        qtyInput.style.display = "none"; // Hide if "Select"
                    }
                });
            });
        });
    </script>
</div>
