<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FeedbackTreatmentController extends Controller
{
    protected $baseApiUrl = 'http://127.0.0.1:8080/api/feedbackTreatments';

    // Display Feedback Treatments
    public function index()
    {
        $response = Http::get($this->baseApiUrl);

        if ($response->successful()) {
            $feedbacks = $response->json();
            return view('feedback.feedbackTreatment', compact('feedbacks'));
        } else {
            return view('feedback.feedbackTreatment', ['error' => 'Failed to fetch feedbacks']);
        }
    }

    public function show($id)
    {
        $response = Http::get("{$this->baseApiUrl}/{$id}");
    
        if ($response->successful()) {
            $feedback = $response->json();
    
            return view('feedback.detailFeedbackTreatment', compact('feedback'));
        } else {
            return back()->with('error', 'Tidak dapat mengambil detail feedback treatment.');
        }
    }

    // Store Feedback Treatments
    public function store(Request $request)
    {
        $response = Http::post($this->baseApiUrl, $request->all());

        if ($response->successful()) {
            return redirect()->route('feedback.feedbackTreatment.index')->with('success', 'Feedback berhasil ditambahkan');
        } else {
            return redirect()->route('feedback.feedbackTreatment.index')->with('error', 'Gagal menambahkan feedback');
        }
    }

    // Update Feedback Treatments
    public function update(Request $request, $id)
    {
        $response = Http::put("{$this->baseApiUrl}/{$id}", $request->all());

        if ($response->successful()) {
            return redirect()->route('feedback.feedbackTreatment.index')->with('success', 'Feedback berhasil diupdate');
        } else {
            return redirect()->route('feedback.feedbackTreatment.index')->with('error', 'Gagal mengupdate feedback');
        }
    }

    // Delete Feedback Treatments
    public function destroy($id)
    {
        $response = Http::delete("{$this->baseApiUrl}/{$id}");

        if ($response->successful()) {
            return redirect()->route('feedback.feedbackTreatment.index')->with('success', 'Feedback berhasil dihapus');
        } else {
            return redirect()->route('feedback.feedbackTreatment.index')->with('error', 'Gagal menghapus feedback');
        }
    }
}
