<?php

namespace App\Models;

use App\Scopes\OnlyClientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timesheet extends Model
{
    use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new OnlyClientScope);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'metadata',
        'grossWages',
        'checkDate',
        'startPaymentPeriod',
        'endPaymentPeriod',
        'state',
        'clientId'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    /**
     * Get the client for the timesheet.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'clientId');
    }
}
