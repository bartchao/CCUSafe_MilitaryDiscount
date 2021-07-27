<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>課程管理</h2>
					</div>
                    <div class="col-sm-6 float-end">
                        <a href="#addmodal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE145;</i> <span>新增課程</span></a>						
					
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
                <colgroup>
                <col span="1" style="width: 10%;">
                <col span="1" style="width: 40%;">
                <col span="1" style="width: 25%;">
                <col span="1" style="width: 25%;">
                </colgroup>
				<thead>
					<tr>
						<th>課程ID</th>
						<th width="40%">課程名稱</th>
						<th>狀態</th>
                        <th width="20%">動作</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($course as $item):?>
						<tr>
						<td><?php echo $item['CourseId'];?></td>
						<td><?php echo $item['CourseName'];?></td>
                        <?php if($item['Enable']==1){
                            echo '<td><font color="blue">啟用</font></td>';
                        }else if($item['Enable']==0){
                            echo '<td><font color="red">停用</font></td>';
                        }?>
                        <td><a href="./course/changestatus/<?php echo $item['CourseId']?>" class="btn btn-warning">啟用/停用</a>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			
		</div>
	</div>        
</div>
<!-- Delete Modal HTML -->
<div id="addmodal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
        <?php echo form_open('admin/course/addcourse'); ?>
				<div class="modal-header">						
					<h4 class="modal-title">新增課程</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<input type="text" class="form-control" name="addcourse" required></input>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="取消">
					<input type="submit" class="btn btn-danger" value="確定">
				</div>
			<?php form_close()?>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>static/js/admin.js"></script>