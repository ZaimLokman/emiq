<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
	use HasFactory;

    protected $table = 'appointments';
    public $timestamps = false;

	protected $fillable = [
		'code', 'appt_datetime', 'patient_id', 'created_at', 'arrived_at', 'status',
	];

	public function patient()
	{
		return $this->belongsTo(Patient::class);
	}

}
