<!-- Modal -->
<div class="modal fade" id="detail_grub" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="myModalLabel">Detail Group User</h4>
			</div>
			<div class="modal-body">

				<div class="panel-group smart-accordion-default" id="accordion-2">
						@foreach ($menu as $key => $value)
							@if ($value->m_parent != null)
								<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#grub-{{$key}}"  class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> {{$value->m_name}} </a></h4>
								</div>
								<div id="grub-{{$key}}" class="panel-collapse collapse"  style="height: 0px;">
									<div class="panel-body">
										<table class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<th>View</th>
													<th>Create</th>
													<th>Update</th>
													<th>Delete</th>
													<th>Print</th>
												</tr>
											</thead>
											<tbody>
													<tr>
														<td align="center"><input id="viewmd-{{$value->m_id}}" type="checkbox" disabled></td>
														<td align="center"><input id="createmd-{{$value->m_id}}" type="checkbox" disabled></td>
														<td align="center"><input id="updatemd-{{$value->m_id}}" type="checkbox" disabled></td>
														<td align="center"><input id="deletemd-{{$value->m_id}}" type="checkbox" disabled></td>
														<td align="center"><input id="printmd-{{$value->m_id}}" type="checkbox" disabled></td>
													</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							@endif
						@endforeach

				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
