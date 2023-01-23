<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;

class UserProfileController extends Controller
{
	public function index()
	{
		$userInfo = User::where('id', auth()->user()->id)->with(['emails' => function ($email) {
			return $email->select('id', 'email', 'email_verified_at', 'is_primary', 'user_id');
		}])->select('id', 'name', 'image', 'google_id')->first();

		return response()->json($userInfo, 200);
	}

	public function put(ProfileUpdateRequest $request)
	{
		$data = $request->validated();

		$user = User::find(auth()->user()->id);

		if ($request->hasFile('image'))
		{
			$image['image'] = $request->file('image')
			->store('images', 'public');

			$data['image'] = asset('storage/' . $image['image']);
		}

		$user->setAttribute('name', $data['name'])->setAttribute('image', $data['image'])->save();

		return response()->json($user, 200);
	}
}