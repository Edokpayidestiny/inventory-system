<x-layout>
    <x-navbar></x-navbar>
<script>
    window.addEventListener('sale-success', event => {
        Swal.fire({
            icon: "success",
            title: "Sale completed successfully",
            text: event.detail.message,
        });
    });
</script>
<script>
    window.addEventListener('sale-error', event => {
        Swal.fire({
            icon: "error",
            title: "Insufficient stock",
            text: event.detail.message,
        });
    });
</script>
    <div class="main-wrappers">
        <div class="page-wrapper ms-0">
            <div class="content">
                <div class="row">
                    @livewire('pos-products')




                </div> <!-- End row -->
            </div> <!-- End content -->
        </div> <!-- End page-wrapper -->
    </div> <!-- End main-wrappers -->

</x-layout>
