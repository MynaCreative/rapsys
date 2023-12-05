<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Client\Response;
use Illuminate\Bus\Batchable;

use Illuminate\Support\Facades\Mail;
use App\Mail\Invoice as ModelMail;

use App\Models\InvoiceItem;
use App\Models\Workflow;
use App\Models\Approval;
use App\Models\Invoice;
use App\Models\WorkflowItem;

class InvoiceValidation implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable;

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
    public $timeout = 10000;
    public $memory = 2048;

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
            'total_amount' => $this->invoice->invoiceExpenses->sum('total_amount'),
            'total_amount_after_tax' => $this->invoice->invoiceExpenses->sum('total_amount_after_tax'),
            'total_amount_valid' => $this->invoice->invoiceExpenses->sum('total_valid_amount'),
            'total_amount_invalid' => $this->invoice->invoiceExpenses->sum('total_invalid_amount'),
        ]);

        // if ($this->invoice->document_status == 'published') {
        // $this->createApproval($this->invoice);
        // }
    }

    /**
     * Create approval
     */
    public function createApproval(Invoice $model, $reset = false)
    {
        $workflows = WorkflowItem::query()
            ->whereRelation('workflow', 'department_id', $model->department_id)
            ->whereBetween('range_from', [0, $model->total_amount_invalid])
            ->orWhereBetween('range_to', [0, $model->total_amount_invalid])
            ->orderBy('sequence')
            ->get();

        foreach ($workflows as $index => $item) {
            $position = null;
            if ($workflows->first()->id === $item->id) {
                $position = 'first';
            }
            if ($workflows->last()->id === $item->id) {
                $position = 'last';
            }
            Approval::create([
                'user_id' => $item->user_id,
                'workflow_id' => $item->workflow_id,
                'sequence' => $item->sequence,
                'workflow_item_id' => $item->id,
                'invoice_id' => $model->id,
                'status' => 'pending',
                'description' => $item->description,
                'current' => $index == 0,
                'position' => $position,
            ]);
            if ($index == 0) {
                Mail::to(auth()->user()->email)->send(new ModelMail($model, auth()->user()->email, 'created'));
                Mail::to($item->user->email)->send(new ModelMail($model, $item->user->email, 'approval'));
            }
        }
    }
}
