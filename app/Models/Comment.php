<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	use HasFactory;

	protected $fillable = [
		'quote_id',
		'comment',
		'user_id',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function quote()
	{
		$this->belongsTo(Quote::class);
	}
}
