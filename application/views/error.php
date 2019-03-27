<script>
    $(document).ready(function(){
        $("#check_user").modal('toggle');
    });
</script>

<div class="modal fade" id="check_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
        
        </button>
      </div>
      <div class="modal-body">
      <span id='error' class="fas fa-exclamation-circle"></span>
        <h6 class='modal_mensaje_error'> No tienes permiso para acceder </h6>
      </div>
      <div class="modal-footer">
      <?php
      echo anchor('Login/index/','Volver al menu principal','type="button" class="btn btn-primary"');
        ?>
      </div>
    </div>
  </div>
</div>
