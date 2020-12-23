<?php

namespace App\Http\Livewire;

use App\Models\Export;
use Livewire\Component;

class ShowExport extends Component
{
    public $counter;

    public $export;

    public function mount(Export $export)
    {
        $this->export = $export;
    }

    public function getListeners() {
        return [
            "echo:export-status.{$this->export->id},ExportReady" => 'updateStatus',
        ];
    }

    public function render()
    {
        return view('livewire.show-export');
    }

    public function updateStatus()
    {
        $this->export = Export::find($this->export->id);
    }
}
