<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get("/test", function(){
    dd(explode("#", "#123 #222"));
  //  $product = \App\Models\Product::factory()->create();

    // $product->addMedia(storage_path("app\public\main_sec-1_1.jpg"))->preservingOriginal()->toMediaCollection("img", "s3");
});


Route::get("/home", function(){
    return redirect("/");
});

Route::post("/users", [\App\Http\Controllers\UserController::class, "store"]);

Route::get('/', [\App\Http\Controllers\PageController::class, "index"]);
Route::get('/datingProducts', [\App\Http\Controllers\DatingProductController::class, "index"]);
Route::get('/partyProducts', [\App\Http\Controllers\PartyController::class, "index"]);

Route::post("/verifyNumbers", [\App\Http\Controllers\Api\VerifyNumberController::class, "store"]);
Route::patch("/verifyNumbers", [\App\Http\Controllers\Api\VerifyNumberController::class, "update"]);

Route::middleware("auth")->group(function(){
    // Route::get("/users/remove", [\App\Http\Controllers\UserController::class, "remove"]);
    Route::delete("/users", [\App\Http\Controllers\UserController::class, "destroy"]);
    // Route::get("/users/edit", [\App\Http\Controllers\UserController::class, "edit"]);
    Route::post("/users/update", [\App\Http\Controllers\UserController::class, "update"]);
});

/*Route::middleware("guest")->group(function(){
    Route::get("/login", [\App\Http\Controllers\UserController::class, "loginForm"])->name("login");
    Route::get("/register", [\App\Http\Controllers\UserController::class, "create"]);
    Route::get("/openLoginPop/{social}", [\App\Http\Controllers\UserController::class, "openSocialLoginPop"]);
    Route::get("/login/{social}", [\App\Http\Controllers\UserController::class, "socialLogin"]);
    Route::post("/login", [\App\Http\Controllers\UserController::class, "login"]);
    Route::post("/register", [\App\Http\Controllers\UserController::class, "register"]);
    Route::resource("/users", \App\Http\Controllers\UserController::class);
    Route::get("/passwordResets/{token}/edit", [\App\Http\Controllers\PasswordResetController::class, "edit"]);
    Route::resource("/passwordResets", \App\Http\Controllers\PasswordResetController::class);
});*/


Route::middleware("auth")->group(function(){
    Route::get("/logout", [\App\Http\Controllers\UserController::class, "logout"]);
    Route::get('/partyProducts/{product}', [\App\Http\Controllers\PartyController::class, "show"]);

});

Route::get("/mailable", function(){
    return (new \App\Mail\PasswordResetCreated(new \App\Models\User(), new \App\Models\PasswordReset()));
});


// 개발

// 가끔 결제되는 순간 네트워크가 끊길 경우나 가상계좌처럼 입금이 나중에 되는 경우를 대비한 웹훅
Route::post("/iamport-webhook", [\App\Http\Controllers\OrderController::class, "complete"]);


Route::middleware("auth")->group(function(){
    Route::post("/orders", [\App\Http\Controllers\OrderController::class, "store"]);

    // 공통
    Route::post("/likes/delete", [\App\Http\Controllers\LikeController::class, "destroy"]);
    Route::resource("/likes", \App\Http\Controllers\LikeController::class);
    Route::get("/myShoppingPageController/users/edit", [\App\Http\Controllers\UserController::class, "edit"]);

    Route::resource("/replies", \App\Http\Controllers\ReplyController::class);
    Route::get("/myShoppingPageController/reviews", [\App\Http\Controllers\ReviewController::class, "index"]);
    Route::get("/myShoppingPageController/products", [\App\Http\Controllers\ProductController::class, "pdfs"]);
    Route::get("/myShoppingPageController/carts", [\App\Http\Controllers\CartController::class, "index"]);
    // Route::resource("/carts", \App\Http\Controllers\CartController::class);

    Route::get("/myShoppingPageController/orders", [\App\Http\Controllers\OrderController::class, "index"]);
    Route::get("/orders/cancel", [\App\Http\Controllers\OrderController::class, "cancel"]);
    // Route::resource("/orders", \App\Http\Controllers\OrderController::class);
    Route::post("/qnas", [\App\Http\Controllers\QnaController::class, "store"]);

    Route::get("/myShoppingPageController/refunds", [\App\Http\Controllers\RefundController::class, "index"]);
    Route::delete("/reviews/{review}", [\App\Http\Controllers\ReviewController::class, "destroy"]);
});


