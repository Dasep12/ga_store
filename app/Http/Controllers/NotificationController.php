<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function getNotifications()
    {
        $data = DB::table('vw_trn_order')
            ->where('status', 'approved');

        $html = '';

        foreach ($data->get() as $item) {
            $orderDate = Carbon::parse($item->order_date);
            $photo = $item->photo
                ? asset('assets/' . $item->photo)
                : asset('assets/assets/img/team/avatar.webp');

            $html .= '
            <div class="px-2 px-sm-3 py-3 notification-card position-relative read border-bottom">
                <div class="d-flex align-items-center justify-content-between position-relative">
                    <div class="d-flex">
                        <div class="avatar avatar-m status-online me-3">
                            <img class="rounded-circle" src="' . $photo . '" alt="" />
                        </div>
                        <div class="flex-1 me-sm-3">
                            <h4 class="fs-9 text-body-emphasis">' . ucwords(strtolower($item->creator)) . '</h4>
                            <p class="fs-9 text-body-highlight mb-2 mb-sm-3 fw-normal">
                                Request ' . ucwords(strtolower($item->nama_barang)) . '.
                            </p>
                            <p class="text-body-secondary fs-9 mb-0">
                                <span class="me-1 fas fa-clock"></span>
                                <span class="fw-bold">' . $orderDate->format('H:i:s') . ',</span>
                                ' . $orderDate->translatedFormat('d F Y') . '
                            </p>
                        </div>
                    </div>
                </div>
            </div>';
        }

        return response()->json(['html' => $html, 'count' => $data->count()]);
    }
}
