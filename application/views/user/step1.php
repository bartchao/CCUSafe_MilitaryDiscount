   <div class="container px-4 gy-5">
      <h3>Step1/2:個人資料</h3>
      <?php echo form_open('user/step1'); ?>
      <?php echo validation_errors('<div class="alert alert-warning" role="alert">','</div>'); ?>
         <div class="mb-3">
            <label class="form-label">申請日期</label>
            <input type="date" id="applydate" class="form-control flatpickr" name="applydate" placeholder="" value="<?php echo set_value('applydate'); ?>">
         </div>
         <!-- Input -->
         <div class="mb-3">
            <label class="form-label">姓名</label>
            <input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>"required maxlength="50">
         </div>
         <!-- Password -->
         <div class="mb-3">
            <label class="form-label">系級</label>
            <input type="text" name="grade" class="form-control" value="<?php echo set_value('grade'); ?>" required >
         </div>
         <div class="mb-3">
            <label class="form-label">學號</label>
            <input type="number" name="studentid" class="form-control" value="<?php echo set_value('studentid'); ?>" required maxlength="9">
         </div>
         <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>"placeholder="非必填">
         </div>
         <div class="mb-3">
            <label class="form-label">出生年月日</label>
            <input type="date" id="birthdate" class="form-control flatpickr" name="birthdate" value="<?php echo set_value('birthdate'); ?>"placeholder="" required>
         </div>
         <div class="mb-3">
            <label class="form-label">折抵天數</label>
            <input type="number" class="form-control " name="discount" value="<?php echo set_value('discount'); ?>" placeholder="" required >
         </div>
         
        <div class="mb-3">
        <label class="form-label" for="course">課程</label>
         <?php foreach ($course as $item): ?>
            <div class="form-check">
               <input class="form-check-input" name="checked[]" type="checkbox" value="<?php echo $item['CourseId']?>" id="flexCheckDefault">
               <label class="form-check-label"><?php echo $item['CourseName']?></label>
            </div>
         <?php endforeach ?>   
         </div>
         <!-- Select Option -->
         <div class="d-grid">
            <button type="submit" name="submit" class="btn btn-primary">送出</button>
         </div>
      </form>
   </div>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/zh-tw.js"></script>
<script>
   flatpickr("#birthdate",{altInput: true,altFormat: "F j, Y",dateFormat: "Y-m-d",maxDate: new Date(),locale:"zh_tw"});
   flatpickr("#applydate",{altInput: true,altFormat: "F j, Y",dateFormat: "Y-m-d",maxDate: new Date(),locale:"zh_tw",defaultDate : new Date()});
</script>

