<div class="container px-1 gy-5">
<div>
	<div class="flaot-left">
	<p>資料建立時間:<?php echo $record_item['CreateTime'];?></p>
	</div>
    <div class="float-right">
	<?php echo form_open('admin/delete')?>
        <a href="export/<?php echo $record_item['RecordId'];?>" class="btn btn-primary">儲存PDF</a>
        
        <input type="hidden" name="options[]" value="<?php echo $record_item['RecordId'];?>">
        <button type="submit" class ="btn btn-danger">刪除</button>
        <?php echo form_close()?>
	</div>
</div>
	<hr>

    <h3>個人資料</h3>
    <table class="table table-striped table-responsive">
        <thead>
                <th >姓名</th>
                <th >Email</th>
                <th >系級</th>
                <th >學號</th>
                <th >出生年月日</th>
        </thead>
        <tbody>
            <tr>
                <td width="20%"><?php echo $record_item['Name'];?></td>
                <td width="20%"><?php echo $record_item['Email'];?></td>
                <td width="20%"><?php echo $record_item['Grade'];?></td>
                <td width="20%"><?php echo $record_item['StudentId'];?></td>
                <td width="20%"><?php echo $record_item['BirthDate'];?></td>
            </tr>
        </tbody>
    </table>
    <h3>申請內容</h3>
    <table class="table table-striped table-responsive">
        <thead>
            <th >申請日期</th>
            <th >折抵天數</th>
            <th >折抵課程</th>
        </thead>
        <tbody>
            <tr>
            <td width = "20%"><?php echo $record_item['ApplyDate'];?></td>
            <td rowspan="0" width="10%"><?php echo $record_item['DiscountDays'];?></td>
            <td width="50%">
            <?php foreach($record_item_course as $course):?>
               <?php echo $course['CourseName'];?><br>
            <?php endforeach?>
            </td>
            </tr>
        </tbody>
    </table>
    <h3>上傳資料</h3>
        <?php foreach($record_item_images as $images):?>
            <a href="<?php echo base_url()?>uploads/<?php echo $images['ImagePath'];?>">
            <img src="<?php echo base_url()?>uploads/<?php echo $images['ImagePath'];?>" class="img-fluid img-thumbnail" href=""></img>
            </a>
        <?php endforeach?>
</div>