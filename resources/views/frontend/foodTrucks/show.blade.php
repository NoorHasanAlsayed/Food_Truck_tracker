@extends('layouts.main')
@section('styles')
<link rel="stylesheet" type="text/css" href="star-rating-svg.css">
<style>



body {
    overflow-x: hidden
}
.sm-text {
    font-size: 10px;
    letter-spacing: 1px
}

.sm-text-1 {
    font-size: 14px
}

.green-tab {
    background-color: #00C853;
    color: #fff;
    border-radius: 5px;
    padding: 5px 3px 5px 3px
}

.btn-red {
    background-color: #E64A19;
    color: #fff;
    border-radius: 20px;
    border: none;
    outline: none
}

.btn-red:hover {
    background-color: #BF360C
}

.btn-red:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

.round-icon {
    font-size: 40px;
    padding-bottom: 10px
}

.fa-circle {
    font-size: 10px;
    color: #EEEEEF
}

.green-dot {
    color: #4CAF50
}

.red-dot {
    color: #E64A19
}

.yellow-dot {
    color: #FFD54F
}

.grey-text {
    color: #BDBDBD
}

.green-text {
    color: #4CAF50
}

.block {
    border-right: 1px solid #F5EEEE;
    border-top: 1px solid #F5EEEE;
    border-bottom: 1px solid #F5EEEE
}

.profile-pic img {
    border-radius: 50%
}

.rating-dot {
    letter-spacing: 5px
}

