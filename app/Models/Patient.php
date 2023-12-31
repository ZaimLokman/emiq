<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    public $timestamps = false;

	protected $fillable = [
		'name', 'ic_num', 'MRN', 'age',
	];

}
