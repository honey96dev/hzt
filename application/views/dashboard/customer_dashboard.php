<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
    <section id="ecommerce-dashboard">
        <div class="row">
			<div class="col-xl-12 col-12 dashboard-users">
				<div class="row  ">
					<!-- Statistics Cards Starts -->
					<div class="col-md-6 col-12">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-12 dashboard-users-primary">
								<div class="card text-center">
									<div class="card-content">
										<div class="card-body py-1">
											<div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
												<i class="bx bx-dollar font-medium-5"></i>
											</div>
											<div class="text-muted line-ellipsis" data-i18n="My Goal">My Goal</div>
											<h3 class="mb-0">$<?= show_number($my_goal)?></h3>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-12 dashboard-users-primary">
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
							<div class="col-md-6 col-sm-6 col-12 dashboard-users-primary">
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
							<div class="col-md-6 col-sm-6 col-12 dashboard-users-primary">
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
								<div class="card product-summary">
									<div class="card-header d-flex justify-content-between align-items-center">
										<h4 class="card-title">Resumen de productos</h4>
									</div>
									<div class="card-content">
										<div class="card-body pb-1">
											<table class="table table-borderless widget-earnings-width mb-0">
												<tbody>
													<?php foreach($products as $product): ?>
													<tr>
														<td>
															<div class="media align-items-center">
																<div class="media-body">
																	<h6 class="media-heading mb-0"><?= $product['product_name'] ?></h6>
																</div>
															</div>
														</td>
														<td class="">
															<?= $product['billed_quantity']['paid'] + $product['billed_quantity']['unpaid'] + $product['billed_quantity']['confirmed']?> kg
														</td>
														<td class="px-0 w-25">
															$ <?= $product['billed_amount']['paid'] + $product['billed_amount']['unpaid'] + $product['billed_amount']['confirmed']?>
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
					</div>
					<!-- Revenue Growth Chart Starts -->
				</div>
			</div>
		</div>
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-12 growth-card">
                <div class="card">
                    <div class="card-body text-center goal-status-card">
                        <div id="goal-status-chart"></div>
                        <h6 class="mb-0"> <?= $goal_status_percent?>% Estado de meta <?= show_date(date('Y-m-d'))?></h6>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
                <div class="card customer-timeline">
                    <div class="card-header">
                        <h4 class="card-title" data-i18n="Bills Timeline">
                            Bills Timeline
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <ul class="widget-timeline mb-0">
                                <?php foreach($bill_list as $bill):?>
                                    <li class="timeline-items timeline-icon-primary active">
                                        <div class="timeline-time"><?= date('F, j', strtotime($bill['bill_date']))?></div>
                                        <h6 class="timeline-title"><?= $bill['product_name']?>, <span class="text-info">$<?= $bill['total_amount']?></span></h6>
                                        <?php if ($bill['status'] == 1): ?>
                                        <p class="timeline-text">
                                            <span class="badge badge-light-success" data-i18n="Paid">
												Paid
											</span>
                                        </p>
										<?php elseif ($bill['status'] == 2): ?>
										<p class="timeline-text">
											<span class="badge badge-light-warning" data-i18n="Confirmed">
												Confirmed
											</span>
										</p>
                                        <?php else: ?>
                                        <p class="timeline-text">
                                            <span class="badge badge-light-danger" data-i18n="Unpaid">
												Unpaid
											</span>
                                        </p>
                                        <?php endif;?>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12 col-12 growth-card">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title" data-i18n="Billing History">Billing History</h4>
                    </div>
                    <div class="card-content">
						<div class="form-group position-relative has-icon-left admin-bill-summary-daterange">
							<input type="text" class="form-control daterange" placeholder="Select Date" id="customer-bill-daterange">
							<div class="form-control-position">
								<i class='bx bx-calendar-check'></i>
							</div>
						</div>
                        <div class="card-body pb-1">
                            <div id="analytics-bar-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    let goal_status_percent = <?= $goal_status_percent?>;
    let bill_history_axis = [<?= implode(',', $bill_history_axis)?>];
    let history_paid = [<?= implode(',', $billing_history_paid) ?>];
	let history_unpaid = [<?= implode(',', $billing_history_unpaid) ?>];
	let history_confirmed = [<?= implode(',', $billing_history_confirmed) ?>];
	let get_history_chart_data = "<?= $get_history_chart_data?>";
</script>
