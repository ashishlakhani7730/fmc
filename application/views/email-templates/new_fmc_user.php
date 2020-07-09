<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>FMC - Welcome</title>
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
            <?php include("header.php") ?>
            <tr>
                <td align="center" dir="rtl">
                    <table width="665" style="margin-top: 10px;">
                        <tr>
                            <td><h3 class="welcome-text">أهلا بك <?php echo $user_fullname; ?>,</h3></td>
                        </tr>
                        <tr>
                            <td align="right">
                                <p class="welcome-description">مرحبا بكم في تطبيق FMC. استخدم بيانات الاعتماد أدناه لتسجيل الدخول.</p>
                                <br>
                                <p>Email: <?php echo $email; ?></p>
                                <p>Password: <?php echo $password; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <table width="665" style="margin-top: 10px;">
                        <tr>
                            <td><h3 class="welcome-text">WELCOME <?php echo $user_fullname; ?>,</h3></td>
                        </tr>
                        <tr>
                            <td>
                                <p class="welcome-description">Welcome to FMC App. Use below credential for login.</p>
                                <br>
                                <p>Email: <?php echo $email; ?></p>
                                <p>Password: <?php echo $password; ?></p>
                            </td>
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