Route::post("/orders/complete", [\App\Http\Controllers\OrderController::class, "complete"]);
Route::get("/orders/complete/mobile", [\App\Http\Controllers\OrderController::class, "complete"]);

Route::get("/orders/result", [\App\Http\Controllers\OrderController::class, "result"]);
Route::get("/orders/fail", [\App\Http\Controllers\OrderController::class, "fail"]);

Route::middleware("guest")->group(function(){
    Route::get("/login", [\App\Http\Controllers\UserController::class, "loginForm"])->name("login");
    Route::get("/register", [\App\Http\Controllers\UserController::class, "create"]);
    Route::get("/openLoginPop/{social}", [\App\Http\Controllers\UserController::class, "openSocialLoginPop"]);
    Route::get("/login/{social}", [\App\Http\Controllers\UserController::class, "socialLogin"]);
    Route::post("/login", [\App\Http\Controllers\UserController::class, "login"]);
    Route::post("/register", [\App\Http\Controllers\UserController::class, "register"]);
    // Route::resource("/users", \App\Http\Controllers\UserController::class);
    Route::patch("/passwordResets", [\App\Http\Controllers\PasswordResetController::class, "update"]);
    Route::get("/passwordResets/{token}/edit", [\App\Http\Controllers\PasswordResetController::class, "edit"]);
    Route::resource("/passwordResets", \App\Http\Controllers\PasswordResetController::class);

    Route::get("/findIds/create", [\App\Http\Controllers\FindIdController::class, "create"]);
    Route::get("/findIds/search", [\App\Http\Controllers\FindIdController::class, "search"]);
    Route::get("/users/deleted", [\App\Http\Controllers\UserController::class, "deleted"]);

});

Route::get("/mypage", [\App\Http\Controllers\Shopping\PageController::class, "mypage"]);
Route::get("/", [\App\Http\Controllers\Shopping\PageController::class, "index"]);
Route::get("/story3", [\App\Http\Controllers\Shopping\PageController::class, "story3"]);
Route::resource("/products", \App\Http\Controllers\Shopping\ProductController::class);
Route::resource("/faqs", \App\Http\Controllers\Shopping\FaqController::class);
Route::resource("/notices", \App\Http\Controllers\Shopping\NoticeController::class);
Route::resource("/searches", \App\Http\Controllers\Shopping\SearchController::class);

Route::get("/supplyPolicy", [\App\Http\Controllers\Shopping\PageController::class, "supplyPolicy"]); // 개인정보 제3자 제공동의
Route::get("/privacyPolicy", [\App\Http\Controllers\Shopping\PageController::class, "privacyPolicy"]); // 개인정보 수집/이용 동의
Route::get("/servicePolicy", [\App\Http\Controllers\Shopping\PageController::class, "servicePolicy"]); // 결제대행 서비스 이용약관

Route::get("/carts", [\App\Http\Controllers\CartController::class, "index"]);
Route::get("/orders/search", [\App\Http\Controllers\OrderController::class, "search"]);
Route::get("/orders/guest", [\App\Http\Controllers\OrderController::class, "guestIndex"]);
Route::get("/orders/create", [\App\Http\Controllers\OrderController::class, "create"]);

Route::middleware("auth")->group(function(){
    Route::get("/users/remove", [\App\Http\Controllers\UserController::class, "remove"]);
    Route::get("/users/edit", [\App\Http\Controllers\UserController::class, "edit"]);
    Route::resource("/reviews", \App\Http\Controllers\ReviewController::class);
    Route::get("/orders", [\App\Http\Controllers\OrderController::class, "index"]);
    Route::resource("/latestProducts", \App\Http\Controllers\Shopping\LatestProductController::class);
    Route::resource("/likes", \App\Http\Controllers\Shopping\LikeController::class);
    Route::resource("/qnas", \App\Http\Controllers\Shopping\QnaController::class);
    Route::get("/reviews", [\App\Http\Controllers\Shopping\ReviewController::class, "index"]);
    Route::get("/reviews/create", [\App\Http\Controllers\Shopping\ReviewController::class, "create"]);
    Route::post("/reviews", [\App\Http\Controllers\Shopping\ReviewController::class, "store"]);
    Route::get("/refunds/create", [\App\Http\Controllers\RefundController::class, "create"]);
    Route::resource("/refunds", \App\Http\Controllers\RefundController::class);
});
