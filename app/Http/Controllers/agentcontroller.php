<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class agentcontroller extends Controller
{
    public function agentdashboard(){
        return view('agent.agent_dashboard');
    }
}
