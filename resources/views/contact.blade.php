<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.head')
</head>
<body>
    @include('templates.parts.header')
    <div class="col-md-12 col-xs-12 img-head-contact">
        <img src="{{ URL::asset('resources/assets/images/'.$contact_image) }}" class="img-responsive">
    </div>
    <div class="clearfix"></div>

    <div class="container custom-container-sm">
    <div class="row">
        <section class="page-section">
            <div class="title-section">
                <div class="title"><h4>{{ $contact_title }}</h4></div>
                <span class="small-border"></span>
            </div>
                <div class="container-fluid">
        <!-- Get in Touch Section -->
        <div class="row" style="background:#b7b0b0" id="contact">
            <div class="container custom-container-md">
                <div class="col-md-12 get-in-touch">
                    <h2 class="section-title">Get in Touch</h2>
                    <div class="content">
                        <form>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <label for="whatsapp">Whatsapp No</label>
                                <input type="text" class="form-control" id="whatsapp" placeholder="Your Whatsapp Number">
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" rows="3" placeholder="Your Message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-dark">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="contact-content">
                <div class="col-md-6 info-description">
                    <h4>Our Office</h4>
                    <div class="col-md-6 info-address no-padding clearfix">
                        <span>{{ $contact_name }}</span>
                        {!! $contact_single_address !!}
                    </div>
                    <div class="col-md-6 no-padding">
                        {!! $contact_contacts !!}
                    </div>
                </div>
                <div class="col-md-6 map-content">
                    <h4>On Map</h4>
                    <div id="contact-us-map"></div>
                </div>
            </div>
        </section>
    </div>
    </div>


    @include('templates.parts.footer')

    <style>
        #contact-us-map {
            height: 350px;
        }
    </style>

    <script>
        function initMap() {
            var mapDiv = document.getElementById('contact-us-map');
            var map = new google.maps.Map(mapDiv, {
                center: { lat: {{ $contact_latitude }}, lng: {{ $contact_longitude }} },
                zoom: 15
            });

            var companyImage = new google.maps.MarkerImage('{{ $marker !== '' ? URL::asset('resources/assets/images/'.$marker) : URL::asset('resources/assets/images/pointer.png')  }}',
                new google.maps.Size(119,60),
                new google.maps.Point(0,0),
                new google.maps.Point(50,50)
            );


            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                icon: companyImage,
                position: { lat: {{ $contact_latitude }}, lng: {{ $contact_longitude }} },
            });

        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbjiUptxyk37f17PIa4WgSIV3VgVS3caE&callback=initMap">
    </script>

</body>
</html>