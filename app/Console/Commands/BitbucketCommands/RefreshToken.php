<?php

namespace App\Console\Commands\BitbucketCommands;

use App\Enums\SourceCodeProvider;
use App\Models\SourceCodeAccount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RefreshToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bitbucket:refresh-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh expired Bitbucket access tokens';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TODO: revisar y modificar los clientIds y clientSecret por los del usuario
        $accounts = SourceCodeAccount::where('provider', SourceCodeProvider::Bitbucket)
            ->where('expires_at', '<=', now()->subMinutes(4))->get();

        $accounts->each(function ($account, $key) {
            $refreshToken = $account->refresh_token;
            $clientId =  env('BITBUCKET_CLIENT_ID');
            $clientSecret = env('BITBUCKET_CLIENT_SECRET');

            $data = [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
            ];

            $authHeader = base64_encode("$clientId:$clientSecret");
            $headers = [
                'Authorization: Basic ' . $authHeader,
                'Content-Type: application/x-www-form-urlencoded',
            ];

            // Convertir los datos en formato de cadena
            $fieldsString = http_build_query($data);

            $url = 'https://bitbucket.org/site/oauth2/access_token';

            // Iniciar sesión cURL
            $ch = curl_init();

            // Configurar las opciones de cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fieldsString);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Ejecutar la solicitud cURL y obtener la respuesta
            $response = curl_exec($ch);

            if ($response) {
                $response = json_decode($response, true);
                $account->access_token = $response['access_token'];
                $account->expires_at = now()->addSeconds($response['expires_in']);
                $account->save();
            }

            // Cerrar la sesión cURL
            curl_close($ch);
        });
    }
}
