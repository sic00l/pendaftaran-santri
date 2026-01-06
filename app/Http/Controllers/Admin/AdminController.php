<?php

namespace App\Http\Controllers\Admin;

	use App\Http\Controllers\Controller;
	use App\Models\Santri;
	use Illuminate\Http\Request;

	class AdminController extends Controller
	{
	    /**
	     * Display Admin Dashboard
	     */
	    public function dashboard()
	    {
	        $breadcrumbs = [
	            ['label' => 'Dashboard', 'url' => ''],
	        ];

	        $pendingCount = Santri::status('pending')->count();

	        return view('admin.dashboard', compact('breadcrumbs', 'pendingCount'));
	    }

	    /**
	     * Other stubs for missing pages
	     */
	    public function verification() { return view('admin.verification.index'); }
	    public function payment() { return view('admin.payment.index'); }
	    public function reports() { return view('admin.reports.index'); }
	    public function settings() { return view('admin.settings.index'); }
	    public function users() { return view('admin.users.index'); }
	    public function profile() { return view('admin.profile.edit'); }
	}
	