.via {
    border-radius: 20px;
    height: 28px
}
</style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box content-single">
                <article class="post-180 gd_place type-gd_place status-publish hentry gd_placecategory-hotels" style="overflow:hidden; position:relative">
                    <header>
                        <h1 class="entry-title">{{ $foodTruck->name }}</h1></header>
                    <div class="entry-content entry-summary">
                        @if($foodTruck->image->count())
                            <div class="geodir-post-slider center-gallery">
                                <div class="bxslider">
                                    @foreach($foodTruck->image as $photo)

                                    <div><img src="{{ $photo->thumbnail }}"></div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        @if($foodTruck->cuisines->count())
                            <div class="geodir-single-taxonomies-container">
                                <p class="geodir_post_taxomomies clearfix">
                                    <span class="geodir-category">
                                        Cuisines:
                                        @foreach($foodTruck->cuisines as $cuisine)
                                           {{ $cuisine->name }}
                                        @endforeach
                                    </span>
                                </p>
                            </div>
                        @endif
                        @if($foodTruck->features->count())
                        <div class="geodir-single-taxonomies-container">
                            <p class="geodir_post_taxomomies clearfix">
                                <span class="geodir-category">
                                    Features:
                                    @foreach($foodTruck->features as $feature)
                                       {{ $feature->name }}
                                    @endforeach
                                </span>
                            </p>
                        </div>
                    @endif
                        <div class="geodir-single-tabs-container">
                            <div class="geodir-tabs" id="gd-tabs">
                                <dl class="geodir-tab-head"><dt></dt>
                                    <dd class="geodir-tab-active"><a data-tab="#post_content" data-status="enable"><i class="fas fa-home" aria-hidden="true"></i>About</a></dd><dt></dt>
                                    @if($foodTruck->image->count())
                                        <dd class=""><a data-tab="#post_images" data-status="enable"><i class="fas fa-image" aria-hidden="true"></i>Photos</a></dd><dt></dt>
                                    @endif
                                    @if($foodTruck->latitude && $foodTruck->longitude)
                                        <dd class=""><a data-tab="#post_map" data-status="enable"><i class="fas fa-globe-americas" aria-hidden="true"></i>Map</a></dd><dt></dt>
                                    @endif
                                    @if($foodTruck->days->count())
                                        <dd class=""><a data-tab="#working_hours" data-status="enable"><i class="fas fa-clock" aria-hidden="true"></i>Working Hours</a></dd>
                                    @endif

                                        <dd class=""><a data-tab="#truckReviews" data-status="enable"><i class="fas fa-star" aria-hidden="true"></i>Reviews</a></dd><dt></dt>

                                </dl>
                                <ul class="geodir-tabs-content geodir-entry-content " style="z-index: 0; position: relative;">
                                    <li id="post_contentTab" style="display: none;"><span id="post_content"></span>
                                        <div id="geodir-tab-content-post_content" class="hash-offset"></div>
                                        <div class="geodir-post-meta-container">
                                            <div class="geodir_post_meta  geodir-field-post_content">
                                                <p>Address: {{ $foodTruck->address }}</p>
                                                <p>Owner: {{ $foodTruck->user->name }}</p>
                                                <p>Contact: {{ $foodTruck->user->contact_number }}</p>

                                                @if($foodTruck->days->count())
                                                    @if($foodTruck->working_hours->currentOpenRange(now()))
                                                        <p>Food truck is open and will close at {{ $foodTruck->working_hours->currentOpenRange(now())->end() }}.</p>
                                                    @else
                                                        <p>Food truck is closed since {{ $foodTruck->working_hours->previousClose(now())->format('l H:i') }}
                                                            and will re-open at {{ $foodTruck->working_hours->nextOpen(now())->format('l H:i') }}</p>
                                                    @endif
                                                @endif
                                                <p></p>
                                            </div>
                                        </div>
                                    </li>
                                    @if($foodTruck->image->count())
                                        <li id="post_imagesTab" style="display: none;"><span id="post_images"></span>
                                            <div id="geodir-tab-content-post_images" class="hash-offset"></div>
                                            <div class="geodir-post-slider">
                                                <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                                    <div id="geodir_images_5de6cafacbba5_180" class="geodir-image-wrapper" data-controlnav="1" data-slideshow="1">
                                                        <ul class="geodir-gallery geodir-images clearfix">
                                                            @foreach($foodTruck->image as $photo)
                                                                <li>
                                                                    <a href="{{ $photo->getUrl() }}" class="geodir-lightbox-image" target="_blank"><img src="{{ $photo->thumbnail }}" width="1440" height="960"><i class="fas fa-search-plus" aria-hidden="true"></i></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                    @if($foodTruck->latitude && $foodTruck->longitude)
                                        <li id="post_mapTab" style="display: none;">
                                            <p><strong>Please click on the map to get the directions</strong> </p>
                                            <div id="map-canvas" style="height: 425px; width: 100%; position: relative; overflow: hidden;" onclick="test()">
                                            </div>
                                        </li>
                                    @endif
                                    @if($foodTruck->days->count())
                                        <li id="working_hoursTab" style="display: none;">
                                            @foreach($foodTruck->days as $day)
                                                <p>{{ ucfirst($day->name) }}: from {{ $day->pivot->from_hours }}:{{ $day->pivot->from_minutes }} to {{ $day->pivot->to_hours }}:{{ $day->pivot->to_minutes }}</p>
                                            @endforeach
                                        </li>
                                    @endif

                                    <li id="truckReviewsTab" style="display: none;">

                                        <div class="container-fluid px-0 py-5 mx-auto">
                                            <div class="row justify-content-center mx-0 mx-md-auto">
                                                <div class="col-lg-10 col-md-11 px-1 px-sm-2">
                                                    <div class="card border-0 px-3">
                                                        <!-- top row -->
                                                        <div class="d-flex row py-5 px-5 bg-light col-md-12" style="margin: 50px">
                                                            <div class="green-tab p-2 px-3 mx-2 col-md-3">
                                                                <p class="sm-text mb-0">OVERALL RATING</p>
                                                                <h4>{{ $avg }}</h4>
                                                            </div>
                                                            <div class="white-tab p-2 mx-2 text-muted col-md-3">
                                                                <p class="sm-text mb-0">ALL REVIEWS</p>
                                                                <h4>{{  $totalReviews }}</h4>
                                                            </div>
                                                            <div class="white-tab p-2 mx-2 col-md-3">
                                                                <p class="sm-text mb-0 text-muted">POSITIVE REVIEWS</p>
                                                                <h4 class="green-text">{{  $postive }}%</h4>
                                                            </div>
                                                            @auth
                                                            @if(Auth::user()->id != $foodTruck->user_id)
                                                            <div class="ml-md-auto p-2 mx-md-2 pt-4 pt-md-3"> <button class="btn btn-red px-4" onclick="show()">WRITE A REVIEW</button> </div>
                                                            @endif
                                                            @endauth
                                                        </div> <!-- middle row -->
                                                        @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
                                                        @if($foodTruck->truckReviews->count())
                                                        @foreach($foodTruck->truckReviews as $review)
                                                                <!-- Review by user -->
                                                        <div class="review p-5" >
                                                            <div class="row d-flex col-md-3" >
                                                                <h4>{{ $review->user->name }}</h4>
                                                                <p class="grey-text">{{ $review->created_at->diffForHumans() }}</p>
                                                                <div class="d-flex flex-column pl-3">

                                                                </div>
                                                            </div>
                                                            <div class="row pb-3  col-md-9">
                                                                @for ($i = 0; $i < $review->rate; $i++)
                                                                <div class="fa fa-circle green-dot my-auto rating-dot"></div>
                                                                @endfor
                                                                <div class="green-text">
                                                                    <h5 class="mb-0 pl-3">{{$review->body}}</h5>
                                                                </div>
                                                            </div>




                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        @endforeach
                                       @endif
