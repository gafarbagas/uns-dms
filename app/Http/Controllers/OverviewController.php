<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class OverviewController extends Controller
{
    public function index() {
        if (Auth::user()->role == 'student') {
            $waiting = Submission::where('status', 'menunggu')->where('user_id', Auth::user()->id)->count();
            $approved = Submission::where('status', 'disetujui')->where('user_id', Auth::user()->id)->count();
            $rejected = Submission::where('status', 'ditolak')->where('user_id', Auth::user()->id)->count();
        } else {
            $waiting = Submission::where('status', 'menunggu')->count();
            $approved = Submission::where('status', 'disetujui')->count();
            $rejected = Submission::where('status', 'ditolak')->count();
        }
        return view('pages.overview', compact('waiting', 'approved', 'rejected'));
    }
}
