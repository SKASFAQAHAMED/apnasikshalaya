<?php
include_once("../sn/con.php");
session_start();
$show = "show";
$hide = "hide";
if(isset($_POST['from'])) {
    $from = mysqli_real_escape_string($con, htmlspecialchars($_POST['from'], ENT_QUOTES));
} elseif(isset($_GET['from'])) {
    $from = mysqli_real_escape_string($con, htmlspecialchars($_GET['from'], ENT_QUOTES));
} else {
    $from = null;
} if(isset($_POST['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_POST['action'], ENT_QUOTES));
} elseif(isset($_GET['action'])) {
    $action = mysqli_real_escape_string($con, htmlspecialchars($_GET['action'], ENT_QUOTES));
} else {
    $action = null;
}
if($from == "signin") {
	$desi = $_POST['designation'];
	if(isset($_POST['designation']) && $desi=="student"){
	$email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));
	$sql = "SELECT id, verifyIs FROM apnaStudents WHERE emailIs = ? && passIs = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("ss", $email, $pass);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows() == 1) {
		$stmt->bind_result($id, $verify);
		$stmt->fetch();
		$dt= date("Y-m-d H:i:s");
		$sql8 = "UPDATE apnaStudents SET lastloginIs = '$dt' WHERE id = '$id';";
		$d=mysqli_query($con,$sql8);
		$_SESSION['user'] = $email;
		$_SESSION['pass'] = $pass;
		$_SESSION['Role'] = "student";
		if($verify != 1) {
			$token = rand(100000, 999999);
			$sql2 = "UPDATE apnaStudents SET verifyIs = ? WHERE id = ?;";
			$stmt2 = $con->stmt_init();
			$stmt2->prepare($sql2);
			$stmt2->bind_param("ii", $token, $id);
			$stmt2->execute();
			$subject = "Verify your Email | Apnasikshalaya";
			$body = '
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
																			>'.$token.'</abbr
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
																	href="https://www.apnasikshalaya.com/account/verify_email?user_key='.$token.'&amp;code='.$token.'"
																	style="
																		color: #5885ff;
																		text-decoration: underline;
																		font-size: 17px;
																		line-height: 17px;
																	"
																	target="_blank"
																	>https://www.apnasikshalaya.com/account/verify_email?user_key='.$token.'&amp;code='.$token.'</a
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
			mail($email, $subject, $body, $headers);
			header("Location: /email_verify?email=$email");
			exit();
		} else {
			
			header("Location: /student/index");
			exit();
		}
	} else {
		header("Location: /index?from=signin&status=error");
		exit();
	}
}//student signin ending bracket
	if(isset($_POST['designation']) && $desi=="teacher"){
	$email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));
	$sql = "SELECT id, verifyIs FROM apnaTeachers WHERE emailIs = ? && passIs = ?;";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("ss", $email, $pass);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows() == 1) {
		$stmt->bind_result($id, $verify);
		$stmt->fetch();
		$dt= date("Y-m-d H:i:s");
		$sql8 = "UPDATE apnaTeachers SET lastloginIs = '$dt' WHERE id = '$id';";
		$d=mysqli_query($con,$sql8);
		$_SESSION['user'] = $email;
		$_SESSION['pass'] = $pass;
		$_SESSION['Role'] = "teacher";
		if($verify != 1) {
			$token = rand(100000, 999999);
			$sql2 = "UPDATE apnaTeachers SET verifyIs = ? WHERE id = ?;";
			$stmt2 = $con->stmt_init();
			$stmt2->prepare($sql2);
			$stmt2->bind_param("ii", $token, $id);
			$stmt2->execute();
			$subject = "Verify your Account | Apnasikshalaya";
			$body = '
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
																	Dear Mentor,</strong
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
																			>'.$token.'</abbr
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
																	href="https://www.apnasikshalaya.com/account/verify_email?user_key='.$token.'&amp;code='.$token.'"
																	style="
																		color: #5885ff;
																		text-decoration: underline;
																		font-size: 17px;
																		line-height: 17px;
																	"
																	target="_blank"
																	>https://www.apnasikshalaya.com/account/verify_email?user_key='.$token.'&amp;code='.$token.'</a
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
			mail($email, $subject, $body, $headers);
			header("Location: /teacher_email_verify?email=$email");
			exit();
		} else {			
			header("Location: /teacher/index");
			exit();
		}
	} else {
		header("Location: /index?from=signin&status=error");
		exit();
	}
}//teacher signin ending bracket

}//signin ending bracket
 elseif($from == "signup") {
	$name = mysqli_real_escape_string($con, htmlspecialchars($_POST['name'], ENT_QUOTES));
	$phone = mysqli_real_escape_string($con, htmlspecialchars($_POST['phone'], ENT_QUOTES));
	$email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email'], ENT_QUOTES));
	$pass = mysqli_real_escape_string($con, htmlspecialchars($_POST['pass'], ENT_QUOTES));
	$type = mysqli_real_escape_string($con, htmlspecialchars($_POST['type'], ENT_QUOTES));
	$dob = mysqli_real_escape_string($con, htmlspecialchars($_POST['dob'], ENT_QUOTES));
	if($type === "student") {
		$sql = "SELECT id FROM apnaStudents WHERE emailIs = ?;";
		$stmt = $con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows() != 0) {
			header("Location: /index.php?from=signup&status=emailerror");
			exit();
		} else {
			$token = rand(100000, 999999);
			$ip = getenv("REMOTE_ADDR");
			$sql2 = "INSERT INTO apnaStudents (nameIs, contactIs, dobIs, emailIs, passIs, verifyIs, ipIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt2 = $con->stmt_init();
			$stmt2->prepare($sql2);
			$stmt2->bind_param("ssssssss", $name, $phone, $dob, $email, $pass, $token, $ip, $show);
			$stmt2->execute();
			$_SESSION['user'] = $email;
			$_SESSION['pass'] = $pass;
			$_SESSION['Role'] = "student";
			$subject = "Verify your Email | Apnasikshalaya";
			$body = '
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
																	Dear '.$name.',</strong
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
																			>'.$token.'</abbr
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
																	href="https://www.apnasikshalaya.com/account/verify_email?user_key='.$token.'&amp;code='.$token.'"
																	style="
																		color: #5885ff;
																		text-decoration: underline;
																		font-size: 17px;
																		line-height: 17px;
																	"
																	target="_blank"
																	>https://www.apnasikshalaya.com/account/verify_email?user_key='.$token.'&amp;code='.$token.'</a
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
			mail($email, $subject, $body, $headers);
			header("Location: /email_verify?email=$email");
			exit();
		}
	} elseif($type === "mentor") {
		$sql = "SELECT id FROM apnaTeachers WHERE emailIs = ?;";
		$stmt = $con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows() != 0) {
			header("Location: /index.php?from=signup&status=emailerror");
			exit();
		} else {
			$token = rand(100000, 999999);
			$ip = getenv("REMOTE_ADDR");
			$sql2 = "INSERT INTO apnaTeachers (nameIs, contactIs, dobIs, emailIs, passIs, verifyIs, ipIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt2 = $con->stmt_init();
			$stmt2->prepare($sql2);
			$stmt2->bind_param("ssssssss", $name, $phone, $dob, $email, $pass, $token, $ip, $show);
			$stmt2->execute();
			$_SESSION['user'] = $email;
			$_SESSION['pass'] = $pass;
			$_SESSION['Role'] = "teacher";
			$subject = "Welcome to Apnasikshalaya";
			$body = '
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
																	Dear Mentor,</strong
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
																			>'.$token.'</abbr
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
																	href="https://www.apnasikshalaya.com/account/verify_email?user_key='.$token.'&amp;code='.$token.'"
																	style="
																		color: #5885ff;
																		text-decoration: underline;
																		font-size: 17px;
																		line-height: 17px;
																	"
																	target="_blank"
																	>https://www.apnasikshalaya.com/account/verify_email?user_key='.$token.'&amp;code='.$token.'</a
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
			mail($email, $subject, $body, $headers);
			header("Location: /teacher_email_verify?email=$email");
			exit();
		}
	} else {
		header("Location: /index?from=signup&status=notfound");
		exit();
	}
}
elseif($from == "teacher_profile"){
	if($action == "update"){
		$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
		$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
		$sql = "SELECT id, verifyIs FROM apnaTeachers WHERE emailIs = ? && passIs = ?;";
		$stmt = $con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("ss", $user, $pass);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows() == 1) {
		$stmt->bind_result($id, $verify);
		$stmt->fetch();
		if($verify == 1) {
		$teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
		$file_name = strtolower($_FILES['resume']['name']);
		$file_tmploc = $_FILES['resume']['tmp_name'];
		$id = $teacherid;

		$fileName = $id.$file_name;
        $location = "./resume/".$fileName;
		move_uploaded_file($file_tmploc,$location);


		if(isset($_POST['tuition']) ){
			$extra="show";
			$teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
			$grade = mysqli_real_escape_string($con, htmlspecialchars($_POST['grade'], ENT_QUOTES));
			$board = mysqli_real_escape_string($con, htmlspecialchars($_POST['board'], ENT_QUOTES));
			$tuisubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuisubject'], ENT_QUOTES));
			$secsubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['secsubject'], ENT_QUOTES));
			$tuispecialization = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuispecialization'], ENT_QUOTES));
			$tuihour = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuihour'], ENT_QUOTES));
			$sql = "INSERT  INTO teacherTuition (teacherId, gradeIs, boardIs, subjectIs, secondarysubIs, speciIs, hourIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt-> bind_param("ssssssss", $teacherid, $grade, $board, $tuisubject, $secsubject, $tuispecialization, $tuihour, $extra);
			if($stmt->execute()){
				$_SESSION['tuitionteacherdata'] = "Tuition upload successful";
				// header("Location: /teacher/index?status=profile_update");
			}else{
				// header("Location: /teacher_profile");
				$_SESSION['tuitionteacherdata'] = "TUITION HAS A PROBLEM";
			}
			

		}
		if(isset($_POST['proCourse']) ){
			$extra="show";
			$teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
			$procourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['procourse'], ENT_QUOTES));
			$prosubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['prosubject'], ENT_QUOTES));
			$prospecialization = mysqli_real_escape_string($con, htmlspecialchars($_POST['prospecialization'], ENT_QUOTES));
			$prohour = mysqli_real_escape_string($con, htmlspecialchars($_POST['prohour'], ENT_QUOTES));
			$sql = "INSERT  INTO apnaProfessional (teacherId, procourses, subjectIs, specializationIs, hoursIs, extra) VALUES (?, ?, ?, ?, ?, ?);";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt-> bind_param("ssssss", $teacherid, $procourse, $prosubject, $prospecialization, $prohour, $extra);
			if($stmt->execute()){
				$_SESSION['procourseteacherdata'] = "professional course upload successful";
				// header("Location: /teacher/index?status=profile_update");
			}else{
				// header("Location: /teacher_profile");
				$_SESSION['procourseteacherdata'] = "professional course HAS A PROBLEM";
			}
			
		}
		if(isset($_POST['cerCourse']) ){
			$extra="show";
			$teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
			$certicourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['certicourse'], ENT_QUOTES));
			$certisubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['certisubject'], ENT_QUOTES));
			$certispecialization = mysqli_real_escape_string($con, htmlspecialchars($_POST['certispecialization'], ENT_QUOTES));
			$certihour = mysqli_real_escape_string($con, htmlspecialchars($_POST['certihour'], ENT_QUOTES));
			$sql = "INSERT  INTO apnaCertification (teacherId, certiCourse, subjectIs, specializationIs, hoursIs, extra) VALUES (?, ?, ?, ?, ?, ?);";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt-> bind_param("ssssss", $teacherid, $certicourse, $certisubject, $certispecialization, $certihour, $extra);
			if($stmt->execute()){
				$_SESSION['certicourseteacherdata'] = "Certification course upload successful";
				// header("Location: /teacher/index?status=profile_update");
			}else{
				// header("Location: /teacher_profile");
				$_SESSION['certicourseteacherdata'] = "Certification course HAS A PROBLEM";
			}
		}


		$email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email'], ENT_QUOTES));
		$gender = mysqli_real_escape_string($con, htmlspecialchars($_POST['gender'], ENT_QUOTES));
		$contact = mysqli_real_escape_string($con, htmlspecialchars($_POST['contact'], ENT_QUOTES));
		$altContact = mysqli_real_escape_string($con, htmlspecialchars($_POST['altContact'], ENT_QUOTES));
		$dob = mysqli_real_escape_string($con, htmlspecialchars($_POST['dob'], ENT_QUOTES));
		$city = mysqli_real_escape_string($con, htmlspecialchars($_POST['city'], ENT_QUOTES));
		$address = mysqli_real_escape_string($con, htmlspecialchars($_POST['address'], ENT_QUOTES));
		$state = mysqli_real_escape_string($con, htmlspecialchars($_POST['state'], ENT_QUOTES));
		$pin = mysqli_real_escape_string($con, htmlspecialchars($_POST['pin'], ENT_QUOTES));
		$tuition = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuition'], ENT_QUOTES));
		$proCourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['proCourse'], ENT_QUOTES));
		$cerCourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['cerCourse'], ENT_QUOTES));
		$sql = "UPDATE apnaTeachers SET genderIs = ?, contactIs = ?,dobIs = ?, altContactIs = ?,  addressIs = ?, cityIs = ?, stateIs = ?, pinIs = ?, certificationCourseIs = ?,professionalCourseIs = ?, tuitionServiceIs = ?,   resumeIs = ? WHERE id = ?";
		$stmt = $con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("ssssssssssssi", $gender, $contact ,$dob ,$altContact,  $address, $city, $state, $pin, $cerCourse, $proCourse, $tuition, $fileName, $id);
		if($stmt->execute()){
			$tuitionstatus=$_SESSION['tuitionteacherdata'];
			$cerstatus=$_SESSION['certicourseteacherdata'];
			$prostatus=$_SESSION['procourseteacherdata'];
			header("Location: /teacher/index?status=profile_update&tuition=$tuitionstatus&cer=$cerstatus&pro=$prostatus");
		}else{
			header("Location: /teacher_profile");
		}
		} else {
			header("Location: /email_verify?email=$user");
			exit();
		}
		} else {
			header("Location: /index?from=signin&status=error");
			exit();
		}
		
	}

}elseif($from == "teacher_profilegoogleauth"){
	if($action == "updategoogleauth"){
		$teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
		$file_name = strtolower($_FILES['resume']['name']);
		$file_tmploc = $_FILES['resume']['tmp_name'];
		$id = $teacherid;

		$fileName = $id.$file_name;
        $location = "./resume/".$fileName;
		move_uploaded_file($file_tmploc,$location);


		if(isset($_POST['tuition']) && $_POST['tuition'] != null){
			$extra="show";
			$teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
			$grade = mysqli_real_escape_string($con, htmlspecialchars($_POST['grade'], ENT_QUOTES));
			$board = mysqli_real_escape_string($con, htmlspecialchars($_POST['board'], ENT_QUOTES));
			$tuisubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuisubject'], ENT_QUOTES));
			$secsubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['secsubject'], ENT_QUOTES));
			$tuispecialization = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuispecialization'], ENT_QUOTES));
			$tuihour = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuihour'], ENT_QUOTES));
			$sql = "INSERT  INTO teacherTuition (teacherId, gradeIs, boardIs, subjectIs, secondarysubIs, speciIs, hourIs, extra) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt-> bind_param("ssssssss", $teacherid, $grade, $board, $tuisubject, $secsubject, $tuispecialization, $tuihour, $extra);
			if($stmt->execute()){
				$_SESSION['tuitionteacherdata'] = "Tuition upload successful";
				// header("Location: /teacher/index?status=profile_update");
			}else{
				// header("Location: /teacher_profile");
				$_SESSION['tuitionteacherdata'] = "TUITION HAS A PROBLEM";
			}
			

		}
		if(isset($_POST['proCourse']) && $_POST['proCourse'] != null){
			$extra="show";
			$teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
			$procourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['procourse'], ENT_QUOTES));
			$prosubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['prosubject'], ENT_QUOTES));
			$prospecialization = mysqli_real_escape_string($con, htmlspecialchars($_POST['prospecialization'], ENT_QUOTES));
			$prohour = mysqli_real_escape_string($con, htmlspecialchars($_POST['prohour'], ENT_QUOTES));
			$sql = "INSERT  INTO apnaProfessional (teacherId, procourses, subjectIs, specializationIs, hoursIs, extra) VALUES (?, ?, ?, ?, ?, ?);";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt-> bind_param("ssssss", $teacherid, $procourse, $prosubject, $prospecialization, $prohour, $extra);
			if($stmt->execute()){
				$_SESSION['procourseteacherdata'] = "professional course upload successful";
				// header("Location: /teacher/index?status=profile_update");
			}else{
				// header("Location: /teacher_profile");
				$_SESSION['procourseteacherdata'] = "professional course HAS A PROBLEM";
			}
			
		}
		if(isset($_POST['cerCourse']) && $_POST['cerCourse'] != null){
			$extra="show";
			$teacherid = mysqli_real_escape_string($con, htmlspecialchars($_POST['teacher'], ENT_QUOTES));
			$certicourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['certicourse'], ENT_QUOTES));
			$certisubject = mysqli_real_escape_string($con, htmlspecialchars($_POST['certisubject'], ENT_QUOTES));
			$certispecialization = mysqli_real_escape_string($con, htmlspecialchars($_POST['certispecialization'], ENT_QUOTES));
			$certihour = mysqli_real_escape_string($con, htmlspecialchars($_POST['certihour'], ENT_QUOTES));
			$sql3 = "INSERT  INTO apnaCertification (teacherId, certiCourse, subjectIs, specializationIs, hoursIs, extra) VALUES (?, ?, ?, ?, ?, ?);";
			$stmt3 = $con->stmt_init();
			$stmt3->prepare($sql3);
			$stmt3-> bind_param("ssssss", $teacherid, $certicourse, $certisubject, $certispecialization, $certihour, $extra);
			if($stmt3->execute()){
				$_SESSION['certicourseteacherdata'] = "Certification course upload successful";
				// header("Location: /teacher/index?status=profile_update");
			}else{
				// header("Location: /teacher_profile");
				$_SESSION['certicourseteacherdata'] = "Certification course HAS A PROBLEM";
			}
		}

		$email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email'], ENT_QUOTES));
		$password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password'], ENT_QUOTES));
		$gender = mysqli_real_escape_string($con, htmlspecialchars($_POST['gender'], ENT_QUOTES));
		$contact = mysqli_real_escape_string($con, htmlspecialchars($_POST['contact'], ENT_QUOTES));
		$altContact = mysqli_real_escape_string($con, htmlspecialchars($_POST['altContact'], ENT_QUOTES));
		$dob = mysqli_real_escape_string($con, htmlspecialchars($_POST['dob'], ENT_QUOTES));
		$city = mysqli_real_escape_string($con, htmlspecialchars($_POST['city'], ENT_QUOTES));
		$address = mysqli_real_escape_string($con, htmlspecialchars($_POST['address'], ENT_QUOTES));
		$state = mysqli_real_escape_string($con, htmlspecialchars($_POST['state'], ENT_QUOTES));
		$pin = mysqli_real_escape_string($con, htmlspecialchars($_POST['pin'], ENT_QUOTES));
		$tuition = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuition'], ENT_QUOTES));
		$proCourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['proCourse'], ENT_QUOTES));
		$cerCourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['cerCourse'], ENT_QUOTES));
		$_SESSION['user'] = $email;
		$_SESSION['pass'] = $password;
		$_SESSION['Role'] = "teacher";
		$sql = "UPDATE apnaTeachers SET genderIs = ?, contactIs = ?,dobIs = ?, altContactIs = ?, passIs=?,  addressIs = ?, cityIs = ?, stateIs = ?, pinIs = ?, certificationCourseIs = ?,professionalCourseIs = ?, tuitionServiceIs = ?,   resumeIs = ? WHERE id = ?";
		$stmt = $con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("sssssssssssssi", $gender, $contact ,$dob ,$altContact, $password,  $address, $city, $state, $pin, $cerCourse, $proCourse, $tuition, $fileName, $id);
		if($stmt->execute()){
			$tuitionstatus=$_SESSION['tuitionteacherdata'];
			$cerstatus=$_SESSION['certicourseteacherdata'];
			$prostatus=$_SESSION['procourseteacherdata'];
			header("Location: /teacher/index?status=profile_update&tuition=$tuitionstatus&cer=$cerstatus&pro=$prostatus");
		}else{
			header("Location: /teacher_profile");
		}
	
	}
}
 elseif($from == "student") {
	if($action == "update") {
		$user = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['user'], ENT_QUOTES));
		$pass = mysqli_real_escape_string($con, htmlspecialchars($_SESSION['pass'], ENT_QUOTES));
		$sql = "SELECT id, verifyIs FROM apnaStudents WHERE emailIs = ? && passIs = ?;";
		$stmt = $con->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param("ss", $user, $pass);
		$stmt->execute();
		$stmt->store_result();
		if($stmt->num_rows() == 1) {
		$stmt->bind_result($id, $verify);
		$stmt->fetch();
		if($verify == 1) {
		$email = mysqli_real_escape_string($con, htmlspecialchars($_POST['email'], ENT_QUOTES));
		if(isset($_POST['password']) && $_POST['password'] != null) {
			$password = mysqli_real_escape_string($con, htmlspecialchars($_POST['password'], ENT_QUOTES));
		} else {
			$password = null;
		}
		$gender = mysqli_real_escape_string($con, htmlspecialchars($_POST['gender'], ENT_QUOTES));
		$contact = mysqli_real_escape_string($con, htmlspecialchars($_POST['contact'], ENT_QUOTES));
		$altContact = mysqli_real_escape_string($con, htmlspecialchars($_POST['altContact'], ENT_QUOTES));
		$dob = mysqli_real_escape_string($con, htmlspecialchars($_POST['dob'], ENT_QUOTES));
		$city = mysqli_real_escape_string($con, htmlspecialchars($_POST['city'], ENT_QUOTES));
		$address = mysqli_real_escape_string($con, htmlspecialchars($_POST['address'], ENT_QUOTES));
		$state = mysqli_real_escape_string($con, htmlspecialchars($_POST['state'], ENT_QUOTES));
		$pin = mysqli_real_escape_string($con, htmlspecialchars($_POST['pin'], ENT_QUOTES));
		$quality = mysqli_real_escape_string($con, htmlspecialchars($_POST['quality'], ENT_QUOTES));
		$institute = mysqli_real_escape_string($con, htmlspecialchars($_POST['institute'], ENT_QUOTES));
		$test = mysqli_real_escape_string($con, htmlspecialchars($_POST['test'], ENT_QUOTES));
		$tuition = mysqli_real_escape_string($con, htmlspecialchars($_POST['tuition'], ENT_QUOTES));
		$proCourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['proCourse'], ENT_QUOTES));
		$cerCourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['cerCourse'], ENT_QUOTES));
		$comCourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['comCourse'], ENT_QUOTES));
		$crashCourse = mysqli_real_escape_string($con, htmlspecialchars($_POST['crashCourse'], ENT_QUOTES));
		$studyMaterial = mysqli_real_escape_string($con, htmlspecialchars($_POST['studyMaterial'], ENT_QUOTES));
		if($password == null) {
			$sql = "UPDATE apnaStudents SET genderIs = ?, contactIs = ?, altContactIs = ?, dobIs = ?, addressIs = ?, cityIs = ?, stateIs = ?, pinIs = ?, qualityIs = ?, instituteIs = ?, testSeriesIs = ?, tuitionServiceIs = ?, professionalCourseIs = ?, certificationCourseIs = ?, competitiveCourseIs = ?, crashCourseIs = ?, studyMaterialIs = ? WHERE id = ?";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("sssssssssssssssssi", $gender, $contact, $altContact, $dob, $address, $city, $state, $pin, $quality, $institute, $test, $tuition, $proCourse, $cerCourse, $comCourse, $crashCourse, $studyMaterial, $id);
		} else {
			$sql = "UPDATE apnaStudents SET passIs = ?, genderIs = ?, contactIs = ?, altContactIs = ?, dobIs = ?, addressIs = ?, cityIs = ?, stateIs = ?, pinIs = ?, qualityIs = ?, instituteIs = ?, testSeriesIs = ?, tuitionServiceIs = ?, professionalCourseIs = ?, certificationCourseIs = ?, competitiveCourseIs = ?, crashCourseIs = ?, studyMaterialIs = ? WHERE id = ?";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("ssssssssssssssssssi", $password, $gender, $contact, $altContact, $dob, $address, $city, $state, $pin, $quality, $institute, $test, $tuition, $proCourse, $cerCourse, $comCourse, $crashCourse, $studyMaterial, $id);
		}
		$stmt->execute();
		$_SESSION['user'] = $email;
		$_SESSION['pass'] = $pass;
		$_SESSION['Role'] = "student";
		header("Location: /student/index?status=profile_update");
		exit();
		} else {
			header("Location: /email_verify?email=$user");
			exit();
		}
		} else {
			header("Location: /index?from=signin&status=error");
			exit();
		}
	}
} elseif($from == "course") {
	if($action == "interested") {
		$id = mysqli_real_escape_string($con, htmlspecialchars($_GET['id'], ENT_QUOTES));
		$email = mysqli_real_escape_string($con, htmlspecialchars($_GET['email'], ENT_QUOTES));
		if($id != null || $id != false || $email != null || $email != false) {
			$sql = "INSERT INTO apnaInterest (courseId, studentEmail) VALUES (?, ?);";
			$stmt = $con->stmt_init();
			$stmt->prepare($sql);
			$stmt->bind_param("is", $id, $email);
			$stmt->execute();
			header("Location: /course_preview?id=$id&action=interest&status=success");
			exit();
		} else {
			header("Location: /all_courses?from=course&action=interest&status=error");
			exit();
		}
	}
} elseif($_POST['testname']!=null){
	$studentid=$_POST['student'];
	$testname = mysqli_real_escape_string($con, htmlspecialchars($_POST['testname'], ENT_QUOTES));
	$appearingon = mysqli_real_escape_string($con, htmlspecialchars($_POST['appearingon'], ENT_QUOTES));
	$appearedbefore = mysqli_real_escape_string($con, htmlspecialchars($_POST['appearedbefore'], ENT_QUOTES));
	$extra = "testsOn";
	$sql = "INSERT INTO apnaTests (studentId,testName,appearingDate,appearedTimes,extra) VALUES (?,?,?,?,?)";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("issss",$studentid, $testname, $appearingon, $appearedbefore, $extra);
	$stmt->execute();
	header("Location: /student/index?status=profile_update");
	exit();
}
 elseif($_POST['className']!=null){
	$studentid=$_POST['student'];
	$className = mysqli_real_escape_string($con, htmlspecialchars($_POST['className'], ENT_QUOTES));
	$guardianName = mysqli_real_escape_string($con, htmlspecialchars($_POST['guardianName'], ENT_QUOTES));
	$boardName = mysqli_real_escape_string($con, htmlspecialchars($_POST['boardName'], ENT_QUOTES));
	$yearName = mysqli_real_escape_string($con, htmlspecialchars($_POST['yearName'], ENT_QUOTES));
	$specialization = mysqli_real_escape_string($con, htmlspecialchars($_POST['specialization'], ENT_QUOTES));
	$extra = "tuitionOn";
	$sql = "INSERT INTO apnaTuitions (studentId,classIs,guardianName,boardIs,collegeIs,spclIs,extra) VALUES (?,?,?,?,?,?,?)";
	$stmt = $con->stmt_init();
	$stmt->prepare($sql);
	$stmt->bind_param("issssss",$studentid, $className, $guardianName,$boardName,$yearName,$specialization,$extra);
	$stmt->execute();
	header("Location: /student/index?status=profile_update");
	exit();
}
