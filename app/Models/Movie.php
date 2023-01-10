<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'image',
		'tags',
		'user_id',
		'director',
		'description',
	];

	public function quotes()
	{
		return $this->hasMany(Quote::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function scopeFilter($query, array $filters)
	{
		if ($filters['search'] ?? false)
		{
			if (app()->getLocale() === 'en')
			{
				$query->where('name->en', 'like', '%' . ucfirst($filters['search']) . '%');
			}
			if (app()->getLocale() === 'ka')
			{
				$query->where('name->ka', 'like', '%' . ucfirst($filters['search']) . '%');
			}
		}
	}
}
