<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Movie extends Model
{
	use HasFactory, HasTranslations;

	public $translatable = ['name', 'director', 'description'];

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

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'movie_tags');
	}

	public function scopeFilter($query, array $filters)
	{
		if ($filters['search'] ?? false)
		{
			$query->where('name->en', 'like', '%' . ($filters['search']) . '%')->orWhere('name->ka', 'like', '%' . ($filters['search']) . '%');
		}
	}
}
