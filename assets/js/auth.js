$(document).ready(function() {
  /**
   * Initialize
   */
  let login_failed_msg = 'Sorry. something went wrong in connection. Please try again.';
  $("form input").not("[type=submit]").jqBootstrapValidation();

  /**
	 * Login Page
	 */

	$("form#auth-login-form").on("submit", function (e) {
		e.preventDefault();
		let form = $(this);

		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			dataType: "json",
			success: function (res) {
				if (res.result == "success") {
					window.location.href = base_url;
				} else {
					toastr.warning(res.msg, "Failed...", { progressBar: true });
          $("#auth-login-form input").val("");
				}
			},
			error: function (err) {
				toastr.warning(login_failed_msg, "Failed...", { progressBar: true });
        $("#auth-login-form input").val("");
			},
		});
	});

  /**
	 * Login Page
	 */

	$("form#auth-signup-form").on("submit", function (e) {
		e.preventDefault();
		let form = $(this);

		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			dataType: "json",
			success: function (res) {
				if (res.result == "success") {
          toastr.success("We are reviewing your request soon. Thanks for your registration.", "Success!!!", { progressBar: true })
				} else {
					toastr.warning(res.msg, "Failed...", { progressBar: true });
          $("#auth-signup-form input").val("");
				}
			},
			error: function (err) {
				toastr.warning(login_failed_msg, "Failed...", { progressBar: true });
        $("#auth-signup-form input").val("");
			},
		});
	});
});