<x-tenant-layout>
    <div id="menu-items">
        <div class="items-list-grid">
        </div>
    </div>
    @push('js')
        <script>
            const menuItemsListRoute = '{{ route('tenant.menu.items', getSubdomain()) }}';
            const menuItemRoute = '{{route('tenant.menu.items.show',getSubdomain())}}';
            const assetUrl = '{{ asset('storage/') }}';
            const csrfToken = '{{ csrf_token() }}';
        </script>
        <script src="{{asset('tenant/js/menu.js')}}"></script>
    @endpush
</x-tenant-layout>
