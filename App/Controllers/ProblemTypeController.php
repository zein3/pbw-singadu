<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ProblemType;
use App\Helper\AuthHelper;

class ProblemTypeController extends Controller {
    public function index() {
        AuthHelper::performAuthentication();
        $this->json(ProblemType::getAll());
    }

    public function store() {
        $body = file_get_contents("php://input");
        $data = json_decode($body);

        if (empty($data->name)) {
            http_response_code(400);
            $this->json(['nama' => "tidak boleh kosong"]);
            return;
        }

        $ptype = new ProblemType();
        $ptype->name = $data->name;
        $ptype->save();
        $this->json(['message' => 'success']);
    }

    public function destroy() {
        $ptype = ProblemType::get($this->route_params['id']);
        if ($ptype == null) {
            http_response_code(404);
            $this->json(['error' => 'jenis masalah tidak ditemukan']);
            return;
        }

        // error_log(print_r($ptype, true));
        $ptype->delete();
        $this->json(['message' => 'success']);
    }
}