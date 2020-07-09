<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>FMC - Forgot Password</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial," sans-serif";
            background-color: #FFFFFF;
        }
        p {
            margin: 0;
            padding: 0;            
        }
        .top-title{
            color: #353535;
        }
        .welcome-text{
            margin:0px;
            color: #353535;
            margin-top: 5px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .welcome-description{
            color: #262626;
            font-size: 18px;
        }
        .border-bottom{
            border-bottom: 1px solid gray;
        }   
        .deal-product-sub-title{
            color: #797979;
            font-size: 18px;
        } 

        .product-box{
            border: 1px solid #A9A9A9;
            border-radius: 5px;
            height: 250px;
            width: 180px;
        }
        .product-box .product-title{
            color: #4a4a4a;
            font-size: 11px;
            padding-left: 5px;
            padding-right: 5px;
            text-align: left;
            height: 25px;
        }
        .product-price{
            color: #829cc0;
            padding-left: 5px;
            padding-right: 5px;
        }
        .product-price:after{
            content: ' SAR';
            font-size: 0.6em;
            vertical-align: bottom;
            color: #829cc0;
        }
        .coupon-disc-text{
            color: #FFF;
            font-size: 25px;            
        }
        .awsome-btn{
            height: 50px;
            background-color: #d2d91e;
            color: #FFFFFF;
            border: 0px;
            width: 100%;
            font-size: 20px;
        }
        .domain-name{
            text-decoration: none;
            font-size: 18px;
            color: #858585;
            font-weight: bold;
        }
        .download-text{
            font-size: 20px;
            color: #858585;
        }
        .address-text p{
            font-size: 15px;
            color: #858585;
        }
    </style>
</head>

<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #FFFFFF;">
        <tbody>
            <tr>
                <td height="50" align="center">&nbsp;</td>
            </tr>
            <tr>
                <td align="center">
                    <table width="665" class="border-bottom">
                        <tr>
                            <td align="left" width="33%">
                                <h2 class="top-title">FORGOT PASSWORD</h2>
                            </td>
                            <td align="center" width="34%">
                                <img src="<?php echo base_url(); ?>assets/email-images/mainlogo.png">
                            </td>
                            <td align="right" width="33%">
                                <h2 class="top-title">هل نسيت كلمة المرور</h2>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <table width="665" style="margin-top: 10px;">
                        <tr>
                            <td>
                                <h3 class="welcome-text">Hi <?php echo $user_fullname; ?>,</h3>
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <p class="welcome-description">To verify your identity, please use the following password reset code : </p>
                            </td>
                        </tr>
                        <tr>
                            <td align="left"><h1 class="opt-code"><?php echo $otp_code; ?></h1></td>
                        </tr>
                        <tr>
                            <td align="left">
                                <p class="welcome-description">Do not share this OTP with anyone. We take your account security very seriously. Our Customer Service will never ask you to disclose or verify your Account password, OTP, credit card or banking account number. If you receive a suspecious email with link to update your account information, do not click on the link instead, report the email to use for investigation.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <?php include("footer.php") ?>            
        </tbody>
    </table>

</body>
</html>
