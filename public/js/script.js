$(document).ready(function () {
    AOS.init();

    //헤더 푸터 컴포넌트
    $("#header").load("./components/header.html", function () {

        $(function () {
            $(".menu-bar").click(function () {
                if($(".mb-hd-wrap").hasClass("open") === true){
                    $(".mb-hd-wrap").removeClass("open");
                    $(".nav-wrap").addClass("open");
                    $(".close-btn").click(function () {
                        $(".nav-wrap").removeClass("open");
                    });
                }else{
                    $(".nav-wrap").removeClass("open");
                    $(".mb-hd-wrap").addClass("open");
                    $(".close-btn").click(function () {
                    $(".mb-hd-wrap").removeClass("open");
                    });
                }
           });
        });

        $(function () {
            let $sm_nav_top = $(".mb-sm-nav-top");
            $sm_nav_top.click(function () {
                $(this).siblings(".mb-sm-nav").slideToggle();
                $(this).toggleClass("active");
            });
        });
    });
});


    $("#footer").load("./components/footer.html", function () {
        // Top btn
        $(function () {
            $(window).scroll(function () {
                if ($(this).scrollTop() > 200) {
                    $("#upBtn").fadeIn();
                } else {
                    $("#upBtn").fadeOut();
                }
            });
            $("#upBtn").click(function () {
                $("html, body").animate(
                    {
                        scrollTop: 0,
                    },
                    400
                );
                return false;
            });
        });
    });


// });


$(".party-request").click(function () {
    $(".modal-overley").addClass("open");
});

$(".close").click(function () {
    $(".modal-overley").removeClass("open");
});

//소개팅 가격 확인 모달
$(".blind-date .sub-btn.price-check").click(function () {
    console.log('클릭');
    $(".modal-overley.request").addClass("open");
});

//남자 -장소확인 모달
$(".mypage .date-btn.location-check").click(function () {
    console.log('클릭');
    $(".modal-overley.location-check").addClass("open");
});



setTimeout(function () {
    $(".title-wrap > .modal-overley.only").addClass("open");
},3000);

$(".mypage .submit-btn.check-profile").click(function () {
    $(".modal-overley.check").addClass("open");
    $(".title-wrap > .modal-overley.only").removeClass("open");
});

$(".mypage .go-btn").click(function () {
    $(".modal-overley.go").addClass("open");
    $(".title-wrap > .modal-overley.check").removeClass("open");
});

$(".mypage .date-btn").click(function () {
    $(".modal-overley.location").addClass("open");
});

$(".mypage .profile-btn").click(function () {
    $(".modal-overley.check-profile").addClass("open");
});


$(".mypage .review-btn").click(function () {
    $(".modal-overley.review").addClass("open");
});

setTimeout(function () {
    $(".mypage_payment .modal-overley.refund").addClass("open");
},3000);
setTimeout(function () {
    $(".mypage_payment .modal-overley.refund-blind").addClass("open");
},6000);


/* 셀렉트 박스 옵션 선택 */
const label = document.querySelectorAll(".text");
label.forEach(function (lb) {
    lb.addEventListener("click", (e) => {
        let optionList = lb.nextElementSibling;
        let optionItems = optionList.querySelectorAll(".option");
        clickLabel(lb, optionItems);
    });
});
const clickLabel = (lb, optionItems) => {
    if (lb.parentNode.classList.contains("active")) {
        lb.parentNode.classList.remove("active");
        optionItems.forEach((opt) => {
            opt.removeEventListener("click", () => {
                handleSelect(lb, opt);
            });
        });
    } else {
        lb.parentNode.classList.add("active");
        optionItems.forEach((opt) => {
            opt.addEventListener("click", () => {
                handleSelect(lb, opt);
            });
        });
    }
};
const handleSelect = (label, item) => {
    label.innerHTML = item.textContent;
    label.parentNode.classList.remove("active");
    $(".select-close").removeClass("open");
    $(".option-list").removeClass("open");
};



// 팝업창
// $(function () {
//     $(".x-btn").click(function () {
//         $("#agreePopup").hide();
//     })
// })

const swiperPopup = new Swiper(".layerbox .swiper", {
    direction: "horizontal",
    loop: true,
    autoplay: {
    delay: 4000,
    disableOnInteraction: false,
    },
    slidesPerView: "auto",
    pagination: {
    el: ".layerbox .swiper-pagination",
    clickable: true,
    },
});






//리뷰 점수
$('.review-score-btn-1').mouseover(function() {
    var score_value = $(this).attr('data-value');
    $('.review-score-btn-1:lt(' + score_value + ')').css({
      "background": "url(../images/score_checked.svg) no-repeat",
      "background-position": "center",
      "background-size": "cover",
    });
  });

  $('.review-score-btn-1').mouseleave(function() {
    var score_value = $(this).attr('data-value');
    $('.review-score-btn-1').css({
      "background": "url(../images/score_unchecked.svg) no-repeat",
      "background-position": "center",
      "background-size": "cover",
    });
  });

  $('.review-score-btn-2').mouseover(function() {
    var score_value = $(this).attr('data-value');
    $('.review-score-btn-2:lt(' + score_value + ')').css({
      "background": "url(../images/score_checked.svg) no-repeat",
      "background-position": "center",
      "background-size": "cover",
    });
  });

  $('.review-score-btn-2').mouseleave(function() {
    var score_value = $(this).attr('data-value');
    $('.review-score-btn-2').css({
      "background": "url(../images/score_unchecked.svg) no-repeat",
      "background-position": "center",
      "background-size": "cover",
    });
  });

  $('.review-score-btn-1').click(function() {
    var score_value = $(this).attr('data-value');
    $('.review-score-btn-1').removeClass('active');
    $('.review-score-btn-1').attr('aria-checked', 'false');
    $(this).attr('aria-checked', 'true');
    $('.review-score-btn-1:lt(' + score_value + ')').addClass('active');
    $('.score-result-1').show();
    $('.score-num-1').html(score_value);
  });

  $('.review-score-btn-2').click(function() {
    var score_value = $(this).attr('data-value');
    $('.review-score-btn-2').removeClass('active');
    $('.review-score-btn-2').attr('aria-checked', 'false');
    $(this).attr('aria-checked', 'true');
    $('.review-score-btn-2:lt(' + score_value + ')').addClass('active');
    $('.score-result-2').show();
    $('.score-num-2').html(score_value);
  });

