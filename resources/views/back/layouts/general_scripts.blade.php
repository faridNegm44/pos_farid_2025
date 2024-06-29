{{-- 
											Description:
								this is file contains all general scripts	
--}}

<script>

	// check all input checkbox
	$('#checkAll').click(function () {    
		$('input:checkbox').prop('checked', this.checked);    
	});



	// Focus Search input when click ctrl+/
	$(document).bind('keydown', function(event) {
		if( event.which === 191 && event.ctrlKey ) {
			$(".app-search input").focus();
		}
	});



	// Style To Search input When Focus In And Out
	$(document).ready(function(){
		$(".app-search input").focusin(function(){
			$(this).css({
				background: "#fddc92",
				color: "black",
				fontWeight: "bold",
				transition: "all 0.5s ease-in-out",
			});
		});
		$(".app-search input").focusout(function(){
			$(this).css({
				background: "#f3f3f9",
			});
		});
	});


	// start change modal-header
	let addButton = document.querySelector('.breadcrumb-header .right-content .add');
	// add
	addButton.addEventListener('click', function(){
		document.querySelector('.modal .modal-header .modal-title').innerText = 'إضافة';
		document.querySelector('.modal .modal-footer #save').setAttribute('style', 'display: inline;');
		document.querySelector('.modal .modal-footer #update').setAttribute('style', 'display: none;');
		document.querySelector('.dataInput').value = "";
	});
	// edit
	$("#example1").on("click", ".edit", function(event) {
		document.querySelector('.modal .modal-header .modal-title').innerText = 'تعديل';
		document.querySelector('.modal .modal-footer #save').setAttribute('style', 'display: none;');
		document.querySelector('.modal .modal-footer #update').setAttribute('style', 'display: inline;');
	});
	// end change modal-header



	// select all data in to input type number when focus 
	const inputField = document.querySelector('.numInput');
	inputField.addEventListener('focus', () => {
		inputField.select();
	});


	
	
	
	// change tr background when mouse hover
	// document.querySelectorAll('table tbody tr').addEventListener("mouseover", function() {
	//     this.style.background = "red";
	// });



	$('.dataTables_filter').next().remove();



		
	// file uplodad 
	var firstUpload = new FileUploadWithPreview('file_upload');



	// nice scroll bar
	// $(function() {  
	// 	$("body").niceScroll({
	// 		zindex: 20000,
	// 		scrollspeed: 100,
	// 	});
	// });
</script>
