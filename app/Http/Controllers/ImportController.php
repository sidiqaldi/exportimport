<?php

namespace App\Http\Controllers;

use App\Jobs\ImportJob;
use App\Models\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    public function index()
    {
        $imports = Import::orderBy('created_at', 'desc')->paginate(10);

        return view('import', compact('imports'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'upload_file' => 'required|file|max:5000|mimes:xlsx,xls',
        ])->validate();

        $import = new Import();

        $import->filename = $request->file('upload_file')->getClientOriginalName();

        $import->storage = $request->file('upload_file')->store('imports');

        $import->status = 'processing';

        $import->save();

        ImportJob::dispatch($import)->delay(now()->addSecond(5));

        return redirect()->route('imports.index');
    }
}
