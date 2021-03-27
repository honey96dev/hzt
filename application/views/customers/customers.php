<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-body">
	<!-- Description -->
	<section class="card">
		<div class="card-header">
			<h4 class="card-title">Customers</h4>
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
					<table class="table customer-table">
						<thead>
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
						</thead>
						<tbody>
						<?php if (empty($customers)):?>
							<tr>
								<td colspan=7>There are no cutomers.</td>
							</tr>
						<?php else: ?>
							<?php foreach($customers as $customer) :?>
								<tr>
									<td><?= $customer['first_name'] . ' ' . $customer['surname'] ?></td>
									<td><?= $customer['email'] ?></td>
									<td>$<?= $customer['goal'] ?></td>
									<td class="<?= $customer['goal_status'] < $customer['goal'] ? 'text-primary' : 'text-success' ?>">
										$<?= $customer['goal_status'] ?>
										<?php if ($customer['goal_status'] >= $customer['goal']):?>
											<span class="badge badge-light-success">
												Goal
											</span>
										<?php endif;?>
									</td>
									<td>
										<span class="badge <?= $customer['status'] ? 'badge-light-success' : 'badge-light-warning'?>">
											<?= $customer['status'] ? 'Active' : 'Pending'?>
										</span>
									</td>
									<td class="text-primary">
										<?= $customer['role'] ? 'Admin' : ''?>
									</td>
									<td><?= show_datetime($customer['created_at']) ?></td>
									<td>
										<div class="dropdown">
											<span class="bx bx-dots-vertical-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
											</span>
											<div class="dropdown-menu dropdown-menu-right">
												<?php if($customer['goal_status'] >= $customer['goal']): ?>
													<a class="dropdown-item" href="<?= $confirm_url . '/' . $customer['id'] ?>"><i class="bx bx-rocket mr-1"></i> confirm</a>
												<?php endif;?>
												<a class="dropdown-item" href="<?= $update_url . '/' . $customer['id'] ?>"><i class="bx bx-edit-alt mr-1"></i> edit</a>
												<a class="dropdown-item delete-cusomer-btn" href="<?= $delete_url . '/' . $customer['id'] ?>"><i class="bx bx-trash mr-1"></i> delete</a>
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif;?>
						</tbody>
						<tfoot>
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
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</section>
	<!--/ Description -->
</div>