<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = ['name', 'email', 'logo', 'website'];
    public $timestamps = true;
    protected $appends = ['logo_name'];

    protected function logoName(): Attribute
    {
        return Attribute::make(
                get: fn ($value) => substr($this->logo, strrpos($this->logo, '.com')+5)
        );
    }
}
