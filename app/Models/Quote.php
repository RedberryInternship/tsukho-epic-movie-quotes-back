<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Quote extends Model
{
	use HasFactory, HasTranslations;

	public $translatable = ['quote'];

	protected $fillable = [
		'quote',
		'image',
		'movie_id',
	];

	public function movie()
	{
		return $this->belongsTo(Movie::class);
	}

	public function likes()
	{
		return $this->hasMany(Like::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function scopeFilter($query, array $filters)
	{
		if ($filters['search'] ?? false)
		{
			if (app()->getLocale() === 'en')
			{
				if ($filters['search'][0] === '@')
				{
					$query->whereHas(
						'movie',
						fn ($query) => $query->where('name->en', 'like', '%' . ltrim($filters['search'], '@') . '%')
					);
				}

				if ($filters['search'][0] === '#')
				{
					$query->where('quote->en', 'like', '%' . ltrim($filters['search'], '#') . '%');
				}
			}
			if (app()->getLocale() === 'ka')
			{
				if ($filters['search'][0] === '@')
				{
					$query->whereHas(
						'movie',
						fn ($query) => $query->where('name->ka', 'like', '%' . ltrim($filters['search'], '@') . '%')
					);
				}

				if ($filters['search'][0] === '#')
				{
					$query->where('quote->ka', 'like', '%' . ltrim($filters['search'], '#') . '%');
				}
			}
		}
	}
}
