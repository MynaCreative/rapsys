<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Client\Response;

use App\Models\InvoiceItem;
use App\Models\Workflow;
use App\Models\Approval;
use App\Models\Invoice;

class InvoiceValidation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The invoice instance.
     *
     * @var \App\Models\Invoice
     */
    public $invoice;

    /**
     * The number of seconds the job can run before timing out.
     * php artisan queue:listen --tries=3 --memory=1024 --timeout=6300
     *
     * @var int
     */
    public $timeout = 6300;
    public $memory = 1024;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->invoice->update([
            'total_item' => count($this->invoice->items),
            'total_amount' => $this->invoice->items->sum('amount'),
            'total_amount_valid' => InvoiceItem::where('invoice_id', $this->invoice->id)->where('validation_score', 5)->get()->sum(function ($item) {
                return $item->amount;
            }),
            'total_amount_invalid' => InvoiceItem::where('invoice_id', $this->invoice->id)->where('validation_score', '!=', 5)->get()->sum(function ($item) {
                return $item->amount;
            }),
            'total_amount_after_tax' => $this->invoice->items->sum('total'),
            'total_amount_after_tax_valid' => InvoiceItem::where('invoice_id', $this->invoice->id)->where('validation_score', 5)->get()->sum('total'),
            'total_amount_after_tax_invalid' => InvoiceItem::where('invoice_id', $this->invoice->id)->where('validation_score', '!=', 5)->get()->sum('total')
        ]);

        if ($this->invoice->document_status == 'published') {
            $this->createApproval($this->invoice);
        }
    }

    /**
     * Create approval
     */
    public function createApproval(Invoice $model, $reset = false)
    {
        $workflows = Workflow::query()
            ->whereBetween('range_from', [0, $model->total_amount])
            ->orWhereBetween('range_to', [0, $model->total_amount])
            ->orderBy('sequence')
            ->get();

        foreach ($workflows as $index => $workflow) {
            $position = null;
            if ($workflows->first()->id === $workflow->id) {
                $position = 'first';
            }
            if ($workflows->last()->id === $workflow->id) {
                $position = 'last';
            }
            Approval::create([
                'workflow_id' => $workflow->id,
                'invoice_id' => $model->id,
                'user_id' => $workflow->user_id,
                'current' => $workflows->first()->id === $workflow->id,
                'position' => $position,
                'sequence' => $index + 1
            ]);
        }
    }
}
