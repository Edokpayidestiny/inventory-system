<x-layout>
    <x-navbar></x-navbar>
    <x-sidebar></x-sidebar>

    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product List</h4>
                        <h6>Manage Product Price</h6>

                    </div>
                    
                </div>

               @livewire('product-pricing')

            </div>
        </div>
    </div>

</x-layout>
