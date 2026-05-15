<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use App\Services\NumerologyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NumerologyController extends Controller
{
    public function __construct(private readonly NumerologyService $numerology)
    {
    }

    public function clients(Request $request): JsonResponse
    {
        return response()->json(Client::where('user_id', $request->user()->id)->latest()->with('reports')->get());
    }

    public function storeClient(Request $request): JsonResponse
    {
        $data = $request->validate([
            'full_name' => ['required', 'string', 'max:160'],
            'birth_date' => ['required', 'date'],
            'phone' => ['nullable', 'string', 'max:40'],
            'email' => ['nullable', 'email', 'max:160'],
            'notes' => ['nullable', 'string'],
        ]);

        $client = Client::create($data + ['user_id' => $request->user()->id]);
        $report = $client->reports()->create($this->numerology->buildReport($client->full_name, $client->birth_date->toDateString()));

        return response()->json(['client' => $client, 'report' => $report], 201);
    }

    public function report(Request $request, Client $client): JsonResponse
    {
        abort_unless($client->user_id === $request->user()->id, 403);

        $report = $client->reports()->latest()->first()
            ?: $client->reports()->create($this->numerology->buildReport($client->full_name, $client->birth_date->toDateString()));

        return response()->json(['client' => $client, 'report' => $report]);
    }

    public function pay(Request $request, Client $client): JsonResponse
    {
        abort_unless($client->user_id === $request->user()->id, 403);

        $data = $request->validate(['amount' => ['required', 'numeric', 'min:1']]);
        $payment = Payment::create([
            'user_id' => $request->user()->id,
            'client_id' => $client->id,
            'amount' => $data['amount'],
            'currency' => 'USD',
            'status' => 'paid',
            'reference' => 'NUM-' . Str::upper(Str::random(8)),
        ]);

        return response()->json(['payment' => $payment], 201);
    }
}
