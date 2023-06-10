<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Helper\AuthHelper;
use App\Models\Report;
use App\Models\User;
use PDOException;

class ReportController extends Controller {
    public function index() {
        AuthHelper::performAuthentication();
        $user = AuthHelper::getAuthenticatedUser();
        
        $role = strtolower($user->role);
        if ($role === 'admin') {
            $results = Report::getAll();
        } else if ($role === 'pengawas') {
            $users = User::findBySupervisorId($user->id);
            $users_id = array_values(array_map(fn ($user) => $user->id, $users));
            array_push($users_id, $user->id);

            $reports = Report::getAll();
            $filteredReports = array_values(array_filter($reports, function ($report) use ($users_id) {
                return in_array($report->reporter_id, $users_id);
            }));

            $results = $filteredReports;
        } else {
            $results = $user->reports();
        }

        $this->json(array_values(array_map(fn ($result) => $result->eagerLoad(), $results)));
    }

    public function store() {
        AuthHelper::performAuthentication();
        $body = file_get_contents('php://input');
        $data = json_decode($body);
        
        if (empty($data->description) || empty($data->problemTypeId) || empty($data->reportedDate)) {
            http_response_code(400);
            $this->json(['error' => 'semua harus diisi']);
            return;
        }

        // error_log(print_r($data, true));
        try {
            $report = new Report();
            $report->description = $data->description;
            $report->problem_type_id = $data->problemTypeId;
            $report->reported_date = $data->reportedDate;
            $report->reporter_id = AuthHelper::getAuthenticatedUser()->id;
            $report->solved = 0;

            $report->save();
            $this->json(['message' => 'success']);
        } catch(PDOException $ex) {
            error_log($ex->getMessage());
            http_response_code(500);
            $this->json(['error' => 'terdapat masalah saat menyimpan data']);
        }
    }

    public function update() {
        AuthHelper::performAuthentication();
    }

    public function destroy() {
        AuthHelper::performAuthentication();
    }
}