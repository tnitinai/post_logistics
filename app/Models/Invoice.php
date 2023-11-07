<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'Invoice';
    protected $primaryKey = 'invoice_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['invoice_id', 'price', 'created_at', 'printed_by'];

    /**
     * Get all of the packages for the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packages(): HasMany
    {
        return $this->hasMany(Package::class, 'invoice_id', 'invoice_id');
    }

    /**
     * Get the user that prints the Invoice
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'printed_by', 'id');
    }


    public function scopeGenerateInvoice($q, $sum_price): string
    {
        $invoice_id = Carbon::now()->format('ymdHis') . rand(10000, 99999);

        $data = [
            'invoice_id' => $invoice_id,
            'price' => $sum_price,
            'created_at' => Carbon::now()->toDateTime(),
            'printed_by' => Auth::user()->id,
        ];

        $invoice = $this->create($data);
        return $invoice->invoice_id;
    }
}
