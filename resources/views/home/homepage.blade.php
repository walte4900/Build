@extends('layouts.app')

@section('content')


  <nav class="navbar" style="display:inline;">
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width:70%; margin-left:15px;">
        <a href="{{url("/user/coupon")}}"><img id="coupon-2" src="../resources/images/coupon-2.png"></a>
    </form>

    <div id="search-position">
        <img src="../resources/images/GPS icon.png">
        <h1><span id="city"></span></h1>
    </div>

    <div class="nav-item dropdown" style="padding-left: 190px;">
      <a class="nav-link dropdown-toggle" style="color:black;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <p id="selector" style="display:inline;">Sort by Both</P>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="left: 150px;">
        <span class="dropdown-item" id="select_publisher">Posts</span>
        <span class="dropdown-item" id="select_events">Events</span>
        <a class="dropdown-item" id="select_both" href="{{url("/")}}">Both</a>
      </div>
    </div>
  </nav>
  <div class="div" id="share_content">
  @foreach ($data as $key=>$item)
      @foreach ($item as $value)
    <div class="card" style="width: 94%; margin: 0px 10px; border-radius: 15px; border: 2px solid #F5F1F2" value='{{$value[0]->which_id}}\{{$value[0]->id}}'>
        <img src="{{$value[0]->cover_img}}" class="card-img-top" style="border-radius: 15px 15px 0px 0px; height:180px" >
        <img src="../resources/images/icons8-national-park-50.png" id="author_icon">
        <div class="card-body" style="padding: 10px;">
          <h6 class="card-title">{{$value[0]->title}}</h6>
          <span class="d-inline-block text-truncate text-muted" style="max-width: 100%;">{{$value[0]->detail}}</span>
        </div>
       </a>
    </div>
    <div style="height:20px;weight:100%;"></div>
      @endforeach
  @endforeach
  </div>
  <div style="height:50px;weight:100%;"></div>

<script src="http://localhost/build/resources/js/jquery-3.5.0.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoCaB9U_hB6RiBh1IONqTKj4ML8t1qsUs&language=en" rel="external nofollow " ></script>
<script type="text/javascript">
    $(function () {
        getLocation();
        function getLocation(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successFunction);
            }

            //Get the latitude and the longitude;
            function successFunction(position) {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
                codeLatLng(lat, lng);
            }
        }
        function codeLatLng(lat, lng) {
            let geocoder = new google.maps.Geocoder();
            let latlng = new google.maps.LatLng(lat, lng);
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    console.log(results);
                    if (results[1]) {
                        var indice=0;
                        for (var j=0; j<results.length; j++)
                        {
                            if (results[j].types[0]=='locality')
                            {
                                indice=j;
                                break;
                            }
                        }
                        for (var i=0; i<results[j].address_components.length; i++)
                        {
                            if (results[j].address_components[i].types[0] == "locality") {
                                //city data
                                city = results[j].address_components[i];
                                document.getElementById("city").innerHTML= city.long_name;
                                break;
                            }
                        }
                    }
                }
            });
        }
    });
  $(function () {
      $(".card").click(function(){
          let which_id = this.getAttribute("value").split("\\")[0];
          let id = this.getAttribute("value").split("\\")[1];
          if(which_id === "eid"){
              window.location.href = 'http://localhost/build/public/eventDetails/' + id;
          }else{
              window.location.href = 'http://localhost/build/public/postDetails/' + id;
          }
      });

          $("#select_events").click(function () {
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      type: 'POST',
                      dataType:'json',
                      data: {
                          "select_by": "Events",
                          _token: $('meta[name="csrf-token"]').attr('content')

                      },
                      url: "select_by",
                      success:function(data){
                          // console.log(data[0].detail);
                          let string_sum = "";
                          for (let i = 0; i < data.length; i++) {
                              string_sum += "<a href= \"{{url("/eventDetails")}}/{{$value[0]->id}}\"><div class=\"card\" style=\"width: 95%; margin: 0px 10px;border-radius: 15px 15px 0px 0px; border: 2px solid #F5F1F2\">\n" +
                                  "             <img src=\"" + data[i][0].cover_img + " \" class=\"card-img-top\" style=\"border-radius: 15px 15px 0px 0px; height:180px\"></a>\n" +
                                  "             <img src=\"../resources/images/icons8-national-park-50.png\" id=\"author_icon\">\n" +
                                  "             <div class=\"card-body\" style=\"padding: 10px;\">\n" +
                                  "                  <h6 class=\"card-title\">" + data[i][0].title + "</h6>\n" +
                                  "                  <span class=\"d-inline-block text-truncate text-muted\" style=\"max-width: 100%;\">" + data[i][0].detail + "</span>\n" +
                                  "              </div>\n" +
                                  "          </div></a>\n" +
                                  "          <div style=\"height:20px;weight:100%;\"></div>";
                              $("#share_content").html(string_sum);
                          }
                      },
                  });
                  $("#selector").text("Sort by Events");
              }

          );
          $("#select_publisher").click(function () {
                  $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                  });
                  $.ajax({
                      type: 'POST',
                      dataType:'json',
                      data: {
                          "select_by": "Publishers",
                          _token: $('meta[name="csrf-token"]').attr('content')

                      },
                      url: "select_by",
                      success:function(data) {
                          console.log(data);
                          let string_sum = "";
                          for (let i = 0; i < data.length; i++) {
                              string_sum += "<a href= \"{{url("/eventDetails")}}/{{$value[0]->id}}\"><div class=\"card\" style=\"width: 95%; margin: 0px 10px;border-radius: 15px;border: 2px solid #F5F1F2\" value='{{$value[0]->which_id}}\\{{$value[0]->id}}'>\n" +
                                  "             <img src=\"" + data[i][0].cover_img + " \" class=\"card-img-top\" style=\"border-radius: 15px 15px 0px 0px; height:180px\"></a>\n" +
                                  "             <img src=\"../resources/images/icons8-national-park-50.png\" id=\"author_icon\">\n" +
                                  "             <div class=\"card-body\" style=\"padding: 10px;\">\n" +
                                  "                  <h6 class=\"card-title\">" + data[i][0].title + "</h6>\n" +
                                  "                  <span class=\"d-inline-block text-truncate text-muted\" style=\"max-width: 100%;\">" + data[i][0].detail + "</span>\n" +
                                  "              </div>\n" +
                                  "          </div></a>\n" +
                                  "          <div style=\"height:20px;weight:100%;\"></div>";
                              $("#share_content").html(string_sum);
                          }
                      },
                  });
                  $("#selector").text("Sort by Posts");
              }

          );

      });
</script>

@endsection
