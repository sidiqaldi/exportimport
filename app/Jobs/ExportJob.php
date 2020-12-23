<?php

namespace App\Jobs;

use App\Events\ExportReady;
use App\Exports\UserExport;
use App\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class ExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $export;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Export $export)
    {
        $this->export = $export;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Excel::store(new UserExport, $this->export->storage . '.xlsx');

        $this->export->status = 'finish';

        $this->export->save();

        event(new ExportReady($this->export->id));
    }
}
