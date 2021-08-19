<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>中正大學兵役折抵 申請資料</title>
</head>
<style>body { font-family:  'taipeisans'; } </style>
<body>
<div>
    <div>
        <p>頁面生成時間:<?php 
            date_default_timezone_set('Asia/Taipei');
            $date = date('m/d/Y h:i:s a', time());
            echo $date;?></p>
    </div>
    <hr>
    <h1>中正大學兵役折抵 申請資料</h1>
    <h2>個人資料</h2>
    <p>姓名:<?php echo $record_item['Name'];?></p>
    <p>系級:<?php echo $record_item['Grade'];?></p>
    <p>學號:<?php echo $record_item['StudentId'];?></p>
    <p>Email:<?php echo $record_item['Email'];?></p>
    <p>出生年月日:<?php echo $record_item['BirthDate'];?></p>
    <h2>申請內容</h2>
    <p>申請日期:<?php echo $record_item['ApplyDate'];?></p>
    <p>折抵天數:<?php echo $record_item['DiscountDays'];?></p>
    <h2>折抵課程</h2>
    <?php foreach($record_item_course as $course):?>
        <?php echo $course['CourseName'];?><br>
    <?php endforeach?>
        <?php foreach($record_item_images as $images):?>
            <img src="<?php echo base_url()?>uploads/<?php echo $images['ImagePath'];?>" width="700px" height="1000px"></img>
        <?php endforeach?>
</div>
</body>
</html>