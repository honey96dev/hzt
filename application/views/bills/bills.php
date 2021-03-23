<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section class="card">
		<div class="card-header">
			<h4 class="card-title">Bills</h4>
			<div class="manage-buttons">
				<a class="btn btn-primary btn-sm glow mr-1 mb-1" href="<?= $create_url?>">
					<i class="bx bx-plus"></i>
					<span class="align-middle ml-25">Add</span>
				</a>
			</div>
		</div>
		<div class="card-content">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table bill-table">
						<thead>
							<tr>
								<th>Bill Date</th>
								<th>Bill Number</th>
								<th>Customer</th>
								<th>Company</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Amount</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
						<?php if (empty($bills)):?>
							<tr>
								<td colspan="9" class="text-center">There are no bills.</td>
							</tr>
						<?php else: ?>
							<?php foreach($bills as $bill) :?>
								<tr>
									<td><?= show_date($bill['bill_date']) ?></td>
									<td><?= $bill['bill_number'] ?></td>
									<td><?= $bill['first_name'] . ' ' . $bill['surname'] ?></td>
									<td><?= $bill['company_name'] ?></td>
									<td><?= $bill['product_name'] ?></td>
									<td><?= $bill['quantity'] . ' kg' ?></td>
									<td>$<?= $bill['total_amount'] ?></td>
									<td class="<?= $bill['status'] ? 'text-success' : 'text-danger'?>">
										<?= $bill['status'] ? 'Paid' : 'Unpaid'?>
									</td>
									<td>
										<div class="dropdown">
											<span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
											</span>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="<?= $update_url . '/' . $bill['id'] ?>"><i class="bx bx-edit-alt mr-1"></i> edit</a>
												<a class="dropdown-item delete-bill-btn" href="<?= $delete_url . '/' . $bill['id'] ?>"><i class="bx bx-trash mr-1"></i> delete</a>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif;?>
						</tbody>
						<tfoot>
							<tr>
								<th>Bill Date</th>
								<th>Bill Number</th>
								<th>Customer</th>
								<th>Company</th>
								<th>Product</th>
								<th>Quantity</th>
								<th>Amount</th>
								<th>Status</th>
								<th></th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>