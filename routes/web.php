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
  //  $product = \App\Models\Product::factory()->create();

    // $product->addMedia(storage_path("app\public\main_sec-1_1.jpg"))->preservingOriginal()->toMediaCollection("img", "s3");
});


Route::get("/home", function(){
    return redirect("/");
});

Route::post("/users", [\App\Http\Controllers\UserController::class, "store"]);

Route::get('/', [\App\Http\Controllers\PageController::class, "index"]);
Route::get('/datingProducts', [\App\Http\Controllers\DatingProductController::class, "index"]);

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
});

Route::get("/mailable", function(){
    return (new \App\Mail\PasswordResetCreated(new \App\Models\User(), new \App\Models\PasswordReset()));
});


// 개발

// 가끔 결제되는 순간 네트워크가 끊길 경우나 가상계좌처럼 입금이 나중에 되는 경우를 대비한 웹훅
Route::post("/iamport-webhook", [\App\Http\Controllers\OrderController::class, "complete"]);

// 게스트도 주문가능
Route::post("/orders", [\App\Http\Controllers\OrderController::class, "store"]);

Route::middleware("auth")->group(function(){
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

Route::patch("/carts", [\App\Http\Controllers\CartController::class, "update"]);
Route::post("/carts", [\App\Http\Controllers\CartController::class, "store"]);
Route::delete("/carts/detach", [\App\Http\Controllers\CartController::class, "detach"]);
Route::delete("/carts/detachOne", [\App\Http\Controllers\CartController::class, "detachOne"]);

Route::prefix("/shopping")->group(function(){
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

    Route::resource("/shoppingEvents", \App\Http\Controllers\Shopping\ShoppingEventController::class);


});

Route::prefix("/brand")->group(function(){

    Route::middleware("guest")->group(function(){

    });

    Route::get("/wayToCome", [\App\Http\Controllers\Brand\PageController::class, "wayToCome"]);
    Route::get("/story1", [\App\Http\Controllers\Brand\PageController::class, "story1"]);
    Route::get("/story2", [\App\Http\Controllers\Brand\PageController::class, "story2"]);
    Route::get("/story3", [\App\Http\Controllers\Brand\PageController::class, "story3"]);
    Route::get("/history", [\App\Http\Controllers\Brand\PageController::class, "history"]);
    Route::get("/certification", [\App\Http\Controllers\Brand\PageController::class, "certification"]);
    Route::get("/policy1", [\App\Http\Controllers\Brand\PageController::class, "policy1"]);
    Route::get("/policy2", [\App\Http\Controllers\Brand\PageController::class, "policy2"]);

    Route::get("/brandEvents", [\App\Http\Controllers\Brand\BrandEventController::class, "index"]);
    Route::get("/brandEvents/{brandEvent}", [\App\Http\Controllers\Brand\BrandEventController::class, "show"]);
    Route::get("/reviews", [\App\Http\Controllers\Brand\ReviewController::class, "index"]);

    Route::get("/catalogs", [\App\Http\Controllers\Brand\CatalogController::class, "index"]);
    Route::get("/searches", [\App\Http\Controllers\Brand\SearchController::class, "index"]);
    Route::get("/products", [\App\Http\Controllers\Brand\ProductController::class, "index"]);
    Route::get("/reviews/create", [\App\Http\Controllers\Brand\ReviewController::class, "create"]);
    Route::get("/reviews/{review}", [\App\Http\Controllers\Brand\ReviewController::class, "show"]);
    Route::post("/reviews", [\App\Http\Controllers\Brand\ReviewController::class, "store"]);

    Route::get("/homecare", [\App\Http\Controllers\Brand\PageController::class, "homecare"]);
    Route::post("/homecares", [\App\Http\Controllers\Brand\HomecareController::class, "store"]);
    Route::resource("/stores", \App\Http\Controllers\Brand\StoreController::class);
    Route::resource("/videos", \App\Http\Controllers\Brand\VideoController::class);
    Route::resource("/supports", \App\Http\Controllers\Brand\SupportController::class);
    Route::resource("/magazines", \App\Http\Controllers\Brand\MagazineController::class);

    Route::get("/qnas/create", [\App\Http\Controllers\Brand\QnaController::class, "create"]);
    Route::post("/qnas", [\App\Http\Controllers\Brand\QnaController::class, "store"]);
    Route::get("/faqs", [\App\Http\Controllers\Brand\FaqController::class, "index"]);

    Route::get("/afterServices/create", [\App\Http\Controllers\Brand\AfterServiceController::class, "create"]);
    Route::post("/afterServices", [\App\Http\Controllers\Brand\AfterServiceController::class, "store"]);

    Route::middleware("auth")->group(function(){
    });

});

// 공통
Route::resource("/productQnas", \App\Http\Controllers\ProductQnaController::class);

// 임시
/*
Route::resource("notices", \App\Http\Controllers\NoticeController::class);
Route::get("/404", [\App\Http\Controllers\ErrorController::class, "notFound"]);
Route::get("/403", [\App\Http\Controllers\ErrorController::class, "unAuthenticated"]);
Route::get("/privacyPolicy", [\App\Http\Controllers\ShoppingPageControllerController::class, "privacyPolicy"]);
Route::get("/servicePolicy", [\App\Http\Controllers\ShoppingPageControllerController::class, "servicePolicy"]);
*/
