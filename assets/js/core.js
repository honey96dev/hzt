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
	var $danger = "#FF5B5C";
	var $warning = "#FDAC41";
	var $info = "#00CFDD";
	var $secondary = "#828D99";
	var $primary_light = '#E2ECFF';
  var $gray_light = '#828D99';
	var $light_primary = "#E2ECFF";

	// Bill Summary Chart
	// --------------------
	if ($("#order-summary-chart").length) {
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
				dashArray: [0, 5],
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
					name: "Paid",
					data: summary_paid,
					type: "area",
				},
				{
					name: "Unpaid",
					data: summary_unpaid,
					type: "line",
				},
			],
			xaxis: {
				offsetY: -50,
				categories: summary_axis,
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
			yaxis: {
				labels: {
					formatter: (value) => "$ " + value,
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
	}

	// Revenue Growth Chart
	// ---------------------
	if ($("#revenue-growth-chart").length) {
		var revenueChartOptions = {
			chart: {
				height: 100,
				type: "bar",
				stacked: true,
				toolbar: {
					show: false,
				},
			},
			grid: {
				show: false,
				padding: {
					left: 0,
					right: 0,
					top: -20,
					bottom: -15,
				},
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: "20%",
					endingShape: "rounded",
				},
			},
			legend: {
				show: false,
			},
			dataLabels: {
				enabled: false,
			},
			colors: [$info, $danger],
			series: [
				{
					name: "Paid",
					data: paid_bill,
				},
				{
					name: "Unpaid",
					data: unpaid_bill,
				},
			],
			xaxis: {
				categories: bill_axis,
				axisBorder: {
					show: false,
				},
				axisTicks: {
					show: false,
				},
				labels: {
					style: {
						colors: $secondary,
					},
					offsetY: -5,
				},
			},
			yaxis: {
				show: false,
				floating: true,
				labels: {
					formatter: (value) => value,
				},
			},
			tooltip: {
				x: {
					show: false,
				},
			},
		};

		var revenueChart = new ApexCharts(
			document.querySelector("#revenue-growth-chart"),
			revenueChartOptions
		);

		revenueChart.render();
	}

	// Growth Radial Chart
	// --------------------
	if ($("#goal-status-chart").length) {
		var growthChartOptions = {
			chart: {
				height: 200,
				type: "radialBar",
				sparkline: {
					show: true,
				},
			},
			grid: {
				show: false,
			},
			plotOptions: {
				radialBar: {
					size: 100,
					startAngle: -135,
					endAngle: 135,
					offsetY: 40,
					hollow: {
						size: "60%",
					},
					track: {
						strokeWidth: "90%",
						background: "#fff",
					},
					dataLabels: {
						value: {
							offsetY: -10,
							color: "#475f7b",
							fontSize: "26px",
						},
						name: {
							fontSize: "15px",
							color: "#596778",
							offsetY: 30,
						},
					},
				},
			},
			colors: ["#fff"],
			fill: {
				type: "gradient",
				gradient: {
					shade: "dark",
					type: "horizontal",
					shadeIntensity: 0.5,
					gradientToColors: [$primary],
					inverseColors: true,
					opacityFrom: 1,
					opacityTo: 1,
					stops: [0, 100],
				},
			},
			stroke: {
				dashArray: 3,
			},
			series: [goal_status_percent],
			labels: ["Status"],
		};

		var growthChart = new ApexCharts(
			document.querySelector("#goal-status-chart"),
			growthChartOptions
		);

		growthChart.render();
	}

	if ($("#analytics-bar-chart").length) {
		// Bar Chart
		// ---------
		var analyticsBarChartOptions = {
			chart: {
				height: 260,
        width: '100%',
				type: "bar",
				toolbar: {
					show: false,
				},
			},
			plotOptions: {
				bar: {
					horizontal: false,
					columnWidth: "30%",
					endingShape: "rounded",
				},
			},
			legend: {
				horizontalAlign: "right",
				offsetY: -10,
				markers: {
					radius: 50,
					height: 8,
					width: 8,
				},
			},
			dataLabels: {
				enabled: false,
			},
			colors: [$primary, $primary_light],
			fill: {
				type: "gradient",
				gradient: {
					shade: "light",
					type: "vertical",
					inverseColors: true,
					opacityFrom: 1,
					opacityTo: 1,
					stops: [0, 70, 100],
				},
			},
			series: [
				{
					name: "2019",
					data: [80, 95, 150, 210, 140, 230, 300, 280, 130],
				},
				{
					name: "2018",
					data: [50, 70, 130, 180, 90, 180, 270, 220, 110],
				},
			],
			xaxis: {
				categories: [
					"Jan",
					"Feb",
					"Mar",
					"Apr",
					"May",
					"Jun",
					"Jul",
					"Aug",
					"Sep",
				],
				axisBorder: {
					show: false,
				},
				axisTicks: {
					show: false,
				},
				labels: {
					style: {
						colors: $gray_light,
					},
				},
			},
			yaxis: {
				min: 0,
				max: 300,
				tickAmount: 3,
				labels: {
					style: {
						color: $gray_light,
					},
				},
			},
			legend: {
				show: false,
			},
			tooltip: {
				y: {
					formatter: function (val) {
						return "$ " + val + " thousands";
					},
				},
			},
		};

		var analyticsBarChart = new ApexCharts(
			document.querySelector("#analytics-bar-chart"),
			analyticsBarChartOptions
		);

		analyticsBarChart.render();
	}
});
