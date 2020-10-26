var liked = false;
var booked = false;

var srcWidth = $('body').width();
$('comment-input').css("width", srcWidth);


//添加comment
$("#comment_btn").click(function () {
    // $(button).click(function () {
        // $('.comment-input').remove();
    $('.comment-input').hide();
    $('#div-body').append("" +
        "<select style='margin-top: 5%; margin-left: 12%' id='rating_option'> <option > Select Your Rating</option> " +
        "<option value= '1'> 1 </option>" +
        "<option value= '2'> 2 </option>" +
        "<option value= '3'> 3 </option>" +
        "<option value= '4'> 4 </option>" +
        "<option value= '5'> 5 </option></select>");
    $('#div-body').append("" +
        "<div class='reply_textarea' style='overflow: auto; '>" +
        "<textarea name='' cols='40' autofocus='autofocus' rows='5' style='padding-left: 1%;' class = 'comment_area'></textarea>" +
        "<br/><input type='submit' id='submit_button' class='submit_button' value='submit'/></div>");
    // 这里修改评论栏样式！！！
    $('#div-body').css('background','#FAF7F7');
    $('.comment_area').css('margin','0 11%');
    $('.comment_area').css('resize','none');
    $('.comment_area').css('outline','none');
    $('select').css('outline','none');
    $('.submit_button').css('margin','0 40%');
    $("html").scrollTop(4000);

    $("#submit_button").click(function(){
        var url = document.URL;
        let which_id_find = url.indexOf("public/");
        let which_id = url.charAt(which_id_find+7);
        let id = parseInt(url.substr(url.indexOf("Details/")+8));
        console.log(id);
        console.log(which_id);
        let rate = $('#rating_option').val();
        let comment_content = $('.comment_area').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "http://localhost/build/public/comment",
            data: {
                'rate': parseInt(rate),
                'comment_content': comment_content,
                'which_id': which_id,
                "id": id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // alert('ok');
                $('#div-body').hide();
                $('back').hide();
                let rate = data.rate;
                let img_string = "";
                for(let i=0;i<rate;i++){
                    img_string += "<img src=\"http://localhost/build/resources/images/star.png\" class=\"star_icon\"/>"
                }
                let string_div = "<div class=\"card\">\n" +
                    "                    <div class=\"info\">\n" +
                    "                        <a class=\"comment-potrait\" href=\"\"><img\n" +
                    "                                src=\""+data.avatar+"\" alt=\"Card image\"\n" +
                    "                                width=40 height=40></a>\n" +
                    "                        <div class=\"name-rating\">\n" +
                    "                            <p>"+data.username+"</p>\n" +
                    "                            <div class=\"stars_rating\">\n" + img_string +
                    "                            </div>\n" +
                    "                        </div>\n" +
                    "                        <a class=\"comment-dot\">\n" +
                    "                            <img src=\"http://localhost/build/resources/images/event/comment-dots.png\">\n" +
                    "                        </a>\n" +
                    "                    </div>\n" +
                    "                    <div class=\"comment-text\">\n" +
                    "                        <p>"+data.comment+"</p>\n" +
                    "                    </div>\n" +
                    "                </div>";
                $("#comment").append(string_div)
            },
        });
    });

    // $(document).ready(function () {
    //     $('.submit_button').click(function () {
    //         let rate_score = null;
    //         let rate = $('#rating_option').val();
    //         switch (rate) {
    //             case "1":
    //                 rate_score = 'http://localhost/build/resources/images/event/rating5.png';
    //                 break;
    //             case "2":
    //                 rate_score = 'http://localhost/build/resources/images/event/rating5.png';
    //                 break;
    //             case "3":
    //                 rate_score = 'http://localhost/build/resources/images/event/rating5.png';
    //                 break;
    //             case "4":
    //                 rate_score = 'http://localhost/build/resources/images/event/rating5.png';
    //                 break;
    //             case "5":
    //                 rate_score = 'http://localhost/build/resources/images/event/rating5.png';
    //                 break;
    //         }
    //         let comment_content = $('.comment_area').val();
    //         console.log(comment_content);
    //         console.log("nowwwww");
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         // let action='';
    //         // if(button=='#commentEvent'){
    //         //     action = 'http://localhost/build/public/comment_store';
    //         // }else if (button=='#commentPost'){
    //         //     action = 'http://localhost/build/public/commentPost';
    //         // }
    //
    //         // $.ajax({
    //         //     type: 'POST',
    //         //     dataType:'json',
    //         //     url: "comment",
    //         //     data: {
    //         //         'rate': parseInt(rate),
    //         //         'rating_score': rate_score,
    //         //         'comment_content': comment_content,
    //         //         _token: $('meta[name="csrf-token"]').attr('content')
    //         //
    //         //     },
    //         //     success: function (data) {
    //         //         console.log(data);
    //         //         alert('ok');
    //         //         $('#div-body').hide();
    //         //         $('back').hide();
    //         //         let rate = data.rate;
    //         //         let img_string = "";
    //         //         for(let i=0;i<rate;i++){
    //         //             img_string += "<img src=\"../resources/images/star.png\" class=\"star_icon\"/>"
    //         //         }
    //         //         let string_div = "<div class=\"card\">\n" +
    //         //             "                    <div class=\"info\">\n" +
    //         //             "                        <a class=\"comment-potrait\" href=\"\"><img\n" +
    //         //             "                                src=\""+data.avatar+"\" alt=\"Card image\"\n" +
    //         //             "                                width=40 height=40></a>\n" +
    //         //             "                        <div class=\"name-rating\">\n" +
    //         //             "                            <p>"+data.username+"</p>\n" +
    //         //             "                            <div class=\"stars_rating\">\n" + img_string +
    //         //             "                            </div>\n" +
    //         //             "                        </div>\n" +
    //         //             "                        <a class=\"comment-dot\">\n" +
    //         //             "                            <img src=\"http://localhost/build/resources/images/event/comment-dots.png\">\n" +
    //         //             "                        </a>\n" +
    //         //             "                    </div>\n" +
    //         //             "                    <div class=\"comment-text\">\n" +
    //         //             "                        <p>"+data.comment+"</p>\n" +
    //         //             "                    </div>\n" +
    //         //             "                </div>";
    //         //         $("#comment").append(string_div)
    //         //     },
    //         // });
    //
    //     });
    // });
    // });
});


