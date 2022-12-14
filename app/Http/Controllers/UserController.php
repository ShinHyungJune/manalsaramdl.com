<?php

namespace App\Http\Controllers;

use App\Enums\OrderProductState;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\EventBannerResource;
use App\Models\Category;
use App\Models\EventBanner;
use App\Models\User;
use App\Models\VerifyNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Laravel\Socialite\Facades\Socialite;

class UserController extends \ShinHyungJune\SocialLogin\Http\UserController
{
    public function username()
    {
        return "ids";
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            "email" => "required|string|max:500",
            "password" => "required|string|max:500",
        ]);

        if(auth()->attempt($request->all())) {
            session()->regenerate();

            return redirect()->intended();
        }

        return Inertia::render("Users/Login", [
            "errors" => [
                "email" => __("socialLogin.invalid")
            ]
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            "email" => "required|string|min:4|max:20|unique:users",
            "contact" => "required|string|max:500",
            "name" => "required|string|max:500",
            "password" => "required|string|min:8|max:30|confirmed",
            "email" => "required|email|max:500",
            "address" => "required|string|max:500",
            "address_detail" => "required|string|max:500",
            "address_zipcode" => "required|string|max:500",
        ]);

        $verifyNumber = VerifyNumber::where('contact', $request->contact)
            ->where('verified', true)->first();

        if(!$verifyNumber)
            return redirect()->back()->with("error", "인증된 전화번호만 사용할 수 있습니다.");

        User::create([
            "ids" => $request->ids,
            "contact" => $request->contact,
            "name" => $request->name,
            "password" => Hash::make($request->password),
            "email" => $request->email,
            "address" => $request->address,
            "address_detail" => $request->address_detail,
            "address_zipcode" => $request->address_zipcode,
        ]);

        $verifyNumber->delete();

        return redirect("/login")->with("success", "성공적으로 가입되었습니다.");
    }

    public function socialLogin(Request $request, $social)
    {
        $socialUser = Socialite::driver($social)->user();

        // 일단 네이버
        $user = User::where("social_id", $socialUser->id)->where("social_platform", $social)->first();

        if(!$user) {
            $user = User::create([
                "name" => isset($socialUser->name) ? $socialUser->name : null,
                "email" => isset($socialUser->email) ? $socialUser->email : null,
                // "contact" => $socialUser->contact,
                "social_id" => $socialUser->id,
                "social_platform" => $social
            ]);
        }

        Auth::login($user);

        return redirect()->intended();
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:500",
            "contact" => "required|string|max:500",
            "email" => "required|email|max:500",
            "address" => "required|string|max:500",
            "address_detail" => "required|string|max:500",
            "address_zipcode" => "required|string|max:500",
            "elevator" => "required|boolean",
            "password" => "nullable|string|min:8|max:20|confirmed"
        ]);

        auth()->user()->update($request->except("password"));

        if($request->password)
            auth()->user()->update([
                "password" => Hash::make($request->password)
            ]);

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }

    /*
    public function update(Request $request)
    {
        $request->validate([
            "contact_change" => "nullable|string|max:500|unique:users,contact",
            "name" => "nullable|string|max:500",
            "password" => "nullable|string|max:500|min:8|confirmed",
            "agree_ad" => "nullable|boolean",

            "bank" => "nullable|string|max:500",
            "account" => "nullable|string|max:500",
            "owner" => "nullable|string|max:500",
        ]);

        if($request->contact_change){
            $verifyNumber = VerifyNumber::where('contact', $request->contact_change)
                ->where('verified', true)->first();

            if(!$verifyNumber)
                return redirect()->back()->with("error", "인증된 전화번호만 사용할 수 있습니다.");

            auth()->user()->update(["contact" => $request->contact_change]);

            $verifyNumber->delete();
        }

        if($request->name)
            auth()->user()->update(["name" => $request->name]);

        if($request->password)
            auth()->user()->update(["password" => Hash::make($request->password)]);

        if($request->bank)
            auth()->user()->update(["bank" => $request->bank]);

        if($request->owner)
            auth()->user()->update(["owner" => $request->owner]);

        if($request->account)
            auth()->user()->update(["account" => $request->account]);

        if(isset($request->agree_ad))
            auth()->user()->update(["agree_ad" => $request->boolean("agree_ad")]);

        return redirect()->back()->with("success", "성공적으로 처리되었습니다.");
    }
    */

    public function loginForm()
    {
        return Inertia::render("Users/Login",[]);
    }

    public function create()
    {
        return Inertia::render("Users/Create");
    }

    public function edit()
    {
        return Inertia::render("Users/Edit", [

        ]);
    }

    public function remove()
    {
        return Inertia::render("Users/Remove", []);
    }

    public function deleted()
    {
        return Inertia::render("Users/Deleted", []);
    }

    public function destroy(Request $request)
    {
        $request->validate([
            "password" => "required|string|max:500"
        ]);

        $hasOngoingOrder = auth()->user()->orderProducts()->where("state", OrderProductState::WAIT)
            ->orWhere("state", OrderProductState::ONGOING)
            ->orWhere("state", OrderProductState::READY)
            ->count() > 0;

        $hasOngoingRefund = auth()->user()->refunds()->where("refunded", null)->count() > 0;

        if($hasOngoingOrder || $hasOngoingRefund)
            return redirect()->back()->with("error", "진행중인 주문이나 반품요청이 있을 경우 회원탈퇴를 진행할 수 없습니다.");

        if(!Hash::check($request->password, auth()->user()->password))
            return redirect()->back()->with("error", "비밀번호가 틀렸습니다.");

        auth()->user()->delete();

        /*
        $request->validate([
            "password" => "required|string|confirmed|max:500"
        ]);

        if(!Hash::check($request->password, auth()->user()->password))
            return redirect()->back()->with("error", "비밀번호가 틀렸습니다.");

        auth()->user()->update(["reason_leave_out" => $request->reason]);

        auth()->user()->forceDelete();
        */

        return redirect("/shopping/users/deleted")->with("success", "성공적으로 탈퇴되었습니다.");
    }

    public function logout()
    {
        Auth::logout();

        return redirect("/shopping");
    }
}
