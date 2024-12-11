<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailBookingTreatmentController extends Controller
{
    protected $baseApiUrl = 'http://127.0.0.1:8080/api';

    // GET: Fetch all detail booking treatments
    public function index()
    {
        $response = Http::get("{$this->baseApiUrl}/detailBookingTreatments");

        if ($response->successful()) {
            $bookings = $response->json();
            return view('treatment.bookingTreatment', compact('bookings')); 
        } else {
            return view('treatment.bookingTreatment', ['error' => 'Failed to fetch data.']);
        }
    }

    // POST: Store new detail booking treatment
    public function store(Request $request)
    {
        $response = Http::post("{$this->baseApiUrl}/detailBookingTreatments", $request->all());

        if ($response->successful()) {
            return redirect()->route('detailBookingTreatment.index')->with('success', 'Detail booking treatment created successfully.');
        } else {
            return redirect()->route('detailBookingTreatment.index')->with('error', 'Failed to create detail booking treatment.');
        }
    }

    // PUT: Update existing detail booking treatment
    public function update(Request $request, $id)
    {
        $response = Http::put("{$this->baseApiUrl}/detailBookingTreatments/{$id}", $request->all());

        if ($response->successful()) {
            return redirect()->route('detailBookingTreatment.index')->with('success', 'Detail booking treatment updated successfully.');
        } else {
            return redirect()->route('detailBookingTreatment.index')->with('error', 'Failed to update detail booking treatment.');
        }
    }

    // DELETE: Remove a detail booking treatment
    public function destroy($id)
    {
        $response = Http::delete("{$this->baseApiUrl}/detailBookingTreatments/{$id}");

        if ($response->successful()) {
            return redirect()->route('detailBookingTreatment.index')->with('success', 'Detail booking treatment deleted successfully.');
        } else {
            return redirect()->route('detailBookingTreatment.index')->with('error', 'Failed to delete detail booking treatment.');
        }
    }
}
