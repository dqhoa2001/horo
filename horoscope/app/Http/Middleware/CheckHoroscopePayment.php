<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckHoroscopePayment
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('user')->user();

        if ($user && !$user->hasPaidForMyHoroscope()) {
            return redirect()->route('user.check_payment.create')
                            ->with('flash_alert', 'Bạn cần thanh toán để truy cập vào trang này.');
        }

        return $next($request);
    }
}
