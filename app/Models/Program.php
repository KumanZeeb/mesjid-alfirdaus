<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['name', 'schedule', 'icon_class', 'has_form'];

    protected $casts = [
        'has_form' => 'boolean',
    ];

    public function itikafForms()
    {
        return $this->hasMany(ItikafForm::class, 'program_id');
    }
}
