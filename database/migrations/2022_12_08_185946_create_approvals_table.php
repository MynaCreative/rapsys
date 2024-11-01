<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Workflow;
use App\Models\Invoice;
use App\Models\user;
use App\Models\WorkflowItem;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Workflow::class)->constrained();
            $table->foreignIdFor(WorkflowItem::class)->constrained();
            $table->foreignIdFor(Invoice::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('status')->nullable();
            $table->boolean('current')->default(false);
            $table->unsignedInteger('sequence');
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvals');
    }
};
