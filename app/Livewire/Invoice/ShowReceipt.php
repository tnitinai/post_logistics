<?php

namespace App\Livewire\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class ShowReceipt extends Component
{
    public $invoice;
    public $packages;

    public function mount(Invoice $invoice_id)
    {
        $this->invoice = $invoice_id;
        $this->packages = $this->invoice->packages;
    }

    public function render()
    {
        return view('livewire.invoice.show-receipt');
    }
}
