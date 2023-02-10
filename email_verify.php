<?php
include_once './sn/con.php';
session_start();
$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
$email = mysqli_real_escape_string($con, htmlspecialchars($_GET['email'], ENT_QUOTES));
$sql = "SELECT verifyIs FROM apnaStudents WHERE emailIs = ?;";
$stmt = $con->stmt_init();
$stmt->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows() != 1) {
	header("Location: /index?from=email&status=error");
	exit();
} else {
	$stmt->bind_result($token);
	$stmt->fetch();
	if (isset($_GET['action'])) {
		$action = mysqli_real_escape_string($con, htmlspecialchars($_GET['action'], ENT_QUOTES));
	} else {
		$action = null;
	}
	if (isset($_GET['status'])) {
		$status = mysqli_real_escape_string($con, htmlspecialchars($_GET['status'], ENT_QUOTES));
	} else {
		$status = null;
	}
	if ($action == "mail_again") {
		$subject = "Verify your Account|Apnasikshalaya";
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
												<td style="padding: 1px 0 0px 0">
													<center><a
													href="https://www.apnasikshalaya.com/"
													style="text-decoration: none"
													target="_blank"
													><img
														alt="Apnasikshalaya"
														draggable="false"
														border="0"
														height="27"
														src="https://apnasikshalaya.com/images/logo.png"
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
													border-top: 3px solid
														rgba(255, 86, 0, 1);
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
															<td>
															<p
																style="
																margin: 0;
																font-size: 18px;
																line-height: 23px;
																color: #102231;
																font-weight: bold;
																"
															>
																<strong>
																Dear Learner,</strong
																><br /><br />
															</p>
															</td>
														</tr>

														<tr>
															<td>
															To complete your sign up,
															please enter this otp:
															<br /><br />
															</td>
														</tr>
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
																	<p
																		style="
																		color: #333;
																		display: inline-block;
																		font-family: \'Bona Nova\'
																			sans-serif;
																		font-size: 1.6rem;
																		font-weight: bold;
																		text-align: center;
																		text-decoration: none;
																		letter-spacing: 2px;
																		"
																	>
																		<abbr
																		title="Click to copy"
																		id="abbr"
																		onclick="this.setAttribute(\'title\',\'Copied\'); navigator.clipboard.writeText(this.innerHTML);   alert(\'Copied text: \' + this.innerHTML);"
																		>' . $token . '</abbr
																		>
																	</p>
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
														<tr>
															<td style="padding-top: 30px">
															<p
																style="
																margin: 20px 0 20px 0;
																"
															>
																Or copy this link and paste
																in your web browser
															</p>
															<p
																style="
																margin: 20px 0;
																font-size: 22px;
																line-height: 17px;
																word-wrap: break-word;
																word-break: break-all;
																"
															>
																<a
																href="https://www.apnasikshalaya.com/account/verify_email?user_key=' . $token . '&amp;code=' . $token . '"
																style="
																	color: #5885ff;
																	text-decoration: underline;
																	font-size: 17px;
																	line-height: 17px;
																"
																target="_blank"
																>https://www.apnasikshalaya.com/account/verify_email?user_key=' . $token . '&amp;code=' . $token . '</a
																>
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
									>User guidelines</a
									>
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
		$headers .= "From: Apna Sikshalaya <no_reply@apnasikshalaya.com>" . "\r\n";
		mail($email, $subject, $msg, $headers);
		header("Location: /email_verify?email=$email&status=resend");
		exit();
	} else {
		echo '<!DOCTYPE html>
		<html><head>
		<title>Verify your Email | Apnasikshalaya</title>
		</head><body>';
		include_once 'header.php';
		echo '<style>
		* {font-family: "Bona nova";}
		.form {padding: 24px; max-width: 500px; width:100%; display: block; margin: 20vh auto; border-radius: 12px;
			box-shadow: 0 16px 22px 0 rgba(90, 91, 95, 0.2);}
		.center {text-align: center; display: block; margin: auto;}
		.a {text-decoration: underline;}
		.input {width: 90% !important; margin: auto !important;}
		.alert {width: 84% !important; margin: 12vh auto; display: block;}
		input::-webkit-outer-spin-button, input::-webkit-inner-spin-button {
  			-webkit-appearance: none; margin: 0;}
  		input[type=number] {-moz-appearance: textfield;}
	</style><div>
	<form action="/student/index" method="POST" class="form">
		<h2 class="center">Email verification</h2>
		<small class="center">Please check the spam folder of your email</small>
		<br>';
		if ($_GET['status']) {
			if ($_GET['status'] == 'invalid_otp') {
				echo '<div class="alert alert-danger" role="alert">Invalid OTP. Please try again.</div>';
			} elseif ($_GET['status'] == 'not_verify') {
				echo '<div class="alert alert-warning" role="alert">Please verify your email.</div>';
			} elseif ($_GET['status'] == 'resend') {
				echo '<div class="alert alert-success" role="alert">OTP sent successfully.</div>';
			}
		}
		echo '
		<label class="center" for="otp">One time password: </label>
		<br>
		<input name="otp" type="number" class="form-text input" placeholder="Enter OTP" id="otp" min="0">
		<br>
		<a class="center a" href="/email_verify?action=mail_again&email=' . $email . '">Resend OTP</a>
		<button type="submit" class="arrow-btn center">Submit</button>
	</form>
	</div>
	';
		include_once 'footer.php';
		echo'</body><html>';
	}
}
