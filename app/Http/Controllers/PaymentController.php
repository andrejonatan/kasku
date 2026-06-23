<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PembayaranIuran;
use App\Models\Periode;
use App\Models\JenisIuran;
use App\Models\AkunUser;

class PaymentController extends Controller
{
    /**
     * Show the Uang Kas payment form.
     */
    public function showKasForm()
    {
        $user = Auth::guard('web')->user();
        // Sort by calendar month order
        $monthOrder = ['Januari'=>1,'Februari'=>2,'Maret'=>3,'April'=>4,'Mei'=>5,'Juni'=>6,
                       'Juli'=>7,'Agustus'=>8,'September'=>9,'Oktober'=>10,'November'=>11,'Desember'=>12];
        $periods = Periode::all()->sortBy(function($p) use ($monthOrder) {
            return (($p->tahun ?? 2026) * 100) + ($monthOrder[$p->bulan] ?? 0);
        })->values();
        $iuran = JenisIuran::find(1); // Kas Bulanan
        return view('payment.kas', compact('user', 'periods', 'iuran'));
    }

    /**
     * Process the Uang Kas payment form.
     */
    public function payKas(Request $request)
    {
        $request->validate([
            'id_periode' => 'required|exists:periode,id_periode',
            'amount' => 'required|numeric|min:0.01',
        ]);

        PembayaranIuran::create([
            'id_user' => Auth::guard('web')->user()->id_user,
            'id_iuran' => 1, // Kas Bulanan
            'id_periode' => $request->id_periode,
            'tanggal_bayar' => now()->toDateString(),
            'jumlah_bayar' => $request->amount,
            'status_bayar' => 'Lunas',
        ]);

        return redirect()->route('payment.success')->with('status', 'Pembayaran Uang Kas berhasil');
    }

    /**
     * Show the Tabungan Study Tour payment form.
     */
    public function showTourForm()
    {
        $user = Auth::guard('web')->user();
        // Sort by calendar month order
        $monthOrder = ['Januari'=>1,'Februari'=>2,'Maret'=>3,'April'=>4,'Mei'=>5,'Juni'=>6,
                       'Juli'=>7,'Agustus'=>8,'September'=>9,'Oktober'=>10,'November'=>11,'Desember'=>12];
        $periods = Periode::all()->sortBy(function($p) use ($monthOrder) {
            return (($p->tahun ?? 2026) * 100) + ($monthOrder[$p->bulan] ?? 0);
        })->values();
        $iuran = JenisIuran::find(2); // Tabungan Study Tour
        return view('payment.tour', compact('user', 'periods', 'iuran'));
    }

    /**
     * Process the Tabungan Study Tour payment form.
     */
    public function payTour(Request $request)
    {
        $request->validate([
            'id_periode' => 'required|exists:periode,id_periode',
            'amount' => 'required|numeric|min:0.01',
        ]);

        PembayaranIuran::create([
            'id_user' => Auth::guard('web')->user()->id_user,
            'id_iuran' => 2, // Tabungan Study Tour
            'id_periode' => $request->id_periode,
            'tanggal_bayar' => now()->toDateString(),
            'jumlah_bayar' => $request->amount,
            'status_bayar' => 'Lunas',
        ]);

        return redirect()->route('payment.success')->with('status', 'Pembayaran Tabungan Study Tour berhasil');
    }

    /**
     * Show a generic success page after payment.
     */
    public function success()
    {
        return view('payment.success');
    }

    /**
     * Show all monitoring uang kas.
     */
    public function monitoring(Request $request)
    {
        $students = AkunUser::all();
        $periods = Periode::all();
        $jenisIuranList = JenisIuran::all();

        $monitoringData = $students->map(function ($student) use ($periods) {
            $kas_paid = $student->pembayaranIuran()
                ->where('id_iuran', 1)
                ->where('status_bayar', 'Lunas')
                ->sum('jumlah_bayar');

            $tour_paid = $student->pembayaranIuran()
                ->where('id_iuran', 2)
                ->where('status_bayar', 'Lunas')
                ->sum('jumlah_bayar');

            $total_paid = $kas_paid + $tour_paid;

            $periods_count = $periods->count() ?: 1;
            $total_target = ($periods_count * 10000) + ($periods_count * 50000);
            $sisa_tagihan = max(0, $total_target - $total_paid);

             return [
                'nama' => $student->nama_user,
                'foto_profil' => $student->foto_profil,
                'kas_paid' => $kas_paid,
                'tour_paid' => $tour_paid,
                'total_paid' => $total_paid,
                'sisa_tagihan' => $sisa_tagihan,
                'status' => $sisa_tagihan <= 0 ? 'Lunas' : 'Belum Lunas'
            ];
        });

        return view('monitoring.kas', compact('monitoringData', 'periods', 'jenisIuranList'));
    }
}
