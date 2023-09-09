<x-tenant-admin-layout title="Tables">
    @push('css')
        <style>
            .status-occupied {
                background-color: #dc3545;
                color: white;
            }

            .status-available {
                background-color: #28a745;
                color: white;
            }

            .status-reserved {
                background-color: #ffc107;
                color: black;
            }

            .status-closed {
                background-color: #6c757d;
                color: white;
            }

            a, a:hover {
                text-decoration: none;
            }
        </style>
    @endpush
    <h1 class="text-center">Tables</h1>
    <div class="container">
        <div class="row">
            @foreach($tables as $table)
                <div class="col-md-4 mt-4">
                    <div class="card">
                        <a href="{{ route('tenant.admin.tables.show', ['table' => $table->id]) }}">

                            <div class="card-header">
                                Table #{{ $table->table_number }}
                            </div>
                            <div class="card-body">
                                <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 100 125"
                                     x="0px"
                                     y="0px">
                                    <title>06</title>
                                    <path
                                        d="M8.92,53.12V75.85a3,3,0,0,0,6,0v-20H34.59v20a3,3,0,0,0,6,0v-23a3,3,0,0,0-3-3H14.36L8.87,23.54A3,3,0,1,0,3,24.76Z"/>
                                    <path
                                        d="M94.6,21.2a3,3,0,0,0-3.48,2.42l-4.69,26.2H63.26a3,3,0,0,0-3,3v23a3,3,0,0,0,6,0v-20H85.94v20a3,3,0,0,0,6,0V53.08L97,24.68A3,3,0,0,0,94.6,21.2Z"/>
                                    <path
                                        d="M70,38.27a3,3,0,0,0,0-6H30.85a3,3,0,1,0,0,6H47.43V75.85a3,3,0,0,0,6,0V38.27Z"/>
                                </svg>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div>
                                    Status:
                                    <span class="status-{{ strtolower($table->status) }}">
                                {{ ucfirst($table->status) }}
                            </span>
                                </div>
                                <div class="d-flex">
                                    <form method="POST"
                                          action="{{ route('tenant.admin.tables.destroy', ['table' => $table->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                        <a href="{{ route('tenant.admin.tables.edit', $table->id) }}" class="btn btn-link text-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $tables->withQueryString()->links() }}
    </div>
</x-tenant-admin-layout>
