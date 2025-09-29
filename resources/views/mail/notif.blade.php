<html>
<head>
	<title>Magnitude</title>
</head>

<body style='font-family: arial '>
	<table style='border:1px solid #e2e2e2; padding: 10px; border-radius: 6px;' >
		<tr >
			<td>
			
				
				<table style='padding: 6px; padding-top: 10px;'  width='400px'>
					<tr>
						<td>
							<table width='400px' style='background: black;'>
								<tr >
									<td width='40%' style='padding: 10px 6px; text-align: center;'>
							          	<img src='https://magnitudeconstruction.com/wp-content/uploads/2020/04/logo.png' width='130px'>
									</td>
								</tr>
							</table>
						</td>
					</tr>

					<tr>
						<td>
							<table width='400px' >
								<tr >
									<td width='40%' style='padding: 0px 6px; font-weight: normal; font-size: 13px;'>
							          	<p style='text-align: justify !important; margin-top: 30px;'>
							          		<br>
							          		<!-- New Account -->
								          	@if($notification=='New Account')
									          	Hello,
									          	<br>
									          	New account awaiting confirmation, you can log into the administration to activate the account
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Account Confirmed-->
								          	@if($notification=='Account Confirmed')
									          	Hello,
									          	<br>
									          	We inform you that your account is activated, you can connect to your account using your email and your password.
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- New Leave Request-->
								          	@if($notification=='New Leave Request')
									          	Hello,
									          	<br>
									          	You have a new leave request awaiting confirmation
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Leave Confirmed-->
								          	@if($notification=='Leave Confirmed')
									          	Hello,
									          	<br>
									          	We inform you that a request has been accepted by your Manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Leave Canceled-->
								          	@if($notification=='Leave Canceled')
									          	Hello,
									          	<br>
									          	We inform you that a request has been refused by your Manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- New Overtime Request-->
								          	@if($notification=='New Overtime Request')
									          	Hello,
									          	<br>
									          	You have a new leave request awaiting confirmation
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Overtime Confirmed-->
								          	@if($notification=='Overtime Confirmed')
									          	Hello,
									          	<br>
									          	We inform you that a request has been accepted by your Manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Overtime Canceled-->
								          	@if($notification=='Overtime Canceled')
									          	Hello,
									          	<br>
									          	We inform you that a request has been refused by your Manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Overtime Canceled-->
								          	@if($notification=='Salary Processed')
									          	Hello,
									          	<br>
									          	We inform you that your salary has been processed
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

											<!-- New Travel Business Request-->
											@if($notification=='New Travel Business Request Request')
												Hello,
												<br>
												You have a new travel business request awaiting confirmation
												<br>
												<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
												<br><br>
												Thank You
												<br>
								          	@endif

											<!-- Travel Business Canceled-->
											@if($notification=='Travel Business Canceled')
									          	Hello,
									          	<br>
									          	We inform you that a request has been refused by your Manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Travel Business Confirmed-->
								          	@if($notification=='Travel Business Confirmed')
									          	Hello,
									          	<br>
									          	We inform you that a request has been accepted by your Manager, you can check in your dashboard. 
												<!-- <br>
												After your travel business is finished please upload your invoices and the excel expenses to the HR platform, thank you. -->
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

											<!-- New Request Recruitment-->
											@if($notification=='Recruitment Request New Staff')
												Hello,
												<br>
												You have a new request for recruitment request new staff awaiting confirmation
												<br>
												<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
												<br><br>
												Thank You
												<br>
								          	@endif

												<!-- Request Recruitment Canceled-->
											@if($notification=='Recruitment Request New Staff Canceled')
									          	Hello,
									          	<br>
									          	We inform you that a request has been refused by HR Manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Request Recruitment Confirmed-->
								          	@if($notification=='Recruitment Request New Staff Confirmed')
									          	Hello,
									          	<br>
									          	We inform you that a request has been accepted by  HR Manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

											<!-- New Request Resignation-->
											@if($notification=='New Resignation Request')
												Hello,
												<br>
												You have a new resignation request awaiting confirmation
												<br>
												<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
												<br><br>
												Thank You
												<br>
								          	@endif

												<!-- Request Resignation Canceled-->
											@if($notification=='Resignation Request Canceled')
									          	Hello,
									          	<br>
									          	We inform you that a request has been refused by your manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

								          	<!-- Request Resignation Confirmed-->
								          	@if($notification=='Resignation Request Confirmed')
									          	Hello,
									          	<br>
									          	We inform you that a request has been accepted by your manager, you can check in your dashboard
									          	<br>
									          	<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>You can click here to go to the authentication page</u></a>
									          	<br><br>
									          	Thank You
									          	<br>
								          	@endif

											<br>
											<a href='https://hr.magnitudeconstruction.com' target='_' style='text-decoration: none; font-weight: bold; '><u>Magnitude</u></a>
							          	</p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<table>
					<tr>
						<td>
							<table width='400px' >
								<tr>
									<td width='40%' style='padding: 15px 6px 15px 12px ; font-weight: normal'>
										<i style='font-size: 10px;'>Ce courriel vous est envoyé automatiquement, merci de ne pas utiliser la fonction 'répondre à l'expéditeur'.</i>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>
