<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
	use HasFactory, HasTranslations;

	public $translatable = ['tags'];

	protected $fillable = [
		'tags',
	];

	public function movies()
	{
		return $this->belongsToMany(Movie::class, 'movie_tags');
	}
}
