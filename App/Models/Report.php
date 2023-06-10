<?php

namespace App\Models;

class Report extends Model {
    protected $table_name = 'reports';

    public $reporter_id;
    public $problem_type_id;
    public $description;
    public $solved;
    public $reported_date;

    public function eagerLoad() {
        return [
            'id' => $this->id,
            'reporter' => User::get($this->reporter_id),
            'problemType' => ProblemType::get($this->problem_type_id),
            'description' => $this->description,
            'solved' => $this->solved,
            'reportedDate' => $this->reported_date
        ];
    }
}