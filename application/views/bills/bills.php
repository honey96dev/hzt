<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section class="card">
		<div class="card-header">
			<h4 class="card-title" data-i18n="Bills">Bills</h4>
			<?php if (is_admin()): ?>
			<div class="manage-buttons">
				<a class="btn btn-primary btn-sm glow mr-1 mb-1" href="<?= $create_url?>">
					<i class="bx bx-plus"></i>
					<span class="align-middle ml-25" data-i18n="Add">Add</span>
				</a>
			</div>
			<?php endif;?>
		</div>
		<div class="card-content">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table bill-table">
						<thead>
							<tr>
								<th data-i18n="Bill Date">Bill Date</th>
								<th data-i18n="Bill Number">Bill Number</th>
								<?php if (is_admin()): ?>
									<th data-i18n="Customer">Customer</th>
									<th data-i18n="Company">Company</th>
								<?php endif;?>
								<th data-i18n="">Attachment</th>
								<th data-i18n="Product">Product</th>
								<th data-i18n="Quantity">Quantity</th>
								<th data-i18n="Amount">Amount</th>
								<th data-i18n="Status">Status</th>
								<?php if (is_admin()): ?>
									<th></th>
								<?php endif;?>
							</tr>
						</thead>
						<tbody>
						<?php if (empty($bills)):?>
							<tr>
								<?php if (is_admin()): ?>
									<td colspan="9" class="text-center">There are no bills.</td>
								<?php else: ?>
									<td colspan="6" class="text-center">There are no bills.</td>
								<?php endif;?>
							</tr>
						<?php else: ?>
							<?php foreach($bills as $bill) :?>
								<tr>
									<td><?= show_date($bill['bill_date']) ?></td>
									<td><?= $bill['bill_number'] ?></td>
									<?php if (is_admin()): ?>
										<td><?= $bill['first_name'] . ' ' . $bill['surname'] ?></td>
										<td><?= $bill['company_name'] ?></td>
									<?php endif;?>
									<td>
										<?php if($bill['bill_doc'] != ''): ?>
											<a href="<?= BILLING_DOC_URL . $bill['bill_doc']?>" target="_blank"><i class="bx bx-file-blank"></i></a>
										<?php endif;?>
									</td>
									<td><?= $bill['product_name'] ?></td>
									<td><?= $bill['quantity'] . ' kg' ?></td>
									<td>$<?= $bill['total_amount'] ?></td>
									<td class="<?= $bill['status'] == 1 ? 'text-success' : ($bill['status'] == 2 ? 'text-warning' : 'text-danger')?>">
										<?= $bill['status'] == 1 ? 'Pagado' : ( $bill['status'] == 2 ? 'Confirmado' : 'No Pagado') ?>
									</td>
									<?php if (is_admin()): ?>
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
									<?php endif;?>
								</tr>
							<?php endforeach; ?>
						<?php endif;?>
						</tbody>
						<!-- <tfoot>
							<tr>
								<th data-i18n="Bill Date">Bill Date</th>
								<th data-i18n="Bill Number">Bill Number</th>
								<?php if (is_admin()): ?>
									<th data-i18n="Customer">Customer</th>
									<th data-i18n="Company">Company</th>
								<?php endif;?>
								<th data-i18n="Product">Product</th>
								<th data-i18n="Quantity">Quantity</th>
								<th data-i18n="Amount">Amount</th>
								<th data-i18n="Status">Status</th>
								<?php if (is_admin()): ?>
									<th></th>
								<?php endif;?>
							</tr>
						</tfoot> -->
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>