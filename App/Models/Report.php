<?php

namespace App\Models;

class Report extends Model {
    protected $table_name = 'reports';

    public $reporter_id;
    public $problem_type_id;
    public $description;
    public $solved;
    public $reported_date;
}