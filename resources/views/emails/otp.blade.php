<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
</head>
<body>
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%"
       style="margin:0;padding:0;border-collapse:collapse;border-spacing:0">
    <tbody>
    <tr>
        <td align="center" valign="top" bgcolor="#f6f6f6"
            style="margin:0;padding:0;border-collapse:collapse;border-spacing:0">
            <center>
                <table style="margin:0 auto;padding:0" cellpadding="0" cellspacing="0" width="100%">
                    <tbody>
                    <tr>
                        <td align="center" valign="top"
                            style="border-collapse:collapse;border-spacing:0;margin:0!important">
                            <table style="margin:0 auto;padding:0;border-collapse:collapse;border-spacing:0"
                                   cellpadding="0" cellspacing="0" width="96%">
                                <tbody>
                                <tr>
                                    <td style="text-align:center;padding:2% 0 20px 0!important">


                                        <table align="center"
                                               style="border-collapse:collapse;border-spacing:0;vertical-align:top;background-color:#ffffff;margin:0 auto;overflow:hidden;width:100%;max-width:500px;overflow:hidden;background-color:#ffffff;border-radius:10px">
                                            <tbody>
                                            <tr style="border-collapse:collapse;border-spacing:0;vertical-align:top">
                                                <td style="border-collapse:collapse;border-spacing:0;vertical-align:top;padding:0 5%;text-align:center;display:block;background-color:#ffffff">
                                                    <br><br><img border="0"
                                                                 src="{{asset('assets/images/logo-fasst.png')}}"
                                                                 width="110" height=""
                                                                 style="display:block;width:100%;height:auto;max-width:110px;max-height:55px;border:none;margin:0 auto;padding:0"
                                                    ><br><br></td>
                                            </tr>
                                            <tr style="border-collapse:collapse;border-spacing:0;vertical-align:top">
                                                <td style="border-collapse:collapse;border-spacing:0;vertical-align:top;padding:0 5% 20px 5%;text-align:left;display:block;background-color:#ffffff">
                                                    <h2 style="font-family:'Lato',sans-serif;font-size:16px;color:#787878;font-weight:500;line-height:1.4;margin:0;padding:0 5%">
                                                        <b>Dear {{$user->name}},</b><br><br>
                                                        Please use <b>{{$otp->code}}</b> as your One Time Password (OTP) to access
                                                        into your Account. This password is valid for <b>10</b>
                                                        minutes.<span class="im"><br><br>
							For security reasons, please do not share this OTP with anyone.
                          </span></h2><br></td>
                                            </tr>
                                            <tr style="border-collapse:collapse;border-spacing:0;vertical-align:top">
                                                <td style="border-collapse:collapse;border-spacing:0;vertical-align:top;color:#414a5c;padding:40px 10%;text-align:center;display:block;border-top:1px solid #eeeeee">
                                                    <h3 style="font-family:'Lato',sans-serif;font-size:16px;color:#414a5c;font-weight:700;line-height:1.5;margin:0 auto;padding:0;text-align:center;max-width:260px;letter-spacing:1px;text-transform:uppercase">
                                                        Got Questions?</h3>
                                                    <p style="font-family:'Lato',sans-serif;font-size:14px;color:#707070;font-weight:400;line-height:1.7;margin:0 auto;padding:0;text-align:center">
                                                        Then, please reach out to us on <a
                                                            href="mailto:feedback@jiosaavn.com"
                                                            style="color:#2e78dd;text-decoration:underline"
                                                            target="_blank">support@fasstx.com</a>
                                                    </p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </center>
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>
