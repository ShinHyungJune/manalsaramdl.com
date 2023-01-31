<?php

namespace App\Http\Controllers;

use App\Enums\OrderProductState;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\EventBannerResource;
use App\Models\Category;
use App\Models\EventBanner;
use App\Models\User;
use App\Models\Verification;
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
            "contact" => "required|string|unique:users|max:500",
            "email" => "required|unique:users|email|max:500",
            "name" => "required|string|max:500",
            "sex" => "required|string|max:500",
            "birth" => "required|string|max:500",
            "job" => "required|string|max:500",
            "school" => "required|string|max:500",
            "city" => "required|string|max:500",
            "area" => "required|string|max:500",
            "need_service" => "required|string|max:500",
            "registration_way" => "required|string|max:500",
            "password" => "required|string|min:8|max:30|confirmed",

            "city_company" => "nullable|string|max:50000",
            "area_company" => "nullable|string|max:50000",
            "tall" => "nullable|string|max:50000",
            "weight" => "nullable|string|max:50000",
            "instagram" => "nullable|string|max:50000",
            "ideal" => "nullable|string|max:50000",
            "introduce" => "nullable|string|max:50000",
            "to_manager" => "nullable|string|max:50000",
            "marriage" => "nullable|string|max:50000",
            "agree_marketing" => "nullable|boolean",
            "imp_uid" => "nullable|string|max:50000",
            "merchant_uid" => "nullable|string|max:50000",
        ]);

        $verification = Verification::where('imp_uid', $request->imp_uid)
            ->where('merchant_uid', $request->merchant_uid)->first();

        if(!$verification)
            return redirect()->back()->with("error", "본인인증한 사용자만 회원가입할 수 있습니다.");

        $user = User::create(array_merge($request->except(["password", "imgs"]), [
            "password" => Hash::make($request->password)
        ]));

        if($request->imgs){
            foreach($request->file("imgs") as $img){
                $user->addMedia($img)->toMediaCollection("imgs", "s3");
            }
        }

        $verification->delete();

        return redirect("/login")->with("success", "성공적으로 가입되었습니다.");
    }

    public function socialLogin(Request $request, $social)
    {
        $socialUser = Socialite::driver($social)->user();

        $user = User::where("social_id", $socialUser->id)->where("social_platform", $social)->first();

        if(!$user)
            return redirect("/register?social_id=".$socialUser->id."&social_platform=".$social);

        Auth::login($user);

        return redirect()->intended();
    }

    public function update(Request $request)
    {
        $request->validate([
            "job" => "required|string|max:500",
            "school" => "required|string|max:500",
            "city" => "required|string|max:500",
            "area" => "required|string|max:500",
            "need_service" => "required|string|max:500",
            "registration_way" => "required|string|max:500",

            "city_company" => "nullable|string|max:50000",
            "area_company" => "nullable|string|max:50000",
            "tall" => "nullable|string|max:50000",
            "weight" => "nullable|string|max:50000",
            "instagram" => "nullable|string|max:50000",
            "ideal" => "nullable|string|max:50000",
            "introduce" => "nullable|string|max:50000",
            "to_manager" => "nullable|string|max:50000",
            "marriage" => "nullable|string|max:50000",
            "agree_marketing" => "nullable|boolean",
        ]);

        auth()->user()->update($request->except([
            "password", "name", "sex", "contact", "birth", "email"
        ]));

        if($request->imgs){
            auth()->user()->clearMediaCollection("imgs");

            foreach($request->file("imgs") as $img){
                auth()->user()->addMedia($img)->toMediaCollection("imgs", "s3");
            }
        }

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
        $appUrl = config("app.url");
        $impId = config("iamport.imp_code");

        return Inertia::render("Users/Create", [
            "appUrl" => $appUrl,
            "impId" => $impId
        ]);
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

        ]);

        /*$hasOngoingOrder = auth()->user()->orderProducts()->where("state", OrderProductState::WAIT)
            ->orWhere("state", OrderProductState::ONGOING)
            ->orWhere("state", OrderProductState::READY)
            ->count() > 0;

        $hasOngoingRefund = auth()->user()->refunds()->where("refunded", null)->count() > 0;

        if($hasOngoingOrder || $hasOngoingRefund)
            return redirect()->back()->with("error", "진행중인 주문이나 반품요청이 있을 경우 회원탈퇴를 진행할 수 없습니다.");

        if(!Hash::check($request->password, auth()->user()->password))
            return redirect()->back()->with("error", "비밀번호가 틀렸습니다.");*/

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

        return redirect("/")->with("success", "성공적으로 처리되었습니다.");
    }

    public function logout()
    {
        Auth::logout();

        return redirect("/");
    }
}
