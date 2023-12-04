<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',        
        'whatsapp',        
        'person_id',
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'whatsapp' => 'string',
        'person_id' => 'integer',
    ];

    public function person() : BelongsTo {
        return $this->belongsTo(Person::class);
    }
}
