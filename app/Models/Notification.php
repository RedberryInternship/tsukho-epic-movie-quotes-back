<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	use HasFactory;

	protected $fillable = ['user_id', 'quote_id', 'person_id', 'is_comment', 'is_new'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