/** to achieve Read more... */
function readMore(text, height) {

    var defHeight = $(text).height();
    // console.log(defHeight)
    if (defHeight >= height) {
        $(text).css('height', height + 'px');
        $('#read-more').append('<a href="#">Read More</a>');
        $('#read-more a').click(function () {
            var curHeight = $(text).height();
            if (curHeight == height) {
                $(text).animate({
                    height: defHeight
                }, "normal");
                $('#read-more a').html('Hide');
                $('#gradient').fadeOut();
            } else {
                $(text).animate({
                    height: height
                }, "normal");
                $('#read-more a').html('Read More');
                $('#gradient').fadeIn();
            }
            return false;
        });
    }
}

readMore('.event-intro p', 144);
readMore('.exp-intro p', 144);

/** to switch the icon */
/*
$(function () {
    $(".rating").click(function () {
        if (!liked) {
            $(this).attr("src", "http://localhost/build/resources/images/event/Facebook-Heart.png");
            liked = true;
            console.log("lets like it!");;
        } else {
            $(this).attr("src", "http://localhost/build/resources/images/event/Facebook-Heart-2.png");
            liked = false;
        }

    })
})
*/

/** to call a new window and switch the icon */

$(function () {
    $("#toBook").click(function () {
        if (!booked) {
            $('back').css('display', 'block');
            $('#confirm-booking').css('display', 'flex');
            booked = true;
            //$(this).attr("src", "http://localhost/build/resources/images/event/icon-appointment-1.png");
        } else {
            //$(this).attr("src", "http://localhost/build/resources/images/event/icon-appointment-2.png");
            //booked = false;
        }

    })
});




//punch in
$(function () {
    $(".punch-in").click(function () {
        $('.in-punch-in').css('display', 'none');
        $('.punching').attr("src", "http://localhost/build/resources/images/event/clock-in-icon.png");
        readMore('.event-intro p', 144);
        $('back').css('display', 'block');
        $('#confirm-punch-in').css('display', 'flex');
    })
});


/** To close the window*/


$('#no').click(function () {
    $('back').css('display', 'none');
    $('.bookInfo').css('display', 'none');
    $('.in-punch-in').css('display', 'block');
    $('.punch-in-hide').css('display', 'none');
});


/* reference from Rong Mu https://www.cnblogs.com/roashley/p/7856134.html*/
var x = 0;
$(".carousel slide").mousedown(function (event) {
    //get the position where the press event happens
    x = event.pageX;
    $(".carousel slide").mouseup(function (event) {
        //get the position where the press event end
        var newx = event.pageX;
        //the offset and direction
        var changex = newx - x;
        //get the left attribute of the parent
        var left = $(".carousel-inner").position().left;
        //the offset of the chosen point
        var dleft = $("#active").position().left;
        // the width of the parent container
        var width = $(".carousel slide").width();
        //if the offset is more than 60, switch the graph
        if (changex > 20) {
            var newleft = left + width;
            var newdleft = dleft - 24;
            if (newleft > 0) {
                newleft = 0;
                newdleft = 0;
            };
            $(".carousel-inner").css("left", newleft);
            $("#active").css("left", newdleft);
        };
        if (changex < -20) {
            var newleft = left - width;
            var newdleft = dleft + 24;
            if (newleft < -width * 2) {
                newleft = -width * 2;
                newdleft = 48;
            };
            $(".carousel-inner").css("left", newleft);
            $("#active").css("left", newdleft);
        };
    });
});
