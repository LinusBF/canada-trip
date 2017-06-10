
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

window.inview = require('./jquery.inview.js');


//File Selection
$(function() {

	// We can attach the `fileselect` event to all file inputs on the page
	$(document).on('change', ':file', function() {
		var input = $(this),
			numFiles = input.get(0).files ? input.get(0).files.length : 1,
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});

	// We can watch for our custom `fileselect` event like this
	$(document).ready( function() {
		$(':file').on('fileselect', function(event, numFiles, label) {

			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}

		});
	});

});


//Switching elements when scrolling
$('.in_view_trigger').bind('inview', monitor);
function monitor(event, visible)
{
	if(visible)
	{
		var loc_img_path = "/storage/" + $(event.target).children('.location_image').val();
		var loc_name = $(event.target).children('.location_name').val();

		var current_loc_title = $('.location_title');

		if(current_loc_title.text() != loc_name){
			current_loc_title.fadeOut(function () {
				$(this).text(loc_name).fadeIn();
			});
		}

		var current_loc_image = $('.fullscreen_trip_bg img');

		if(current_loc_image.attr('src') != loc_img_path){
			current_loc_image.fadeOut("slow",function(){
				current_loc_image.on("load", function () {
					current_loc_image.fadeIn();
				});
				current_loc_image.attr("src", loc_img_path);
			});
		}
	}
}

