<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $response_detail = new \stdClass();

        try {
            $client   = new \GuzzleHttp\Client();
            $response = $client->request('GET', '127.0.0.1:5000/api/v1/task', [
                'verify'  => false,
            ]);

            $response_body                        = json_decode($response->getBody());
            $response_data                        = $response_body->data;
            $response_detail->body                = new \stdClass();
            $response_detail->body                = $response_data;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response_detail->error = $e->getMessage();
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $response_detail->error = $e->getMessage();
        } catch (\Exception $e) {
            $response_detail->error = $e->getMessage();
        }

        $data = $response_detail->body;


        return view('super2do', compact('data'));
    }
}
