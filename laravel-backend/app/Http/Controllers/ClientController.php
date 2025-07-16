<?php

namespace App\Http\Controllers;

use App\Models\client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    public function getAllClient()
    {
        $client = Client::all();
         return  response ()->json($client,201);
    }

   
    public function createClient()
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients',
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
          ]);
        $client = Client::create($validated);
        return response()->json($client, 201);   
    }

    public function UpdateClient(client $client)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:clients,email,' . $client->id,
            'telephone' => 'nullable|string',
            'adresse' => 'nullable|string',
        ]);
        $client->update($validated);
        return response()->json($client);
    }

   
    public function deleteClient(client $client)
    {
         $client->delete();
        return response()->json(null, 204);
    }

    public function selectedClient( Request $Request){
         $client = Client::find($id);

    if (! $client) {
        return response()->json(['message' => 'Client introuvable'], 404);
    }

    return response()->json($client);

    }   

}
