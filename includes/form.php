<?
$id = null;
$email = null;
$descr = null;
$perf = 0;
include("../config.php");
if (isset($_GET['id'])) {
  $res = $mysqli->query('Select * From `tasks` where `id`='.$_GET['id']);
  if($res && $res->num_rows>0){
    $res = $res->fetch_all(MYSQLI_ASSOC);
  }  
  $id = $res[0]['id']; 
  $email = $res[0]['email']; 
  $descr = $res[0]['description']; 
  $perf = $res[0]['performance'];   
}   
?>
<form method="post" action="index.php" class="was-validated">
  <input type="hidden" class="form-control" name="type" value="<?=$id===null ? 'create' : 'update'?>" id="inputEmail" placeholder="Email">
  <input type="hidden" class="form-control" name="id" value="<?=$id?>" id="inputEmail" placeholder="Email">
  <div class="mb-3">
      <input type="email" class="form-control" name="email" value="<?=$email?>" id="inputEmail" placeholder="Email" required="required">
    </div>
  <div class="mb-3">
    <label for="validationTextarea">Описание задачи</label>
    <textarea class="form-control is-invalid" id="validationTextarea" placeholder="Описание задачи" name="descr"required><?=$descr?></textarea>
    <div class="invalid-feedback">
      Пожалуйста введите описание задачи, оно не должно быть пустым.
    </div>
  </div>

  <div class="custom-control custom-checkbox mb-3">
    <input type="checkbox" <?=($perf==1) ? 'checked' : ''?> class="custom-control-input" name="perf" id="Perf">
    <label class="custom-control-label" for="Perf">На выполнении</label>
  </div>

  <button type="submit" class="btn btn-primary">Сохранить</button>

</form>