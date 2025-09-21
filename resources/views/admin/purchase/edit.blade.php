<x-layout>
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>

     <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Edit Purchase</h4>
                    <h6>Update purchase details</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    {{-- Load Livewire component --}}
                    <livewire:purchase-edit :purchase="$purchase" />
                </div>
            </div>
        </div>
    </div>

</x-layout>
