<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class AudioController extends Controller
{
    /*
     * 
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('audio.index');
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function convert(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:2500', 
        ]);

        $apiKey = 'sk_8f38c5a6219b9e4cd05eb441d38615cb3e82d5447bb1bd2b';
        $text = $request->input('text');
        
        
        $voiceId = 'xWdpADtEio43ew1zGxUQ';
        $endpoint = "https://api.elevenlabs.io/v1/text-to-speech/{$voiceId}";

        try {
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'xi-api-key' => $apiKey, 
            ])->post($endpoint, [
                'text' => $text,
                'model_id' => 'eleven_multilingual_v2',
                'voice_settings' => [
                    'stability' => 0.5,
                    'similarity_boost' => 0.5,
                ],
            ]);

            if ($response->successful()) {
                
                return response($response->body())
                    ->header('Content-Type', 'audio/mpeg');
            } else {
                
                $errorBody = $response->json();
                $errorMessage = 'Erro ao se conectar à API da ElevenLabs.';

                if (is_array($errorBody) && isset($errorBody['detail']['message'])) {
                    $errorMessage = 'Erro da API: ' . $errorBody['detail']['message'];
                }
                
                // Adiciona um log mais detalhado para ajudar a depuração - Feito no Gemini para poder me ajudar a achar o por que não funcionava :(
                Log::error($errorMessage, [
                    'status' => $response->status(), 
                    'response_body' => $response->body(),
                    'headers' => $response->headers()
                ]);

                return response()->json(['error' => $errorMessage], $response->status());
            }

        } catch (Exception $e) {
            Log::error('Exceção na chamada da API ElevenLabs:', ['exception' => $e->getMessage()]);
            return response()->json(['error' => 'Ocorreu um erro ao processar sua solicitação.'], 500);
        }
    }
}