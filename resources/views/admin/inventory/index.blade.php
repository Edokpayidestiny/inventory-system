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

           @livewire('inventory-search')

        </div>
    </div>

</x-layout>
