<?php

namespace App\Http\Livewire;

use App\Models\Import;
use Livewire\Component;

class ShowImport extends Component
{
    public $import;

    public function mount(Import $import)
    {
        $this->import = $import;
    }

    public function getListeners() {
        return [
            "echo:import-status.{$this->import->id},ImportReady" => 'updateStatus',
        ];
    }

    public function render()
    {
        return view('livewire.show-import');
    }

    public function updateStatus()
    {
        $this->import = Import::find($this->import->id);
    }
}
