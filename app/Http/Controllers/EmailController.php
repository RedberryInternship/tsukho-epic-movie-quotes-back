<?php

namespace App\Http\Controllers;

use App\Models\Email;

class EmailController extends Controller
{
	public function makePrimary(Email $id)
	{
		$previousPrimary = Email::where([['is_primary', true], ['user_id', auth()->user()->id]])->first();

		$previousPrimary->setAttribute('is_primary', false)->save();

		$id->setAttribute('is_primary', true)->save();

		return response()->json(['message' => 'primary email updated successfully'], 200);
	}

	public function destroy(Email $id)
	{
		$id->delete();

		return response()->json(['message' => 'email deleted successfully'], 200);
	}
}
