<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Quote;

class QuoteController extends Controller
{
	public function put(UpdateQuoteRequest $request)
	{
		$data = $request->validated();

		$newQuoteTranslations = ['en' => $data['quote-en'], 'ka' => $data['quote-ka']];

		if ($request->hasFile('image'))
		{
			$text['image'] = $request->file('image')
			->store('images', 'public');
			$data['image'] = asset('storage/' . $text['image']);
		}

		$quote = Quote::find($request->id);

		$quote->replaceTranslations('quote', $newQuoteTranslations)->setAttribute('image', $data['image'])
		->save();

		return response()->json(['message' => 'quote data updated successfully'], 200);
	}

	public function destroy(Quote $id)
	{
		$id->delete();

		return response()->json(['message' => 'quote deleted successfully'], 200);
	}
}
