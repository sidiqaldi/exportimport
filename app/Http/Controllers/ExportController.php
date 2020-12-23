<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Jobs\ExportJob;
use App\Models\Export;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function index()
    {
        $exports = Export::orderBy('created_at', 'desc')->paginate(10);

        return view('export', compact('exports'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'filename' => 'required|max:255',
        ])->validate();

        $export = new Export();

        $export->filename = $request->filename;

        $export->storage = Str::random(40);

        $export->status = 'processing';

        $export->save();

        ExportJob::dispatch($export)->delay(now()->addSecond(5));

        return redirect()->route('exports.index');
    }

    public function show(Export $export)
    {
        if ($export->status == 'processing') {
            return redirect()->route('exports.index');
        }

        return Storage::download($export->storage . '.xlsx', Str::snake($export->filename) . '.xlsx');
    }
}
