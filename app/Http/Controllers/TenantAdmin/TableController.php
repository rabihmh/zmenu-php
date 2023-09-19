<?php

namespace App\Http\Controllers\TenantAdmin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use App\Services\QrCodeService;
use App\Traits\DeleteImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TableController extends Controller
{
    use DeleteImageTrait;

    /**
     * Display a listing of the resource.
     */
    private QrCodeService $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    public function index(): View
    {

        $tables = Table::query()->paginate('12');
        return view('tenantadmin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('tenantadmin.tables.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $request->validate([
                'table_number' => 'nullable',
                'description' => 'required|string|max:255',
                'capacity' => 'required|numeric'
            ]);
            $tableNumber = $request->input('table_number') ?? (Table::query()->max('table_number') + 1);
            $qrCodePath = $this->qrCodeService->generate($tableNumber);

            $table = new Table();
            $table->table_number = $tableNumber;
            $table->description = $request->input('description');
            $table->capacity = $request->input('capacity');
            $table->qr_code_path = $qrCodePath;
            $table->save();

            return redirect()->back()->with('success', 'Table Created Successfully');
        } catch (\Exception $e) {
            Log::error("Table creation error: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurring during creation table');
        }
    }

    /**
     * Display the specified resource.
     */
    public
    function show(string $id)
    {
        $table = Table::findOrFail($id);
        return view('tenantadmin.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(string $id)
    {
        $table = Table::findOrFail($id);
        return view('tenantadmin.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $table = Table::query()->findOrFail($id);
        try {
            $request->validate([
                'table_number' => 'nullable|numeric',
                'description' => 'required|string|max:255',
                'capacity' => 'required|numeric'
            ]);

            // Check if the 'table_number' has changed
            if ($request->has('table_number') && $request->input('table_number') != $table->table_number) {
                // Generate a new QR code image and delete old if exists
                if ($table->qr_code_path)
                    $this->deleteImage($table->qr_code_path);
                $qrCodePath = $this->qrCodeService->generate($request->input('table_number'));
                $table->qr_code_path = $qrCodePath;
            }

            // Update the table's attributes
            $table->description = $request->input('description');
            $table->capacity = $request->input('capacity');

            $table->save();

            return redirect()->back()->with('success', 'Table Updated Successfully');
        } catch (\Exception $e) {
            Log::error("Table update error: " . $e->getMessage());
            return redirect()->back()->with('error', 'Table Update Failed');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        $table = Table::findOrFail($id);
        if ($table->qr_code_path) {
            $this->deleteImage($table->qr_code_path);
        }
        $table->delete();
        return redirect()->route('tenant.admin.tables.index')->with('success', 'Table Deleted Successfully');
    }

}
