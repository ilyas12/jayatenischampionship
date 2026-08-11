<!DOCTYPE html>
<html lang="en">
<head>
    @include('templates.parts.headv2')
</head>
<body>
    @include('templates.parts.headerv2')
    <section class="page-section" style="background:#e6dfdf">
        <div class="container custom-container-md">
            <div class="row">
                <div class="title-section">
                    <div class="title"><h4>CUSTOMER SERVICE</h4></div>
                    <span class="small-border"></span>
                </div>
                <div class="news-section">
                    <div class="container custom-container-md">
                        <div class="col-md-6">
                            <h2 class="section-title"> Problem Report</h2>
                            <div class="content">
                                <form id="contactForm" method="POST">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Your Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Problem</label>
                                        <input type="text" name="problem" class="form-control" id="problem" placeholder="Your Problem">
                                    </div>
                                    <div class="form-group">
                                        <label>Branch</label>
                                        <input type="text" name="branch" class="form-control" id="branch" placeholder="Branch">
                                    </div>
                                    <div class="form-group">
                                        <label>Voucher Number</label>
                                        <input type="text" name="voucher_number" class="form-control" id="voucher_number" placeholder="Voucher Number">
                                    </div>
                                    <div class="form-group">
                                        <label>Whatsapp No</label>
                                        <input type="text" name="subject" class="form-control" id="whatsapp" placeholder="Your Whatsapp Number">
                                    </div>
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea name="message" class="form-control" id="message" rows="3" placeholder="Your Message"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Send</button>
                                    <div id="formResponse" style="margin-top:10px;"></div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h2 class="section-title">&nbsp;</h2>
                            <div class="content">
                              
If you experience unethical behavior such as corruption, fraud, or other misconduct by our staff during your time with us, please report it securely using this form. Include the voucher number from your transaction notes as a reference for your complaint. We guarantee the confidentiality of your identity and protect all whistleblowers. Each report will be reviewed and followed up in accordance with our internal policies if it meets the criteria.
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    @include('templates.parts.footerv2')

    <style>
        #contact-us-map {
            height: 350px;
        }
    </style>
    <script>
$('#contactForm').on('submit', function (e) {
    e.preventDefault(); // prevent default form submission

    $.ajax({
        url: '/message', // Laravel controller endpoint
        type: 'POST',
        data: {
            name: $('#name').val(),
            email: $('#email').val(),
            problem: $('#problem').val(),
            branch: $('#branch').val(),
            voucher_number: $('#voucher_number').val(),
            subject: $('#whatsapp').val(),
            message: $('#message').val(),
            _token: '{{ csrf_token() }}' // required in Laravel
        },
        success: function (response) {
            if (response.class === 'success') {
                $('#formResponse').html('<div class="alert alert-success">' + response.message + '</div>');
                $('#contactForm')[0].reset(); // optional: clear the form
            } else {
                let errors = '';

                if (typeof response.message === 'object') {
                    $.each(response.message, function (key, msg) {
                        errors += '<div>' + msg + '</div>';
                    });
                } else {
                    errors = '<div>' + response.message + '</div>';
                }

                $('#formResponse').html('<div class="alert alert-danger">' + errors + '</div>');
            }
        }
    });
});
</script>
</body>
</html>