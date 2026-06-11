<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="UTF-8">
  <title>User Verified</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
      font-family: Arial, 'Hiragino Kaku Gothic ProN', 'Meiryo', sans-serif;
    }

    .wrapper {
      width: 100%;
      background-color: #f5f5f5;
    }

    .container {
      width: 600px;
      max-width: 600px;
      background-color: #ffffff;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .header {
      background-color: #C40057;
      padding: 10px 20px;
      color: #ffffff;
      font-size: 20px;
      font-weight: bold;
      letter-spacing: 1px;
      text-align: center;
    }

    .greeting {
      padding: 25px 20px;
      font-size: 15px;
      color: #333;
      line-height: 1.6;
    }

    .section {
      padding: 0 20px 20px;
    }

    .note-box {
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 15px;
      margin-bottom: 20px;
      font-size: 14px;
      color: #333;
      background-color: #f7f7f7;
      line-height: 1.6;
    }
    .info-wrapper{
        padding: 0 20px;
        display: flex;
    }

    .login-info {
      border: 1px solid #C40057;
      border-radius: 6px;
      padding: 15px;
      font-size: 14px;
      color: #333;
      background-color: #fff0f5;
      line-height: 1.6;
      width: 100%;
    }

    .login-info a {
      color: #C40057;
      text-decoration: none;
      word-break: break-all;
    }

    .note {
      padding: 0 20px 20px;
      font-size: 15px;
      color: #555;
      line-height: 1.6;
    }


    .contact {
      padding: 20px;
      font-size: 13px;
      color: #333;
      border-top: 1px solid #eee;
      line-height: 1.6;
    }

    .contact a {
      color: #C40057;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <table class="wrapper" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td align="center" style="padding:20px 10px;">
        <table class="container" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td class="header">User Verified</td>
          </tr>

          <tr>
            <td class="greeting">
              {{$first_name}}<br><br>
              This User is Verified Succefully<br>
              Now you can use all the features of our service.<br>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>

</html>
