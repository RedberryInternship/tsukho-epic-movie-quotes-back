<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
	use HasFactory;

	public $table = 'email';

	protected $fillable = ['email', 'is_primary', 'user_id', 'verification_token'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
