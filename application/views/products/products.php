<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section class="card">
		<div class="card-header">
			<h4 class="card-title" data-i18n="Customers">Products</h4>
			<div class="manage-buttons">
				<a class="btn btn-primary btn-sm glow mr-1 mb-1" href="<?= $create_url?>">
					<i class="bx bx-plus"></i>
					<span class="align-middle ml-25" data-i18n="Add">Add</span>
				</a>
			</div>
		</div>
		<div class="card-content">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table customer-table">
						<thead>
							<tr>
								<th rowspan="2" data-i18n="Name">Name</th>
								<th colspan="3" data-i18n="">Billed Number</th>
								<th colspan="3" data-i18n="">Billed Amount</th>
								<th colspan="3" data-i18n="">Billed Quantity</th>
								<th rowspan="2" data-i18n="Register Date">Register Date</th>
								<th rowspan="2"></th>
							</tr>
							<tr>
								<th>Paid</th>
								<th>Unpaid</th>
								<th>Confirmed</th>
								<th>Paid</th>
								<th>Unpaid</th>
								<th>Confirmed</th>
								<th>Paid</th>
								<th>Unpaid</th>
								<th>Confirmed</th>
							</tr>
						</thead>
						<tbody>
						<?php if (empty($products)):?>
							<tr>
								<td colspan=11>There are no products.</td>
							</tr>
						<?php else: ?>
							<?php foreach($products as $product) :?>
								<tr>
									<td><?= $product['product_name'] ?></td>
									<td>
										<span><?= $product['billed_number']['paid']?></span>
									</td>
									<td>
										<span><?= $product['billed_number']['unpaid']?></span>
									</td>
									<td>
										<span><?= $product['billed_number']['confirmed']?></span>
									</td>
									<td>
										<span>$<?= show_number($product['billed_amount']['paid'])?></span>
									</td>
									<td>
										<span>$<?= show_number($product['billed_amount']['unpaid'])?></span>
									</td>
									<td>
										<span>$<?= show_number($product['billed_amount']['confirmed'])?></span>
									</td>
									<td>
										<span><?= show_number($product['billed_quantity']['paid'])?> kg</span>
									</td>
									<td>
										<span><?= show_number($product['billed_quantity']['unpaid'])?> kg</span>
									</td>
									<td>
										<span><?= show_number($product['billed_quantity']['confirmed'])?> kg</span>
									</td>
									<td><?= show_datetime($product['created_at']) ?></td>
									<td>
										<div class="dropdown">
											<span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
											</span>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="<?= $update_url . '/' . $product['id'] ?>"><i class="bx bx-edit-alt mr-1"></i> edit</a>
												<a class="dropdown-item delete-cusomer-btn" href="<?= $delete_url . '/' . $product['id'] ?>"><i class="bx bx-trash mr-1"></i> delete</a>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif;?>
						</tbody>
						<!-- <tfoot>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Goal</th>
								<th>Bill Amount</th>
								<th>Status</th>
								<th>Role</th>
								<th>Registed Date</th>
								<th></th>
							</tr>
						</tfoot> -->
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>