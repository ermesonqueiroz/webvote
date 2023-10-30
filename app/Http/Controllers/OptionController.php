<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function update(Request $request, int $optionId): void
    {
        $data = $request->only('votes_amount');
        Option::query()
            ->find($optionId)
            ->update($data);
    }
}
