<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'electric_usage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the user that owns the usage.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the meter that the usage belongs to.
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }
}
