<?php

class DatabaseApiClient
{
    private $apiUrl; // URL base de la API
    private $apiKey; // Clave API, si es necesaria

    
    public function __construct($apiUrl, $apiKey = null)
    {
        $this->apiUrl = rtrim($apiUrl, '/'); 
        $this->apiKey = $apiKey;
    }

    // Método para realizar una solicitud GET a la API
    public function get($endpoint, $params = [])
    {
        $url = $this->apiUrl . '/' . $endpoint . '?' . http_build_query($params);
        
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

       
        if ($this->apiKey) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer " . $this->apiKey
            ]);
        }

      
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

       
        if (curl_errno($ch)) {
            throw new Exception("cURL error: " . curl_error($ch));
        }
        curl_close($ch);

        
        $data = json_decode($response, true);

      
        if ($httpCode !== 200) {
            throw new Exception("Error en la solicitud: Código HTTP " . $httpCode);
        }

        return $data;
    }

   
    public function post($endpoint, $data = [])
    {
        $url = $this->apiUrl . '/' . $endpoint;
    
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
       
        if (curl_errno($ch)) {
            throw new Exception("cURL error: " . curl_error($ch));
        }
        
        curl_close($ch);
    
        
        if ($response === false) {
            throw new Exception("Error: No response from API");
        }
    
       
        $data = json_decode($response, true);
    
        
        if ($httpCode !== 200 && $httpCode !== 201) {
            throw new Exception("Error en la solicitud: Código HTTP " . $httpCode);
        }
    
        
        if ($data === null) {
            throw new Exception("Error al decodificar la respuesta JSON: " . json_last_error_msg());
        }
    
        return $data;
    }
    

    // Método para realizar una solicitud PUT a la API
    public function put($endpoint, $data = [])
    {
        $url = $this->apiUrl . '/' . $endpoint;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

       
        if ($this->apiKey) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer " . $this->apiKey,
                "Content-Type: application/json"
            ]);
        }

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        
        if (curl_errno($ch)) {
            throw new Exception("cURL error: " . curl_error($ch));
        }
        curl_close($ch);

        
        $data = json_decode($response, true);

        
        if ($httpCode !== 200) {
            throw new Exception("Error en la solicitud: Código HTTP " . $httpCode);
        }

        return $data;
    }

    // Método para realizar una solicitud DELETE a la API
    public function delete($endpoint, $data = [])
    {
        $url = $this->apiUrl . '/' . $endpoint;

        // Inicializa cURL
        $ch = curl_init($url);
        
        // Configura cURL para usar el método DELETE
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");  // Usamos DELETE en lugar de POST
        if (!empty($data)) {
            // Si hay datos a enviar, conviértelos a JSON
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        
        // Ejecuta la solicitud
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        // Manejo de errores
        if (curl_errno($ch)) {
            throw new Exception("cURL error: " . curl_error($ch));
        }
        
        curl_close($ch);
        
       
    // Si la respuesta es falsa, es un error en la API
    if ($response === false) {
        return [
            'status' => 'error',
            'mensaje' => 'No se recibió respuesta de la API.'
        ];
    }

    // Decodifica la respuesta JSON
    $data = json_decode($response, true);

    // Verifica si hubo un error al decodificar el JSON
    if ($data === null) {
        return [
            'status' => 'error',
            'mensaje' => 'Erro no se encuentra el Servicio'
        ];
    }

    // Verifica si el código HTTP es 200 (éxito) o 204 (sin contenido)
    if ($httpCode !== 200 && $httpCode !== 204) {
        return [
            'status' => 'error',
            'mensaje' => 'Servicio no eliminado. Verifique la selección.'
        ];
    }
        return $data;
    
    }
    
    }