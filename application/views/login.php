<div class="container-fluid" id="login"> 
<div class='box'>
        <?php
            if (isset($msg)){
                switch ($msg) {
                    case 3:
                        echo "<div class='alert alert-danger' role='alert'> Usuario o contraseña incorrectos.</div>";
                        break;
                }
            }
        ?>
</div>
    <div class="row">
    <div class="col-md-4"></div> 
         <div class="col-md-4">
             <div id='fondo_form'>
                 
            <h4 class='text-center'>Formulario de Login</h4>
                <?php
                echo form_open('Login/checkLogin');
                ?>
                    <div class='form-group'>
                        <label for='name'>Usuario</label>
                        <input type='text' class='form-control' placeholder='Introduce tu nombre' name='name' onblur='check_user();' id='user' required/>
                    </div>

                    <div class='form-group'>
                        <label for='password'>Contraseña</label>
                        <input type='password' class='form-control' placeholder='Introduce tu contraseña' name='password' required/>
                    </div>

                    <input type='submit' class='btn btn-primary' value='Acceder'/>
                <?php 
                echo form_close();   
                ?>

        </div>
    