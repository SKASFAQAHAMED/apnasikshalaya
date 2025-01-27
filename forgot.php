<?php
include_once "./sn/con.php";
session_start();
if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $sql = "SELECT emailIs, nameIs FROM apnaStudents WHERE emailIs = ?;";
    $stmt = $con->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows() == 1) {
        $stmt->store_result();
        $stmt->bind_result($emailis, $nameis);
        $stmt->fetch();
        $_SESSION['resetmsg'] = "Please check your email";
        $to = $email;
        $subject = "Reset Your Password Now | Apnasikshalaya";
        $msg = '
<!DOCTYPE html>
<html lang="en">
  <head>
    <!--[if gte mso 9
      ]><xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG />
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
      </xml><!
    [endif]-->

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <!--[if !mso]-->
    <!-- -->
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <!--<![endif]-->
    <!--[if !mso]-->
    <!-- -->
    <link
      href="https://fonts.googleapis.com/css2?family=Bona+Nova&display=swap"
      rel="stylesheet"
    />
    <!--<![endif]-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
    />
    <style type="text/css">
      html,
      body {
        background-color: #fafbfc;
      }
      img {
        display: block;
      }
      .ReadMsgBody {
        width: 100%;
      }
      .ExternalClass {
        width: 100%;
      }
      * {
        -webkit-text-size-adjust: none;
        font-family: "Bona Nova", sans-serif;
      }
      .whiteLinks a:link,
      .whiteLinks a:visited {
        color: #ffffff !important;
      }
      .appleLinksGrey a {
        color: #b7bdc1 !important;
        text-decoration: none !important;
      }
      table {
        border-collapse: collapse;
      }
      .preheader {
        font-size: 1px;
        line-height: 1px;
        display: none !important;
        mso-hide: all;
      }
      /* AOL Mail td overrides */
      #maincontent td {
        color: #525c65;
      }
      i {
        font-size: 1.6rem;
        color: #999;
      }
      #abbr {
        text-decoration: none;
        cursor: pointer;
      }
      #maincontent td a {
        font-size: 0.5rem;
        text-decoration: none;
        margin-bottom: 6px;
        color: #5885ff;
      }
      .arrow-btn {
        position: relative;
        outline: none;
        -moz-appearance: none;
        -webkit-appearance: none;
        -webkit-tap-highlight-color: transparent;
        cursor: pointer;
        background: linear-gradient(
          90deg,
          rgba(255, 86, 0, 1) 0%,
          rgba(255, 0, 146, 1) 100%
        );
        border: none;
        border-radius: 6px;
        color: #ffffff;
        text-align: center;
        padding: 8px 15px;

        text-decoration: none;
        line-height: 1.5;
        z-index: 9;
      }
    </style>
    <!--[if mso]>
      <style type="text/css">
        body,
        table,
        td,
        a {
          font-family: Arial, Helvetica, sans-serif !important;
        }
      </style>
    <![endif]-->
  </head>
  <body bgcolor="#fafbfc" style="margin: 0; padding: 0" yahoo="fix">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
        <tr>
          <td style="background-color: #fafbfc">
            <center
              bgcolor="#fafbfc"
              style="
                width: 100%;
                background-color: #fafbfc;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
              "
            >
              <div
                id="maincontent"
                style="max-width: 620px; font-size: 0; margin: 0 auto"
              >
                <div
                  class="preheader"
                  style="
                    font-size: 1px;
                    line-height: 1px;
                    display: none !important;
                    mso-hide: all;
                  "
                >
                  One more step to get started
                </div>
                <!--[if gte mso 9]>
              <table border="0" cellpadding="0" cellspacing="0" style="width:620px;">
                <tr>
                  <td valign="top">
            <![endif]-->
                <table
                  border="0"
                  cellpadding="0"
                  cellspacing="0"
                  style="width: 100%"
                >
                  <tbody>
                    <tr>
                      <td>
                        <table
                          border="0"
                          cellpadding="0"
                          cellspacing="0"
                          style="width: 100%"
                        >
                          <tbody>
                            <tr>
                              <td align="center" style="padding-bottom: 20px">
                                <table
                                  border="0"
                                  cellpadding="0"
                                  cellspacing="0"
                                  style="
                                    font-size: 13px;
                                    line-height: 18px;
                                    color: rgba(255, 86, 0, 1);
                                    text-align: center;
                                    width: 152px;
                                  "
                                >
                                  <tbody>
                                    <tr>
                                      <td style="padding: 1px">
                                        <center><a
                                          href="https://www.apnasikshalaya.com/"
                                          style="text-decoration: none"
                                          target="_blank"
                                          ><img
                                            alt="Apnasikshalaya"
                                            border="0"
                                            height="27"
                                            src="https://apnasikshalaya.com/images/logo.png"
                                            draggable="false"
                                            style="
                                              display: block;
                                              height: 100px;
                                            "
                                        /></a></center>
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

                    <tr>
                      <td>
                        <table
                          border="0"
                          cellpadding="0"
                          cellspacing="0"
                          style="width: 100%"
                        >
                          <tbody
                            style="
                              box-shadow: 0 16px 22px 0 rgb(90 91 95 / 30%);
                              border-radius: 12px;
                            "
                          >
                            <tr>
                              <td bgcolor="#ffffff" style="border-radius: 12px">
                                <table
                                  border="0"
                                  cellpadding="0"
                                  cellspacing="0"
                                  style="width: 100%"
                                >
                                  <tbody>
                                    <tr>
                                      <td
                                        style="
                                          text-align: center;
                                          padding: 40px 40px 40px 40px;
                                          border-top: 3px solid #ff0050;
                                        "
                                      >
                                        <!--[if gte mso 9]>
                              <table border="0" cellpadding="0" cellspacing="0" style="width:520px;">
                                <tr>
                                  <td valign="top">
                            <![endif]-->
                                        <div
                                          style="
                                            display: inline-block;
                                            width: 100%;
                                            max-width: 520px;
                                          "
                                        >
                                          <table
                                            border="0"
                                            cellpadding="0"
                                            cellspacing="0"
                                            style="
                                              font-size: 14px;
                                              line-height: 24px;
                                              color: #525c65;
                                              text-align: left;
                                              width: 100%;
                                            "
                                          >
                                            <tbody>
                                              <tr>
                                                <td
                                                  align="center"
                                                  style="
                                                    border-bottom: 1px solid
                                                      #999;
                                                  "
                                                >
                                                  <table
                                                    border="0"
                                                    cellpadding="0"
                                                    cellspacing="0"
                                                    style="
                                                      border-collapse: separate !important;
                                                      border-radius: 15px;
                                                      width: 210px;
                                                    "
                                                  >
                                                    <tbody>
                                                      <tr>
                                                        <td
                                                          align="center"
                                                          valign="top"
                                                        >
                                                          <!--[if gte mso 9]>
					<table border="0" cellspacing="0" cellpadding="0" style="width:210px">
						<tr>
							<td bgcolor="#01b3e3" style="padding:0px 10px; text-align:center;" valign="top">
				<![endif]-->
                                                          <img
                                                            src="https://apnasikshalaya.com/img/mails/p.gif"
                                                            alt="verified gif"
                                                            height="200px"
                                                            draggable="false"
                                                            style="
                                                              filter: hue-rotate(
                                                                  102deg
                                                                )
                                                                saturate(3.5);
                                                            "
                                                          />
                                                          <!--[if gte mso 9]>
							</td>
						</tr>
					</table>
				<![endif]-->
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                  <h1>Forgot your Password?</h1>
                                                  <p
                                                    style="
                                                      font-size: 1.2rem;
                                                      max-width: 80%;
                                                    "
                                                  >
                                                    If you\'ve lost your Password
                                                    to reset it, use the link to
                                                    reset it.
                                                  </p>

                                                  <button class="arrow-btn">
                                                    <a
                                                      href="https://apnasikshalaya.com/resetpass?token='.$email.'"
                                                      style="
                                                        color: white;
                                                        font-size: 1rem;
                                                        font-weight: bold;
                                                        letter-spacing: 1px;
                                                      "
                                                      >Reset Your Password</a
                                                    >
                                                  </button>
                                                  <br />
                                                  <p style="font-size: 0.9rem">
                                                    If you did not request a
                                                    Password reset, you can
                                                    safely ignore this email.
                                                    Only a person with access to
                                                    your email can reset your
                                                    account Password.
                                                  </p>
                                                  <br /><br />
                                                </td>
                                              </tr>
                                              <tr>
                                                <td style="padding-top: 30px">
                                                  <p
                                                    style="
                                                      margin: 20px 0 20px 0;
                                                    "
                                                  >
                                                    Welcome to Apnasikshalaya
                                                    family.
                                                  </p>
                                                </td>
                                              </tr>
                                              <tr>
                                                <td
                                                  style="
                                                    color: #363636;
                                                    padding: 0 0 14px;
                                                  "
                                                >
                                                  Cheers,
                                                </td>
                                              </tr>
                                              <tr>
                                                <td
                                                  style="
                                                    color: #363636;
                                                    padding: 0 0 7px;
                                                  "
                                                >
                                                  The Apnasikshalaya Team
                                                </td>
                                              </tr>
                                            </tbody>
                                          </table>
                                        </div>
                                        <!--[if gte mso 9]>
                                    </td>
                                  </tr>
                                </table>
                              <![endif]-->
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
                    <tr>
                      <td style="text-align: center; padding: 0">
                        <!--[if gte mso 9]>
                  <table border="0" cellpadding="0" cellspacing="0" style="width:520px;">
                    <tr>
                      <td valign="top">
                <![endif]-->

                        <!--[if gte mso 9]>
                        </td>
                      </tr>
                    </table>
                  <![endif]-->
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding: 30px 0 20px 0">
                        <table
                          border="0"
                          cellpadding="0"
                          cellspacing="0"
                          style="width: 220px"
                        >
                          <tbody>
                            <tr>
                              <td align="center">
                                <a href="#" target="_blank"
                                  ><i class="fab fa-twitter-square"></i
                                ></a>
                              </td>
                              <td align="center">
                                <a href="#" target="_blank"
                                  ><i class="fab fa-facebook-square"></i
                                ></a>
                              </td>
                              <td align="center">
                                <a href="#" target="_blank"
                                  ><i class="fab fa-linkedin"></i
                                ></a>
                              </td>
                              <td align="center">
                                <a href="#" target="_blank"
                                  ><i class="fab fa-instagram-square"></i
                                ></a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding-bottom: 20px">
                        <table
                          border="0"
                          cellpadding="0"
                          cellspacing="0"
                          style="
                            font-size: 12px;
                            line-height: 18px;
                            text-align: center;
                            width: auto;
                          "
                        >
                          <tbody>
                            <tr>
                              <td style="color: #b7bdc1">
                                <p style="margin: 0">
                                  <span class="appleLinksGrey"
                                    ><a href="https://www.apnasikshalaya.com/"
                                      >Apnasikshalaya Copyright</a
                                    ></span
                                  >
                                  &nbsp;•&nbsp;
                                  <span class="appleLinksGrey">
                                    &#169; 2021</span
                                  >
                                </p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr align="center">
                      <td style="padding-bottom: 16px">
                        <a
                          href="https://apnasikshalaya.com/terms_and_conditions"
                          >Terms & Condation |
                        </a>
                        <a href="https://apnasikshalaya.com/privacy_policy"
                          >Privacy Policy |
                        </a>
                        <a href="https://apnasikshalaya.com/user"
                          >User guidelines |
                        </a>
                        <a href="#">Unsubscribe</a>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!--[if gte mso 9]>
                </td>
              </tr>
            </table>
          <![endif]-->
              </div>
            </center>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
        ';
        
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .="From: Apna Sikshalaya <no_reply@apnasikshalaya.com>" . "\r\n";
        if (mail($to, $subject, $msg, $headers)) {
            echo 'Done, Please check your Email';
        } else {
            echo 'There was some issue. please try again';
        }
    } else {
        echo 'Please check the email you entered and try again';
    }
}
