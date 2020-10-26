<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Camera App</title>
		<link rel="stylesheet" type="text/css" href="http://localhost/build/resources/css/post.css"/>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="http://localhost/build/resources/js/jquery-3.5.0.min.js"></script>
	</head>
	<body>
		<main id="camera">
			<video id="camera--view" autoplay playsinline></video>
			<canvas id="camera--sensor"></canvas>
			<img src="//:0" alt="" id="camera--output" class="display_none">
			<button id="camera--trigger">Take a picture</button>
		</main>
		<main id="edit_page" class="display_none">
            <form>
                <ul id="btn_top">
                    <a href=" "><li id="cancel_btn">Cancel</li></a>
                    <li id="publish_btn">Publish</li>
                </ul>
                <div id="content" class="main_content">
                    <input type="text" value="title" id="title">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <textarea name="input_content" rows="10" cols="10" id="input_content">Travel experience....</textarea>
                </div>
            </form>
			<div id="pictures">
				<ul class="mini_pictures">
					<li>
						<img src="http://localhost/build/resources/images/post/plus.png" class="mini_img" id="img_1"/>
					</li>
					<li>
						<img src="http://localhost/build/resources/images/post/plus.png" class="mini_img" id="img_2"/>
					</li>
					<li>
						<img src="http://localhost/build/resources/images/post/plus.png" class="mini_img" id="img_3" class="display_none"/>
					</li>
				</ul>
			</div>
			<div id="tags" class="main_content">

			</div>
		</main>
		<script type="text/javascript" src="http://localhost/build/resources/js/post.js"></script>
	    <script>
            // trigger ajax request to submit the post detail.
            $(function () {
                let detail = $("#input_content").val();
                let title = $("#title").val();
                $("#publish_btn").click(function(){
                    console.log("ddddd");
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        dataType:'json',
                        data: {
                            "url_list": url_list,
                            "detail": detail,
                            "title":title,
                            _token: $('meta[name="csrf-token"]').attr('content')

                        },
                        url: "post",
                        success:function(data){
                            // console.log(data);
                            alert('Your share is uploaded successfully~');
                            window.location.href = 'http://localhost/build/public/user/profile';
                        },
                    });

                });
            });
        </script>
    </body>
</html>

<?php

