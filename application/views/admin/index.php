<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>申請管理</h2>
					</div>
					<div class="col-sm-6">
						<a href="#deletemodal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>刪除已選取資料</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th></th>
						<th>建立時間</th>
						<th>申請日期</th>
						<th>姓名</th>
						<th>系級</th>
						<th>學號</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php echo form_open('admin/delete')?>
					<?php foreach($record as $item):?>
						<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox" name="options[]" value="<?php echo $item['RecordId'];?>">
								<label></label>
							</span>
						</td>
						<td><?php echo $item['CreateTime'];?></td>
						<td><?php echo $item['ApplyDate'];?></td>
						<td><?php echo $item['Name'];?></td>
						<td><?php echo $item['Grade'];?></td>
						<td><?php echo $item['StudentId'];?></td>
						<td><a href="./view/<?php echo $item['RecordId']?>" class="btn btn-link">更多</a></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			
		</div>
	</div>        
</div>
<!-- Delete Modal HTML -->
<div id="deletemodal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">						
					<h4 class="modal-title">刪除已選取資料</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<h3>確定刪除選擇的資料?</h3>
					<p class="text-warning">資料無法被復原!</p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="取消">
					<input type="submit" class="btn btn-danger" value="確定刪除">
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?php echo base_url(); ?>static/js/admin.js"></script>