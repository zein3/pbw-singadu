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

    }

    public function destroy() {

    }
}