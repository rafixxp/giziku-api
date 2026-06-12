<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GroupTarget;

class TargetController extends Controller
{
    public function index(){
        $group = GroupTarget::get();
        return response()->json([
            'message' => 'success',
            'data' => $group
        ], 200);
    }
}
