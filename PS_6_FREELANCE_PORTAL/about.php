<!DOCTYPE html>
<html>

<head>
	<title>About us Page</title>
	<style>
	    * {
			margin:0;
			padding:0;
			overflow-x: hidden;
			padding:20px;
		}

		html {
			scroll-behaviour: smooth;
		}

		:root {
			--navbar-height: 59px;
		}
		.logo {
			width: 20%;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.logo img {
			width: 33%;
			border: 2px solid white;
			border-radius: 50px;
		}

		.navbar {
			display: flex;
			align-items: center;
			justify-content: center;
			position: sticky;
			top: 0;
			cursor: pointer;
		}

		.nav-list {
			width: 70%;
			display: flex;
		}

		.nav-list li {

			list-style: none;
			padding: 2px 6px;
		}

		.nav-list li a {

			text-decoration: none;
			color: white;
		}

		.nav-list li a:hover {
			color: grey;
		}

		.rightNav {
			width: 50;
			text-align: right;
		}

		#search {
			padding: 5px;
			font-size: 17px;
			border: 2px solid grey;
			border-radius: 9px;
		}

		.background {
			background: grey;
			background-blend-mode: darken;
			background-size: cover;
		}

		.firstsection {
			height: 100vh;
		}

		.box-main {
			display: flex;
			justify-content: center;
			align-items: center;
			color: white;
			max-width: 50%;
			margin: auto;
			height: 80%;
		}

		.firstHalf {
			width: 75%;
			display: flex;
			flex-direction: column;
			justify-content: center
		}

		.firstHalf img {
			display: flex;
			border-radius: 9050px;
		}

		.text-big {
			font-family: 'Piazzolla', serif;
			font-weight: bold;
			font-size: 41px;
			text-align: center;
		}

		.text-small {
			font-family: 'Sansita Swashed', cursive;
			font-size: 18px;
			text-align: center;
		}

		#service {
			margin: 34px;
			display: flex;
		}

		#service .box {
			padding: 100px;
			margin: 3px 6px;
			border-radius: 28px;
		}

		#service .box img {
			margin-top: 10px;
			height: 150px;
			margin: auto;
			display: block;
			border-radius: 200px;
		}

		#service .box p {

			font-family: sans-serif;
			text-align: center;
		}

		#services {
			margin: 34px;
			display: flex;
		}

		#services .box {

			padding: 100px;
			margin: 3px 6px;
			border-radius: 28px;
		}

		#services .box img {
			margin-top: 10px;
			height: 150px;
			margin: auto;
			display: block;
			border-radius: 100px;
		}

		#services .box p {

			font-family: sans-serif;
			text-align: center;
		}

		.btn {
			padding: 8px 20px;
			margin: 7px 0;
			border: 2px solid white;
			border-radius: 8px;
			background: none;
			color: white;
			cursor: pointer;
		}

		.btn-sm {
			padding: 6px 10px;
			vertical-align: middle;
		}

		.center {
			text-align: center;
		}

		.text-footer {
			text-align: center;
			padding: 10px 0;
			font-family: 'Ubuntu', sans-serif;
			display: flex;
			justify-content: center;
		}
		@media screen and (max-width: 650px) {
.column {
	width: 100%;
	display: block;
}
}

	</style>
</head>
<body>

	<section class="background firstsection">
		<div class="box-main">
			<div class="firstHalf">
				<p class="text-big">About Us</p>
				
				<p class="text-small" style="background-color:azure;padding:20px;color:black">
					Welcome to our comprehensive job portals, where employers and job seekers connect seamlessly. Our platform provides a user-friendly interface, empowering employers to post job vacancies and search for qualified candidates effortlessly. Job seekers can explore a wide range of opportunities, create compelling profiles, and apply to their dream jobs with ease. We prioritize efficiency and accuracy, ensuring that the right talent finds the right opportunity. Join our job portals today and unlock a world of career possibilities.
				</p>
				<br>
				<p class="center"><a href="#Order"
				style="text-decoration:none;color:white;">
						Below are the people who
						works in our company</a>
				</p>
			</div>
		</div>
	</section>
	<section class="service">
		<h1 class="h-primary center" style="margin-top:30px;text-align:center;">
			Our Team
		</h1>
	<div id="services">
			<div class="box">
				<img src=
"gg.jpg"
					alt="picture goes here">
			
				<p class="center">
					<a href="#xyz" style="text-decoration:none;color:black;
		font-weight:bold;font-family: 'Langar', cursive;">
						Murali Bobby
					</a>
				</p>
				<p style="font-family: sans-serif">Web Developer</p>
			</div>
			<div class="box">
				<img src=
"gg1.jpg"
					alt="picture goes here">
				
				<p class="center">
					<a href="#abc" style="text-decoration:none;color:black;
		font-weight:bold;font-family: 'Langar', cursive;">
						Mukunthan
					</a>
				</p>
				
				<p style="font-family: sans-serif ">Web Developer pro max</p>

			</div>
			
		</div>
	
	</section>

	<footer class="background">
		<p class="text-footer">
			Copyright ©-All rights are reserved
		</p>

	</footer>
</body>

</html>
