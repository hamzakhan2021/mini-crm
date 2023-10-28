<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\CompanyStoreRequest;
use App\Http\Requests\Companies\CompanyUpdateRequest;
use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Facades\Storage;
use App\Jobs\SendEmailJob;
use GuzzleHttp\Psr7\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return CompanyResource::collection($companies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyStoreRequest $request)
    {
        $data = $request->validated();

        // Handle logo file upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('public/company_logos');

            // Generate a public URL for the logo
            $logoUrl = Storage::url($logoPath);

            $data['logo'] = $logoUrl;
        }

        $company = Company::create($data);

        // Notify admin about the new company
        $usersToNotify['email'] = User::where('is_admin', true)->first()->email;
        dispatch(new SendEmailJob($usersToNotify));

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $data = $request->validated();
        
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('public/company_logos');

            // Generate a public URL for the logo
            $logoUrl = Storage::url($logoPath);

            // Delete the old logo if it exists
            if ($company->logo) {
                Storage::delete(str_replace('/storage', 'public', $company->logo));
            }

            $data['logo'] = $logoUrl;
        }

        $company->update($data);

        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
 
        return response()->noContent();
    }
}
