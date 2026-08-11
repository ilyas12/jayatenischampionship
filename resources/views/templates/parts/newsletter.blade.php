        <script type="text/javascript">
            $(function(){
                $('#newsletter-form').submit(function(){
                    $.ajax({
                        type: "POST",
                        url: "{{URL::route('dosubscribe')}}",
                        data: {
                            'email'     : $('input[name=email]').val(),
                            '_token'    : '{{ csrf_token() }}'
                        }
                    })
                        .done(function(data){
                            data	= jQuery.parseJSON(data);
                            if(data.class == "error"){
                                $('.subscribe-text').addClass(data.class);
                                $('.subscribe-text').html(data.message.email);
                            }else{
                                $('.subscribe-text').addClass(data.class);
                                $('.subscribe-text').html(data.message.email);
                                $('#newsletter-form').html('<h5>THANK YOU FOR SUBSCRIBING.<br/>WE WILL REPLY YOU SOON!</h5>');
                            }
                            $('.error-box').fadeIn('fast');
                            $('.error-box-mobile').fadeIn('fast');
                        })
                        .fail(function(){
                            alert('Failed');
                        });
                    return false;
                });
            });
        </script>
        <div class="footer-subscribe">
            <div class="container custom-container-xs">
                <div class="subscribe-wrapper clearfix">
                    <div class="col-md-6">
                        <h5>Subscribe to newsletter to get updates!</h5>
                    </div>
                    <div class="col-md-6">
                        <form id="newsletter-form" class="subscribe-form">
                            <input type="text" name="email" class="subscribe-input" placeholder="enter email address">
                            <button class="btn btn-black">Subscribe</button>
                            <p class="subscribe-text" style="color: #fff"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>