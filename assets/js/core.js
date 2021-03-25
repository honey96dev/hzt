$(document).ready(function () {
	// Initialize after loading
	let customer_create_msg = "New customer information saved successfully.";
	let customer_update_msg = "This customer information saved successfully.";
	let bill_create_msg = "New bill information saved successfully.";
	let bill_update_msg = "This bill information saved successfully.";
	let error_msg = "Sorry. Something went wrong. Please try again later.";

	$("input[type=checkbox]").on("click", function () {
		$(this).val($(this).val() == "on" ? "off" : "on");
	});

	$("form input").not("[type=submit]").jqBootstrapValidation();

	$(".select2").select2({
		dropdownAutoWidth: true,
		width: "100%",
	});

	$(".pickadate").pickadate();

	/**
	 * Customer Management Page
	 */
	$(".customer-table").DataTable();
	$(".delete-cusomer-btn").on("click", function (e) {
		if (!confirm("Do you really want to remove this customer?")) {
			e.preventDefault();
		}
	});

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
					toastr.success(customer_create_msg, "Success!", {
						progressBar: true,
					});
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
					toastr.success(customer_update_msg, "Success!", {
						progressBar: true,
					});
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
	 * Bill Management Page
	 */
	$(".bill-table").DataTable();
	$(".delete-bill-btn").on("click", function (e) {
		if (!confirm("Do you really want to remove this bill?")) {
			e.preventDefault();
		}
	});

	/**
	 * Bill Create Page
	 */

	$("form#bill-create-form").on("submit", function (e) {
		e.preventDefault();
		let form = $(this);

		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			dataType: "json",
			success: function (res) {
				if (res.result == "success") {
					toastr.success(bill_create_msg, "Success!", { progressBar: true });
					// $("#bill-create-form input").not("[type=checkbox]").val("");
					// $("[type=checkbox]").val("off");
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
	 * Bill Update Page
	 */

	$("form#bill-update-form").on("submit", function (e) {
		e.preventDefault();
		let form = $(this);

		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			dataType: "json",
			success: function (res) {
				if (res.result == "success") {
					toastr.success(bill_update_msg, "Success!", { progressBar: true });
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
	 * Admin Dashboard Page
	 */
	var $primary = "#00CFDD";
  var $danger = '#FF5B5C';
  var $warning = '#FDAC41';
  var $info = '#00CFDD';
  var $secondary = '#828D99';
  var $secondary_light = '#e7edf3';
  var $light_primary = "#E2ECFF";

	// Order Summary Chart
	// --------------------
	var orderSummaryChartOptions = {
		chart: {
			height: 270,
			type: "line",
			stacked: false,
			toolbar: {
				show: false,
			},
			sparkline: {
				enabled: true,
			},
		},
		colors: [$primary, $primary],
		dataLabels: {
			enabled: false,
		},
		stroke: {
			curve: "smooth",
			width: 2.5,
			dashArray: [0, 8],
		},
		fill: {
			type: "gradient",
			gradient: {
				inverseColors: false,
				shade: "light",
				type: "vertical",
				gradientToColors: [$light_primary, $primary],
				opacityFrom: 0.7,
				opacityTo: 0.55,
				stops: [0, 80, 100],
			},
		},
		series: [
			{
				name: "Weeks",
				data: [165, 175, 162, 173, 160, 195, 160, 170, 160, 190, 180],
				type: "area",
			},
			{
				name: "Months",
				data: [168, 168, 155, 178, 155, 170, 190, 160, 150, 170, 140],
				type: "line",
			},
		],

		xaxis: {
			offsetY: -50,
			categories: ["", 1, 2, 3, 4, 5, 6, 7, 8, 9, ""],
			axisBorder: {
				show: false,
			},
			axisTicks: {
				show: false,
			},
			labels: {
				show: true,
				style: {
					colors: $secondary,
				},
			},
		},
		tooltip: {
			x: { show: false },
		},
	};

	var orderSummaryChart = new ApexCharts(
		document.querySelector("#order-summary-chart"),
		orderSummaryChartOptions
	);

	orderSummaryChart.render();

  // Revenue Growth Chart
  // ---------------------
  var revenueChartOptions = {
    chart: {
      height: 100,
      type: 'bar',
      stacked: true,
      toolbar: {
        show: false
      }
    },
    grid: {
      show: false,
      padding: {
        left: 0,
        right: 0,
        top: -20,
        bottom: -15
      }
    },
    plotOptions: {
      bar: {
        horizontal: false,
        columnWidth: '20%',
        endingShape: 'rounded'
      },
    },
    legend: {
      show: false
    },
    dataLabels: {
      enabled: false
    },
    colors: [$info, $secondary_light],
    series: [{
      name: '2019',
      data: [50, 70, 100, 120, 140, 100, 70, 80, 90, 110, 50, 70, 35, 110, 100, 105, 125, 80]
    }, {
      name: '2018',
      data: [70, 50, 20, 30, 20, 90, 90, 60, 50, 0, 50, 60, 140, 50, 20, 20, 10, 0]
    }],
    xaxis: {
      categories: ['0', '', '', '', '', "10", '', '', '', '', '', '15', '', '', '', '', '', '20'],
      axisBorder: {
        show: false
      },
      axisTicks: {
        show: false
      },
      labels: {
        style: {
          colors: $secondary
        },
        offsetY: -5
      }
    },
    yaxis: {
      show: false,
      floating: true,
    },
    tooltip: {
      x: {
        show: false,
      },
    }
  }

  var revenueChart = new ApexCharts(
    document.querySelector("#revenue-growth-chart"),
    revenueChartOptions
  );

  revenueChart.render();
});
