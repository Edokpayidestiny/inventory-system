<x-layout>
    <x-navbar></x-navbar>

    <x-sidebar></x-sidebar>

    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product List</h4>
                        <h6>Manage your products</h6>

                    </div>
                    <div class="page-btn">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-added"><img
                                src="{{ asset('assets/img/icons/plus.svg') }}" alt="img" class="me-1">Add New
                            Product</a>
                    </div>
                </div>

               @livewire('product-search')

            </div>
        </div>
    </div>

</x-layout>
