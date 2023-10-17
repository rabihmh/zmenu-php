<x-tenant-layout>
    <div id="menu-items">
        <div class="items-list-grid">
        </div>
    </div>
    @push('js')
        <script>
            const menuItemsListRoute = '{{ route('tenant.menu.items', ['table_number' => request()->route('table_number'), 'tenant' => getSubdomain()]) }}';
            const menuItemRoute = '{{ route('tenant.menu.items.show', ['table_number' => request()->route('table_number'), 'tenant' => getSubdomain(),'product_id'=>':productID']) }}';
            const addToCartRoute = '{{ route('tenant.cart.store', ['table_number' => request()->route('table_number'), 'tenant' => getSubdomain()]) }}';
            const assetUrl = '{{ asset('') }}';
            const csrfToken = '{{ csrf_token() }}';
        </script>
        <script src="{{asset('tenant/js/menu.js')}}"></script>
    @endpush
</x-tenant-layout>
