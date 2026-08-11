<table width="100%" style="margin-bottom: 20px;">
    <tr>
        <td>
            <img src="https://duasisimoneychanger.co.id/resources/assets/imagesv2/logo.png" alt="Logo" width="200" height="80" />
        </td>
        </tr>
</table>

<p><strong>Problem Report:</strong></p>

<table width="100%" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
    <tr>
        <td width="25%"><strong>Date</strong></td>
        <td width="5%">:</td>
        <td>{{ date('d M Y \\( H:i A \\)') }}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>:</td>
        <td>{{ $name }}</td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td>:</td>
        <td>{{ $email }}</td>
    </tr>
    <tr>
        <td><strong>Branch</strong></td>
        <td>:</td>
        <td>{{ $branch ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Problem</strong></td>
        <td>:</td>
        <td>{{ $problem ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Voucher Number</strong></td>
        <td>:</td>
        <td>{{ $voucher_number ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Whatsapp No</strong></td>
        <td>:</td>
        <td>{{ $subject ?? '-' }}</td>
    </tr>
    <tr>
        <td><strong>Message</strong></td>
        <td>:</td>
        <td>{{ $msg }}</td>
    </tr>
</table>

<br>
<hr>

<table width="100%" style="margin-top: 20px;">
    <tr>
        <td style="text-align: left;">
            <a href="https://www.facebook.com/duasisimc" target="_blank">
                <img src="https://duasisimoneychanger.co.id/resources/assets/imagesv2/logo-fb.png" alt="Facebook" width="16" height="16" />
            </a>&nbsp;
            <a href="https://www.instagram.com/duasisimc" target="_blank">
                <img src="https://duasisimoneychanger.co.id/resources/assets/imagesv2/logo-ig.png" alt="Instagram" width="16" height="16" />
            </a>&nbsp;
            <a href="https://www.threads.com/@duasisimc" target="_blank">
                <img src="https://duasisimoneychanger.co.id/resources/assets/imagesv2/logo-thr.png" alt="Threads" width="16" height="16" />
            </a>
        </td>
        <td style="text-align: right;">
            DUA SISI MONEY CHANGER &copy; {{ date('Y') }} 
        </td>
    </tr>
</table>
