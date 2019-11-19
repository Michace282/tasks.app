<?
    header('Content-Type: text/html; charset=utf-8');
    session_start();

    include("config.php");
?>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tasks Application on clear Bootstrap</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">

        <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">

        <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready( function () {
                $('#tasksTable').DataTable();

                $('.btn-add').on( "click", function() {
                  $('#DataModalLabel').text('Добавление задачи');
                  $('.modal-body').load('/includes/form.php');
                });
                $('.btn-edit').on( "click", function() {
                  var id = $(this).parent().parent().find("td:first").text();
                  $('#DataModalLabel').text('Редактирование задачи №' + id);
                  $('.modal-body').load('/includes/form.php?id='+id);

                });
            } );
        </script>
    </head>
    <body>
        <div class="container">
        <?
            require("includes/auth.php");
            require("classes/data.class.php");
            if ($auth->maybe()) {
                echo '<a class="btn btn-danger" style="float: right" href="?exit=1">Выйти</a>';
                echo "<h1>Список задач</h1>";
                $tasks = $mysqli->query("SELECT * FROM `tasks`");
                $res = '';
                if($tasks && $tasks->num_rows>0){
                    $res = $tasks->fetch_all(MYSQLI_ASSOC);
                }
                $datasave = new Data(); 
                
                //insert
                if ($_POST['type'] === 'create') {
                    $datasave->insert($_POST['email'], $_POST['descr'], $_POST['perf']);
                    echo '<div class="alert alert-info" role="alert">
                        Добавлена новая задача.</div>';
                }
                //update
                if ($_POST['type'] === 'update') {
                    $datasave->update($_POST['id'], $_POST['email'], $_POST['descr'], $_POST['perf']);
                    echo '<div class="alert alert-info" role="alert">
                         Обновлена задача №'.$_POST['id'].'.</div>';   
                }
                //delete 
                if (isset($_GET['del_id'])) {
                    $datasave->delete($_GET['del_id']);
                    echo '<div class="alert alert-danger" role="alert">
                         Удалена задача №'.$_GET['del_id'].'.</div>';
                }

            ?>

<!-- Button trigger modal -->


            <button style="float:right;" type="button" class="btn btn-primary btn-add" data-toggle="modal" data-target="#DataModal">
            Добавить
            </button>
                    <!-- Modal -->
<div class="modal fade" id="DataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DataModalLabel">Добавление задачи</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
    </div>
  </div>
</div>
            <table id="tasksTable">
                <thead>
                    <tr>
                        <th>№ задачи</th>
                        <th>Email</th>
                        <th>Описание</th>
                        <th>Опции</th>
                    </tr>
                </thead>
                <tbody>
            <?

            foreach ( $res as $item ) {
                $color = 'lightyellow';
                if ($item['performance']) 
                    $color = 'lightgreen';
                else
                    $color = 'lightyellow';
                echo "<tr style='background: $color'>
                          <td>".$item['id']."</td>
                          <td>".$item['email']."</td>
                          <td>".$item['description']."</td>
                          <td><button type='button' class='btn btn-primary btn-edit' data-toggle='modal' data-target='#DataModal'>Редактировать</button><a style='float:right;' href='index.php?del_id=".$item['id']."'  class='btn btn-danger'>Удалить</a></td>
                      </tr>";
            }
            ?>    
            </tbody>
            </table>
            <?
               $mysqli->close();
            }
            else {
        ?>



         <h1>Авторизация</h1>
        <form method="post">
            <div class="form-group">
                <label for="login">Пароль</label>
                <input type="text" class="form-control" id="login" name="login" placeholder="Введите логин"/>
            </div>
            <div class="form-group">
                <label for="psw">Пароль</label>
                <input type="password" class="form-control" name="password" id="psw" placeholder="Пароль">
            </div>
            <button type="submit" class="btn btn-primary">Авторизоваться</button>
        </form>

        <?
           }
        ?>
        </div>
    </body>
</html>