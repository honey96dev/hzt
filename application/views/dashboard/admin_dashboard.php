<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section id="dashboard-ecommerce">
		<div class="row">
			<div class="col-xl-12 col-12 dashboard-users">
				<div class="row  ">
					<!-- Statistics Cards Starts -->
					<div class="col-md-6 col-12">
						<div class="row">
							<div class="col-md-6 col-12 dashboard-users-primary">
								<div class="card text-center">
									<div class="card-content">
										<div class="card-body py-1">
											<div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
												<i class="bx bx-user font-medium-5"></i>
											</div>
											<div class="text-muted line-ellipsis" data-i18n="Customers">Customers</div>
											<h3 class="mb-0"><?= $total_customers?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-12 dashboard-users-primary">
								<div class="card text-center">
									<div class="card-content">
										<div class="card-body py-1">
											<div class="badge-circle badge-circle-lg badge-circle-light-info mx-auto mb-50">
												<i class="bx bx-briefcase-alt font-medium-5"></i>
											</div>
											<div class="text-muted line-ellipsis" data-i18n="Total Bills">Total Bills</div>
											<h3 class="mb-0"><?= $total_bills?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-12 dashboard-users-primary">
								<div class="card text-center">
									<div class="card-content">
										<div class="card-body py-1">
											<div class="badge-circle badge-circle-lg badge-circle-light-warning mx-auto mb-50">
												<i class="bx bx-dollar font-medium-5"></i>
											</div>
											<div class="text-muted line-ellipsis" data-i18n="Paid Amount">Paid Amount</div>
											<h3 class="mb-0">$<?= show_number($total_paid_amount)?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-12 dashboard-users-primary">
								<div class="card text-center">
									<div class="card-content">
										<div class="card-body py-1">
											<div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
												<i class="bx bx-briefcase-alt font-medium-5"></i>
											</div>
											<div class="text-muted line-ellipsis" data-i18n="Unpaid Amount">Unpaid Amount</div>
											<h3 class="mb-0">$<?= show_number($total_unpaid_amount)?></h3>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-12">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header d-flex justify-content-between align-items-center">
										<h4 class="card-title">Products Summary</h4>
									</div>
									<div class="card-content">
										<div class="card-body pb-1">
											<div id="products-bar-chart"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Revenue Growth Chart Starts -->
				</div>
			</div>
		</div>
		<div class="row">
			<!-- Earning Swiper Starts -->
			<div class="col-xl-4 col-md-12 col-12">
				<div class="card">
					<div class="card-header border-bottom d-flex justify-content-between align-items-center">
						<h5 class="card-title"><i class="bx bx-dollar font-medium-5 align-middle"></i> <span class="align-middle" data-i18n="Goal Status">Goal Status</span></h5>
					</div>
					<div class="main-wrapper-content">
						<div class="wrapper-content">
							<div class="widget-earnings-scroll table-responsive dashboard-earning-status">
								<table class="table table-borderless widget-earnings-width mb-0">
									<tbody>
										<?php foreach($customer_list as $customer): ?>
										<?php
										$percent = $customer['goal_status'] / $customer['goal'] * 100.0;
										$percent = $percent > 100 ? 100 : $percent;
										$status_class = $percent >= 75 ? 'success' : ($percent >= 50 ? 'info' : ($percent >= 25 ? 'warning' : 'danger'));
										?>
										<tr>
											<td class="pr-75">
												<div class="media align-items-center">
													<div class="media-body">
														<?php if($percent == 100): ?>
															<span class="badge badge-light-success badge-pill badge-round float-right" title="Goal reached!">
																<i class="bx bx-radio-circle-marked font-medium-1"></i>
															</span>
														<?php endif;?>
														<h6 class="media-heading mb-0"><?= $customer['first_name'] . ' ' . $customer['surname'] ?></h6>
													</div>
												</div>
											</td>
											<td class="px-0 w-25">
												<div class="progress progress-bar-<?= $status_class?> progress-sm mb-0">
													<div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="80" aria-valuemax="100" style="width: <?= $percent?>%;"></div>
												</div>
											</td>
											<td class="text-center"><span class="badge badge-light-<?= $status_class?>"><?= '$' . $customer['goal'] . ' / $' . $customer['goal_status'] ?></span>
											</td>
										</tr>
										<?php endforeach;?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-8 col-12 dashboard-order-summary">
				<div class="card">
					<div class="row">
						<!-- Order Summary Starts -->
						<div class="col-md-8 col-12 order-summary border-right pr-md-0">
							<div class="card mb-0">
								<div class="card-header d-flex justify-content-between align-items-center">
									<h4 class="card-title" data-i18n="Billing Summary">Billing Summary</h4>
								</div>
								<div class="card-content">
									<div class="form-group position-relative has-icon-left admin-bill-summary-daterange">
										<input type="text" class="form-control daterange" placeholder="Select Date" id="admin-summary-daterange">
										<div class="form-control-position">
											<i class='bx bx-calendar-check'></i>
										</div>
									</div>
									<div class="card-body p-0">
										<div id="order-summary-chart"></div>
									</div>
								</div>
							</div>
						</div>
						<!-- Sales History Starts -->
						<div class="col-md-4 col-12 pl-md-0">
							<div class="card mb-0">
								<div class="card-header pb-50">
									<h4 class="card-title" data-i18n="Bills">Bills</h4>
								</div>
								<div class="card-content">
									<div class="card-body py-1">
										<div class="d-flex justify-content-between align-items-center mb-2">
											<div class="sales-item-name">
												<p class="mb-0" data-i18n="Total Bills">Total Bills</p>
											</div>
											<div class="sales-item-amount">
												<h6 class="mb-0 text-info"> <?= $total_bills?></h6>
											</div>
										</div>
										<div class="d-flex justify-content-between align-items-center mb-2">
											<div class="sales-item-name">
												<p class="mb-0" data-i18n="Paid Bills">Paid Bills</p>
											</div>
											<div class="sales-item-amount">
												<h6 class="mb-0 text-success"> <?= $paid_bills?></h6>
											</div>
										</div>
										<div class="d-flex justify-content-between align-items-center">
											<div class="sales-item-name">
												<p class="mb-0" data-i18n="Unpaid Bills">Unpaid Bills</p>
											</div>
											<div class="sales-item-amount">
												<h6 class="mb-0 text-danger"> <?= $unpaid_bills?></h6>
											</div>
										</div>
									</div>
									<div class="card-footer border-top pb-0">
										<h5 data-i18n="Total Billing Amount">Total Billing Amount</h5>
										<span class="text-primary text-bold-500">$<?= show_number($total_amount)?></span>
										<div id="revenue-growth-chart"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>

<script>
	let summary_axis = [<?= implode(',', $billing_summary_axis) ?>];
	let summary_paid = [<?= implode(',', $billing_summary_paid) ?>];
	let summary_unpaid = [<?= implode(',', $billing_summary_unpaid) ?>];
	let bill_axis = [<?= implode(',', $bill_axis)?>];
	let paid_bill = [<?= implode(',', $paid_bill)?>];
	let unpaid_bill = [<?= implode(',', $unpaid_bill)?>];
	let products_axis = [<?= implode(',', $products_axis)?>];
	let products_paid = [<?= implode(',', $products_paid)?>];
	let products_unpaid = [<?= implode(',', $products_unpaid)?>];
	let products_confirmed = [<?= implode(',', $products_confirmed)?>];
	let get_summary_chart_data = "<?= $get_summary_chart_data?>";
</script>