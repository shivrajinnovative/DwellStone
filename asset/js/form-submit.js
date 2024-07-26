$(document).ready(function () {
	// alert("common.js Included Successfully");
	// $(".select2").select2();

	/* Common form function to submit a form */
	$("body").on("submit", ".common_form", function (e) {

		// alert("common_form Form Submited Successfully");
		// return false;
		that = $(this);
		showFormSubmitLoader(that);
		e.preventDefault();

		input_error_classes = $(this).find('input[name="input_error_classes"]').val();
		error_class = $(this).find('input[name="error_class"]').val();
		success_class = $(this).find('input[name="success_class"]').val();
		var input_error = input_error_classes.split(',');
		var i;
		for (i = 0; i < input_error.length; ++i) {
			$("." + input_error[i]).text('');
		}
		$("." + error_class).text('');
		$("." + success_class).text('');

		enctype = $(this).attr('enctype');
		// alert(enctype);
		// return false;
		// alert($(this).attr('id'));
		// return false;
		if (enctype == "multipart/form-data") {
			/*
				// old code to get form_data
				var form_obj = document.getElementById($(this).attr('id'));
				alert(form_obj);
				var formId = $(this).attr('id');
				var form_data = new FormData(form_obj);
			*/

			form_data = new FormData(this);
			contType = false;
			procData = false;
		}
		else {
			form_data = $(this).serialize();
			contType = 'application/x-www-form-urlencoded; charset=UTF-8';
			procData = true;

		}
		
		$.ajax({
			url: $(this).attr('action') || window.location.pathname,
			//headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
			type: $(this).attr('method'),
			data: form_data,
			contentType: contType,
			processData: procData,
			dataType: 'json',
			success: function (data) {
				// console.log(data.errors);
				hideFormSubmitLoader();
				if (data['flag'] == 3) {
					var input_error = input_error_classes.split(',');
					var i;
					for (i = 0; i < input_error.length; ++i) {
						that.find("." + input_error[i]).html(data[input_error[i]]);
					}
					that.find("." + error_class).html(data['emsg']);
				}
				if (data['flag'] == 2) {
					// that.find("."+error_class).html(data['emsg']);
					if(data['redirect']){
						Swal.fire({
							icon: 'error',
							title: 'Error!',
							text: data['emsg']
						}).then((result) => {
							window.setTimeout(function () {
								if (data['redirect'] == 1) {
									location.reload();
								} else {
									window.location.replace(data['redirect']);
								}
							}, 500);
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error!',
							text: data['emsg']
						});
					}
				}
				if (data['flag'] == 1) {
					if (data['redirect']) {

						Swal.fire({
							icon: 'success',
							title: 'Success!',
							text: data['smsg'],
						}).then((result) => {
							window.setTimeout(function () {
								if (data['redirect'] == 1) {
								    $('.common_form').each(function () {
            							this.reset();
            						});
									location.reload();
								}
								else {
									window.location.replace(data['redirect']);
								}

							}, 500);
						});
					}
					else if (data['dataTableRefresh'] == 1) {
						Swal.fire({
							icon: 'success',
							title: 'Success!',
							text: data['smsg'],
						}).then((result) => {
							$("#addNewVehicleForm")[0].reset();
							$("#addNewVehicle").show();
							$("#editVehicle").hide();
							window.setTimeout(function () {
								// if (data['modalToClose'] != '') {
								// 	hideModal(data['modalToClose']);
								// }
								// $('#vehicleDataListing').DataTable().clear().destroy();
								$("#"+data['tableToRefresh']+"").DataTable().ajax.reload(null, false);
								// dataTable();
						
								$('.common_form').each(function () {
									this.reset();
								});
		
							}, 100);
						});
					}
					else {
						$('.common_form').each(function () {
							this.reset();
						});

						Swal.fire({
							icon: 'success',
							title: 'Success!',
							text: data['smsg']
						});
						// that.find("."+success_class).html(data['smsg']);

					}
				}
			},
			error: function (jXHR, textStatus, errorThrown) {
				hideFormSubmitLoader();
				Swal.fire({
					icon: "error",
					title: "Error! ",
					text: errorThrown
				});
				// that.find("."+error_class).html(errorThrown);
			}
		});
	});

});
