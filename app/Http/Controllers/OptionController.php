<?php

namespace App\Http\Controllers;

use App\Events\VoteProcessed;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function update(Request $request, int $optionId): void
    {
        $data = $request->only('votes_amount');

        $option = Option::find($optionId);
        $option->update($data);

        VoteProcessed::dispatch($option);
    }
}
