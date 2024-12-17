<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailBookingTreatmentController extends Controller
{
    protected $baseApiUrl = 'https://backend-klinik-aesthetic-production.up.railway.app/api/detailBookingTreatments';
    protected $apiUsers = 'https://backend-klinik-aesthetic-production.up.railway.app/api/users';
    protected $apiTreatments = 'https://backend-klinik-aesthetic-production.up.railway.app/api/treatments';
    protected $apiDokters = 'https://backend-klinik-aesthetic-production.up.railway.app/api/dokters';
    protected $apiBeauticians = 'https://backend-klinik-aesthetic-production.up.railway.app/api/beauticians';


    public function index()
    {
        try {
            // Mengambil data booking treatment dari API
            $response = Http::get($this->baseApiUrl);

            // Cek apakah response berhasil
            if ($response->successful()) {
                $bookings = $response->json(); // Ambil data dalam format JSON

                // Jika struktur data menyertakan relasi booking, kita dapat mengakses data terkait
                foreach ($bookings as &$booking) {
                    // Memastikan elemen 'booking' ada dalam response untuk mengakses data terkait
                    if (isset($booking['booking'])) {
                        $booking['status_booking_treatment'] = $booking['booking']['status_booking_treatment'];
                        $booking['id_user'] = $booking['booking']['id_user'];
                        $booking['waktu_treatment'] = $booking['booking']['waktu_treatment'];
                        $booking['harga_total'] = $booking['booking']['harga_total'];
                        $booking['potongan_harga'] = $booking['booking']['potongan_harga'];
                        $booking['harga_akhir_treatment'] = $booking['booking']['harga_akhir_treatment'];
                    } else {
                        // Jika 'booking' tidak ada, set data default
                        $booking['status_booking_treatment'] = 'Tidak tersedia';
                        $booking['id_user'] = null;
                        $booking['waktu_treatment'] = null;
                        $booking['harga_total'] = 0;
                        $booking['potongan_harga'] = 0;
                        $booking['harga_akhir_treatment'] = 0;
                    }
                }
            } else {
                // Jika response gagal, kembalikan data kosong dan pesan error
                $bookings = [];
                return back()->with('error', 'Gagal mengambil data booking treatment dari API.');
            }
        } catch (\Exception $e) {
            // Jika terjadi kesalahan pada koneksi API, tangkap error-nya
            $bookings = [];
            return back()->with('error', 'Terjadi kesalahan saat mengakses API: ' . $e->getMessage());
        }

         // Ambil data user
         $usersResponse = Http::get($this->apiUsers);
         $users = $usersResponse->successful() ? $usersResponse->json()['data'] : [];
 
         // Ambil data treatment
         $treatmentsResponse = Http::get($this->apiTreatments);
         $treatments = $treatmentsResponse->successful() ? $treatmentsResponse->json()['data'] : [];
 
         // Ambil data dokter
         $doktersResponse = Http::get($this->apiDokters);
         $dokters = $doktersResponse->successful() ? $doktersResponse->json()['data'] : [];
 
         // Ambil data beautician
         $beauticiansResponse = Http::get($this->apiBeauticians);
         $beauticians = $beauticiansResponse->successful() ? $beauticiansResponse->json()['data'] : [];

        // Kirim data ke view bookingTreatment
        return view('treatment.bookingTreatment', [
            'bookings' => $bookings,
            'users' => $users,
            'treatments' => $treatments,
            'dokters' => $dokters,
            'beauticians' => $beauticians,
        ]);
    }


    public function store(Request $request)
    {

        $details = [];

        foreach ($request->details as $detail) {
            $details[] = [
                'id_treatment' => $detail['id_treatment'],
                'id_dokter' => $detail['id_dokter'],
                'id_beautician' => $detail['id_beautician'],
            ];
        }

        $response = Http::post($this->baseApiUrl, [
            'id_user' => $request->id_user,
            'waktu_treatment' => $request->waktu_treatment,
            'status_booking_treatment' => $request->status_booking_treatment,
            'potongan_harga' => $request->potongan_harga,
            'details' => $details,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Data berhasil dikirim');
        } else {
            return back()->with('error', 'Gagal mengirim data');
        }
    }

    public function show($id)
    {
        // Ambil detail booking treatment berdasarkan id_detail_booking_treatment
        $responseDetailBooking = Http::get("{$this->baseApiUrl}/{$id}");

        if ($responseDetailBooking->successful()) {
            $detail = $responseDetailBooking->json();
        } else {
            return redirect()->back()->with('error', 'Detail Booking Treatment tidak ditemukan.');
        }

        // Ambil data dokter dari API
        $responseDokter = Http::get($this->apiDokters);
        $dokters = $responseDokter->successful() ? $responseDokter->json()['data'] : [];

        // Ambil data beautician dari API
        $responseBeautician = Http::get($this->apiBeauticians);
        $beauticians = $responseBeautician->successful() ? $responseBeautician->json()['data'] : [];

        // Kirim data ke view untuk ditampilkan dalam form modal
        return view('treatment.detailBookingTreatment', [
            'detail' => $detail,
            'dokters' => $dokters,
            'beauticians' => $beauticians,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Kirim data yang akan diupdate ke API backend tanpa validasi
        $response = Http::put("{$this->baseApiUrl}/{$id}", [
            'id_dokter' => $request->id_dokter,
            'id_beautician' => $request->id_beautician,
            'status_booking_treatment' => $request->status_booking_treatment,
        ]);

        // Periksa apakah respons API berhasil
        if ($response->successful()) {
            return back()->with('success', 'Data berhasil diperbarui');
        } else {
            // Ambil pesan error dari API jika ada
            $errorMessage = $response->json('message') ?? 'Gagal memperbarui data';
            return back()->with('error', $errorMessage);
        }
    }
}
