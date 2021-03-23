$(document).ready(function () {
	// Initialize after loading
	let customer_create_msg = "New customer information saved successfully.";
  let customer_update_msg = "This customer information saved successfully.";
	let error_msg = "Sorry. Something went wrong. Please try again later.";

	$("input[type=checkbox]").on("click", function () {
		$(this).val($(this).val() == "on" ? "off" : "on");
	});
	$("form input").not("[type=submit]").jqBootstrapValidation();

	/**
	 * Customer Management Page
	 */
	$(".customer-table").DataTable();
  $(".delete-cusomer-btn").on("click", function(e) {
    if (!confirm("Do you really want to remove this customer?")) {
      e.preventDefault();
    }
  })

	/**
	 * Customer Create Page
	 */

	$("form#customer-create-form").on("submit", function (e) {
		e.preventDefault();
		let form = $(this);

		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			dataType: "json",
			success: function (res) {
				if (res.result == "success") {
					toastr.success(customer_create_msg, "Success!", { progressBar: true });
					$("#customer-create-form input").not("[type=checkbox]").val("");
					$("[type=checkbox]").val("off");
				} else {
					toastr.warning(error_msg, "Failed...", { progressBar: true });
				}
			},
			error: function (err) {
				toastr.warning(error_msg, "Failed...", { progressBar: true });
			},
		});
	});

	/**
	 * Customer Update Page
	 */
  $("form#customer-update-form").on("submit", function (e) {
    e.preventDefault();
    let form = $(this);
    
    $.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			dataType: "json",
			success: function (res) {
				if (res.result == "success") {
					toastr.success(customer_update_msg, "Success!", { progressBar: true });
				} else {
					toastr.warning(error_msg, "Failed...", { progressBar: true });
				}
			},
			error: function (err) {
				toastr.warning(error_msg, "Failed...", { progressBar: true });
			},
		});
  });
});
