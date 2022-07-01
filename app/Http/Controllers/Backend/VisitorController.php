<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;

class VisitorController extends Controller
{
    public function GetVisitorDetails() {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $visit_time = date('M d, Y');
        $visit_date = date('g:i A');

        $result = Visitor::insert([
            'ip_address' => $ip_address,
            'visit_time' => $visit_time,
            'visit_date' => $visit_date
        ]);

        return $result;
    }
}
