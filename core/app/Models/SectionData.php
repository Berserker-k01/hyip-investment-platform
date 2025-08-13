<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionData extends Model
{
    protected $table = 'section_data';
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
        'sections' => 'array',
    ];
}
