<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.headv2')
</head>
<body>
    @include('templates.parts.headerv2')
    <div class="clearfix"></div>
              <div class="container-fluid">
                <div class="row branchesv2">
                  <div class="container">
                    <div class="branchesv2tabs">
                      <button class="active" onclick="showTab('jakarta')">Jakarta</button>
                      <button onclick="showTab('surabaya')">Surabaya</button>
                    </div>
                    <div class="container custom-container-md" id="jakarta">
                        @foreach( $stores_jakarta as $index => $store )
                        <div class="col-md-12 branches-row">
                            <div class="row">
                                <div class="container-fluid" style="padding:0px">
                                    <div class="col-md-4 img-stores">
                                        @if ( $store->img_2 != null )
                                        <img src="{{ URL::asset('resources/assets/uploads/stores/'.$store->img_2) }}" class="img-responsive">
                                        @else
                                        <img src="{{ URL::asset('resources/assets/images/none_370_293.png')}}" class="img-responsive">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <h3>{{ $store->name }}</h3>
                                        <p>{!! $store->description !!}</p>
                                        <p>P: {!! $store->office_phone_number !!}</p>
                                        <p>W: {!! $store->whatsapp_number !!}</p>
                                        <div class="buttons">
                                            @if($store->whatsapp_number != '')
                                            <a href="https://wa.me/{!! $store->whatsapp_number !!}" target="_blank" class="btn btn-dark" style="text-color:white">Whatsapp</a>
                                            @endif
                                            @if($store->maps_url != '')
                                            <a href="{!! $store->maps_url !!}" target="_blank" class="btn btn-dark" style="text-color:white">Direction</a>
                                            @endif
                                            @if($store->call_number_one != '')
                                            <a href="tel:{!! $store->call_number_one !!}" class="btn btn-dark" style="text-color:white">Call 1</a>
                                            @endif
                                            @if($store->call_number_two != '')
                                            <a href="tel:{!! $store->call_number_two !!}" class="btn btn-dark" style="text-color:white">Call 2</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="container" id="surabaya" style="display: none;">
                       @foreach( $stores_surabaya as $index => $store )
                        <div class="col-md-12 branches-row">
                            <div class="row">
                                <div class="container-fluid" style="padding:0px">
                                    <div class="col-md-4 img-stores">
                                        @if ( $store->img_2 != null )
                                        <img src="{{ URL::asset('resources/assets/uploads/stores/'.$store->img_2) }}" class="img-responsive">
                                        @else
                                        <img src="{{ URL::asset('resources/assets/images/none_370_293.png')}}" class="img-responsive">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        <h3>{{ $store->name }}</h3>
                                        <p>{!! $store->description !!}</p>
                                        <p>P: {!! $store->office_phone_number !!}</p>
                                        <p>W: {!! $store->whatsapp_number !!}</p>
                                        <div class="buttons">
                                            @if($store->whatsapp_number != '')
                                            <a href="https://wa.me/{!! $store->whatsapp_number !!}" target="_blank" class="btn btn-dark" style="text-color:white">Whatsapp</a>
                                            @endif
                                            @if($store->maps_url != '')
                                            <a href="{!! $store->maps_url !!}" target="_blank" class="btn btn-dark" style="text-color:white">Direction</a>
                                            @endif
                                            @if($store->call_number_one != '')
                                            <a href="tel:{!! $store->call_number_one !!}" class="btn btn-dark" style="text-color:white">Call 1</a>
                                            @endif
                                            @if($store->call_number_two != '')
                                            <a href="tel:{!! $store->call_number_two !!}" class="btn btn-dark" style="text-color:white">Call 2</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    </div>
                  </div>
                </div>
              </div>

    @include('templates.parts.footerv2')
    <script type="text/javascript">
            function showTab(city) {
        document.getElementById('jakarta').style.display = city === 'jakarta' ? 'block' : 'none';
        document.getElementById('surabaya').style.display = city === 'surabaya' ? 'block' : 'none';
        const buttons = document.querySelectorAll('.branchesv2tabs button');
        buttons.forEach(button => button.classList.remove('active'));
        document.querySelector(`.branchesv2tabs button[onclick="showTab('${city}')"]`).classList.add('active');
    }
    </script>
</body>
</html>