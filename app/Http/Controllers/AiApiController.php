<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AiApiController extends Controller
{
    public function ask(Request $request)
    {
        $question = $request->input('question');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('services.ai.url') . "/ask", [
            'question' => $question,
        ]);
        return response()->json([
            'answer' => $response['answer'] ?? 'No answer found.',
        ]);
    }
}
