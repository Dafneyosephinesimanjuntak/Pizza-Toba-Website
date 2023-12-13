<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function counter()
    {
        $total = Notification::where('user_id', 1)->where('read', 0)->count();
        return response()->json([
            'total' => $total,
        ]);
    }

    public function index()
    {
        $user = User::find(Auth::id());
        $notifications = Notification::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $output = '';
        
        if ($notifications->count() > 0) {
            foreach ($notifications as $notification) {
                if ($notification->type == 'success') {
                    $output .= '
                    <a class="dropdown-item" href="javascript:;">
                        <div class="notification-content">
                        <div class="notification-text">
                        <i class="ri ri-checkbox-circle-line text-success"></i>
                                <strong>PizzTob</strong> ' . $notification->message . '
                                <br>
                                <small>' . $notification->created_at->diffForHumans() . '</small>
                                <hr style="margin-bottom:-5px;">
                            </div>
                        </div>
                    </a>
                    ';
                } elseif ($notification->type == 'warning') {
                    $output .= '
                    <a class="dropdown-item" href="javascript:;">
                        <div class="notification-content">
                        <div class="notification-text">
                        <i class="ri ri-alert-line text-danger"></i>
                                <strong>PizzTob</strong> ' . $notification->message . '
                                <br>
                                <small>' . $notification->created_at->diffForHumans() . '</small>
                                <hr style="margin-bottom:-5px;">
                            </div>
                        </div>
                    </a>
                    ';
                } elseif ($notification->type == 'info') {
                    $output .= '
                    <a class="dropdown-item" href="javascript:;">
                        <div class="notification-content">
                            <div class="notification-text">
                                <i class="ri ri-information-line text-info"></i>
                                <strong>PizzTob</strong> ' . $notification->message . '
                                <br>
                                <small style="margin-left:10px;">' . $notification->created_at->diffForHumans() . '</small>
                                <hr style="margin-bottom:-5px;">
                            </div>
                        </div>
                    </a>
                    ';
                }
            }
        } else {
            $output .= '
            <a class="dropdown-item" href="javascript:;">
                <div class="notification-content">
                    <i class="fas fa-info-circle text-info"></i>
                    <div class="notification-text">
                        <strong>PizzTob</strong> Tidak ada notifikasi
                        <br>
                    </div>
                </div>
            </a>
            ';
        }
        
        $notifications->each(function ($notification) {
            $notification->read = true;
            $notification->save();
        });
        
        return response()->json([
            'notifications' => $output,
        ]);
    }
    
}