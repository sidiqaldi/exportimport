<?php

namespace App\Jobs;

use App\Events\ImportReady;
use App\Imports\UsersImport;
use App\Models\Import;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $import;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::import(new UsersImport, $this->import->storage);

        $this->import->status = 'finish';

        $this->import->save();

        event(new ImportReady($this->import->id));

    }

     /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        $this->import->status = 'failed';

        $this->import->save();

        event(new ImportReady($this->import->id));
    }
}