@auth


                                        <form  method="POST" action="{{ route("reviewStore") }}"style="display: none;"  id="feedback" >
                                            @csrf
                                            <div class="form-row" >
                                              <div class="col">
                                                <input type="text" name='body' class="form-control" placeholder="feedback" required>
                                                @if($errors->has('body'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('body') }}
                                                </div>
                                            @endif
                                              </div>
                                              <div class="col">
                                                <input type="range" name='rate'  min ="1" max="5" class="form-control" placeholder=" your rate">
                                              </div>
                                              <input type="hidden" name='truck_id'value={{ $foodTruck->id}}>
                                              <input type="hidden" name='user_id'value={{ Auth::user()->id}}>
                                              <div class="col">
                                                <button class="btn btn-red px-4" type="submit">Submit</button>
                                              </div>

                                            </div>
                                          </form>
                                          @endauth


                                    </li>
                                </div>


                                </ul>
                            </div>
                        </div>
                        <div class="geodir-single-taxonomies-container">
                            <div class="geodir-pos_navigation clearfix">
                                <div class="geodir-post_left">
                                    <a href="{{ url()->previous() }}" rel="prev">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="entry-footer"></footer>
                </article>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
<style>
@media only screen and (min-width: 675px) {
    .center-gallery {
        width: 50%;
        margin: auto;
    }
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
    function show(){
document.getElementById('feedback').style.display="block";
    }
    function test(){
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(directions);
  } else {
   alert("Geolocation is not supported by this browser.");
  }
}
    function directions(){

        var latDes = {{ $foodTruck->latitude }};
var longDes = {{ $foodTruck->longitude }};
var url = "https://www.google.com/maps/dir/?api=1&";
var origin = "origin=" + "26.168270" + "," + "50.615101";
var destination = "&destination=" + latDes + "," + longDes;
var newUrl = new URL(url + origin + destination);

 window.open(newUrl, '_blank');

    }
if (window.location.hash && window.location.hash.indexOf('&') === -1 && jQuery(window.location.hash + 'Tab').length) {
    hashVal = window.location.hash;
} else {
    hashVal = jQuery('dl.geodir-tab-head dd.geodir-tab-active').find('a').attr('data-tab');
}
openTab(hashVal);

jQuery('dl.geodir-tab-head dd a').click(function() {
    openTab(jQuery(this).data('tab'))
});

