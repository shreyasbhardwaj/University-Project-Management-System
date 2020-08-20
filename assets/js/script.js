$(document).ready(function () {

	$(".carousel").carousel();

	$('.carousel.carousel-slider').carousel({
		fullWidth: true,
		indicators: true
	});

	$(".datepicker").datepicker();

	$('select').formSelect();


	$(".dropdown-trigger").dropdown();

	$('.modal').modal();


})