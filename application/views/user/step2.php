<div class="container px-4 gy-5">
   <h3>Step2/2:上傳成績單</h3>
   <?php echo form_open_multipart('user/step2'); ?>
         <div class="mb-3">
            <p class="mb-1 text-dark">上傳成績單證明(可上傳多張)</p>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="upload[]" multiple="multiple" accept="image/*">
         </div>
         <div class="alert alert-warning">檔案格式僅限 jpg | png | gif | jpeg</div>
      <div class="row">
         <div class="col-6 d-grid">
            <button type="submit" class="btn btn-primary" name="submit">送出</button>
         </div>
         <div class="col-6 d-grid">
            <button type="submit" class="btn btn-warning" name="reset">清除並重填</button>
         </div>
      </div>
   </form>
</div>
