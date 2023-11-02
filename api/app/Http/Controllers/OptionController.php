<?php

namespace App\Http\Controllers;

use App\Events\VoteProcessed;
use App\Models\Option;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OptionController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Option::all());
    }

    public function update(Request $request, int $optionId): void
    {
        $data = $request->only('votes_amount');
        Option::find($optionId)->update($data);

        VoteProcessed::dispatch(Option::find($optionId));
    }
}
