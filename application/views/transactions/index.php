<article class="content">
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="grid_3 grid_4 table-responsive animated fadeInRight">
            <h5><?php echo $this->lang->line('Transactions') ?></h5>

            <hr>
            <table id="trans_table" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>

                    <th><?php echo $this->lang->line('Date') ?></th>
                    <th><?php echo $this->lang->line('Account') ?></th>
                    <th><?php echo $this->lang->line('Debit') ?></th>
                    <th><?php echo $this->lang->line('Credit') ?></th>
                    <th><?php echo $this->lang->line('') ?>Sede</th>
                    <th><?php echo $this->lang->line('Method') ?></th>
                    <th>Estado</th>
                    <th><?php echo $this->lang->line('Action') ?></th>


                </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr>
                    <th><?php echo $this->lang->line('Date') ?></th>
                    <th><?php echo $this->lang->line('Account') ?></th>
                    <th><?php echo $this->lang->line('Debit') ?></th>
                    <th><?php echo $this->lang->line('Credit') ?></th>
                    <th><?php echo $this->lang->line('') ?>Sede</th>
                    <th><?php echo $this->lang->line('Method') ?></th>
                    <th>Estado</th>
                    <th><?php echo $this->lang->line('Action') ?></th>


                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</article>
<script type="text/javascript">
    $(document).ready(function () {
       $('#trans_table').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "ajax": {
                "url": "<?php echo site_url('transactions/translist')?>",
                "type": "POST"
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": true,
                },
            ],
        });
    });
</script>

<div id="delete_model" class="modal fade" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Anulacion</h4>
            </div>
            <div class="modal-body">
                <p>¿Seguro que quieres anular esta transacción? El saldo de la cuenta se ajustará.</p>

                <div >
                    <input style="cursor: pointer" type="radio" name="anulacion" value="Cobranza Efectiva" checked>&nbspCobranza Efectiva<br>
                    <input style="cursor: pointer" type="radio" name="anulacion" value="Anulado de Cierre">&nbspAnulado de Cierre<br>
                    <input style="cursor: pointer" type="radio" name="anulacion" value="Anulado de otros Cierres">&nbspAnulado de otros Cierres<br>
                </div>

            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="transactions/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm_002">Anular</button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $("#delete-confirm_002").on("click", function() {
     var o_data = $('#object-id').val();
     var anulacion=$("input:radio[name=anulacion]:checked").val();
    var action_url= $('#action-url').val();
    
    

    $.post(baseurl+action_url,{deleteid:o_data,anulacion:anulacion},function(data){
        alert("Transferencia anulada");
        $("#estado_"+o_data).text("Anulada");
    },'json');

});


    function abrir_modal(link){
        $("#delete_model").modal("show");
        $("#object-id").val($(link).data("object-id"));
        var estado=$("#estado_"+$(link).data("object-id")).text();
        if(estado=="Anulada"){
            $("#delete-confirm_002").attr("disabled",true);
        }else{
            $("#delete-confirm_002").removeAttr("disabled");
        }

    }
</script>