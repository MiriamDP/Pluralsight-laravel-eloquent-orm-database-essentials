<?php

namespace App\Http\Controllers;

use App\Models\JobCode;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function add(Request $request) {
        $request->validate([
            'name' => 'required|filled|max:255100|unique:job_codes',
            'billing_code' => 'required|filled|max:20',
        ]);
        $job = new JobCode();

        $job->name = $request->name;
        $job->billing_code = $request->billing_code;

        try {
            $job->save();
        } catch (\Throwable $th) {
            return back()
                ->withErrors(['Job Code could not be added.']);
        }
        return redirect(route('admin'))
            ->withSuccess('Job Code added.');
    }

    public function edit(Request $request) {
        $request->validate([
            'id' => 'required|integer|filled',
            'name' => 'required|filled|max:255100',
            'billing_code' => 'required|filled|max:20',
        ]);
        $job = JobCode::find($request->id);

        $job->name = $request->name;
        $job->billing_code = $request->billing_code;

        try {
            $job->save();
        } catch (\Throwable $th) {
            return back()
                ->withErrors(['Job Code could not be modified.']);
        }
        return redirect(route('admin'))
            ->withSuccess("Job Code modified.");
    }

    public function delete(Request $request) {
        $request->validate([
            'id' => 'required|integer|filled|exists:entries',
        ]);

        $job = JobCode::find($request->id);

        try {
            $job->delete();
        } catch (\Throwable $th) {
            return back()
                ->withErrors(['Could not delete Job Code.']);
        }

        return back()->withSuccess('Job Code deleted.');
    }
}