function openTab(hashVal)
{
    jQuery('dl.geodir-tab-head dd').each(function() {
        var tab = '';
        tab = jQuery(this).find('a').attr('data-tab');
        jQuery(this).removeClass('geodir-tab-active');
        if (hashVal != tab) {
            jQuery(tab + 'Tab').hide();
        }
    });
    jQuery('a[data-tab="'+hashVal+'"]').parent().addClass('geodir-tab-active');
    jQuery(hashVal + 'Tab').show();
}

$(function(){
    $('.bxslider').bxSlider({
        mode: 'fade',
        slideWidth: 600
    });
});
// specify the color per rating level

</script>
@if($foodTruck->latitude && $foodTruck->longitude)
    <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&region=GB'></script>

     <script defer>


        function initialize() {
            const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
             latLng = new google.maps.LatLng({{ $foodTruck->latitude }}, {{ $foodTruck->longitude }});
             start= new google.maps.LatLng( 26.168270,50.615101);
            var mapOptions = {
                zoom: 14,
                minZoom: 6,
                maxZoom: 17,
                zoomControl:true,
                zoomControlOptions: {
                    style:google.maps.ZoomControlStyle.DEFAULT
                },
                center: latLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                panControl:false,
                mapTypeControl:false,
                scaleControl:false,
                overviewMapControl:false,
                rotateControl:false
            }
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            var image = new google.maps.MarkerImage("{{ asset('assets/images/pin.png') }}", null, null, null, new google.maps.Size(40,52));

            var content = `
            <div class="gd-bubble" style="">
                <div class="gd-bubble-inside">
                    <div class="geodir-bubble_desc">
                    <div class="geodir-bubble_image">
                        <div class="geodir-post-slider">
                            <div class="geodir-image-container geodir-image-sizes-medium_large ">
                                <div id="geodir_images_5de53f2a45254_189" class="geodir-image-wrapper" data-controlnav="1">
                                    <ul class="geodir-post-image geodir-images clearfix">
                                        <li>
                                            <div class="geodir-post-title">
                                                <h4 class="geodir-entry-title">
                                                    <a href="{{ route('food-trucks.show', $foodTruck->id) }}" title="View: {{ $foodTruck->name }}">{{ $foodTruck->name }}</a>
                                                </h4>
                                            </div>
                                            <a href="{{ route('food-trucks.show', $foodTruck->id) }}"><img src="{{ $foodTruck->thumbnail }}" alt="{{ $foodTruck->name }}" class="align size-medium_large" width="1400" height="930"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="geodir-bubble-meta-side">
                    <div class="geodir-output-location">
                    <div class="geodir-output-location geodir-output-location-mapbubble">
                        <div class="geodir_post_meta  geodir-field-post_title"><span class="geodir_post_meta_icon geodir-i-text">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">truck Title: </span></span>{{ $foodTruck->name }}</div>
                        <div class="geodir_post_meta  geodir-field-address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <span class="geodir_post_meta_icon geodir-i-address"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <span class="geodir_post_meta_title">Address: </span></span><span itemprop="streetAddress">{{ $foodTruck->address }}</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            </div>
            </div>`;
            var marker = new google.maps.Marker({
                position: latLng,
                icon:image,
                map: map,
                title: '{{ $foodTruck->name }}'
            });
            var infowindow = new google.maps.InfoWindow();
            google.maps.event.addListener(marker, 'click', (function (marker) {
                return function () {
                    infowindow.setContent(content)
                    infowindow.open(map, marker);
                }
            })(marker));
            directionsRenderer.setMap(map);
            calculateAndDisplayRoute(directionsService, directionsRenderer);

        }
        function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        directionsService.route(
          {
            origin: {
              start,
            },
            destination: {
              latLng,
            },
            travelMode: google.maps.TravelMode.DRIVING,
          },
          (response, status) => {
            if (status === "OK") {
              directionsRenderer.setDirections(response);
            } else {
              window.alert("Directions request failed due to " + status);
            }
          }
        );
      }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endif
@endsection
