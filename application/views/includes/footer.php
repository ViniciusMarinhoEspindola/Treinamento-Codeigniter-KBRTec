    <!-- Bootstrap Jquery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <!--<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script> -->
    <script src= <?php echo base_url("assets/ckeditor/ckeditor.js"); ?>></script>
    <script src= <?php echo base_url("assets/ckfinder/ckfinder.js"); ?>></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/2.0.4/js/Jcrop.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    
    <script>
         // DataTable
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
                },
                "order": [[0, 'desc']],
                "lengthMenu": [[5, 10], [5, 10]],
                
            });
        });


        // Imagem CROP
        $(function(){

            $('#imageCrop').Jcrop({
                boxWidth: 450, 
                boxHeight: 350,
                onSelect: updateCoords
            });

        });

        function updateCoords(c)
        {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        };


        // Preview imagem
        $('#img').change(function(){
            const file = $(this)[0].files[0];
            const fileReader = new FileReader();

            if (typeof(FileReader) != "undefined") {
                $('#preview').empty();
            }

            fileReader.onloadend = function(){
                let image = $("<img />", {
                                "src": fileReader.result
                            }).appendTo('#preview');
                
                image.Jcrop({
                    boxWidth: 450, 
                    boxHeight: 350,
                    onSelect: updateCoords
                });
            }
            
            fileReader.readAsDataURL(file);
        });


        // Datepicker
        $(function() {
            $( "#nascimento" ).datepicker({
                dateFormat: 'yy-mm-dd',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
            });
        });


        // CKEditor 
        ClassicEditor
        .create( document.querySelector( '#descricao' ), {
            ckfinder: {
                uploadUrl: '/CodeIgniter-crud/assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            }
        })
        .catch( error => {
            console.error( error );
        } );


        // Buscar subcategoria na parte de editar
        $("#editCategoria").change(buscaEditSubcategoria);  
        $(document).ready(buscaEditSubcategoria);  

        // Buscar subcategoria na parte de cadastrar
        $(document).ready(buscaSubcategoria);  
        $("#userCategoria").change(buscaSubcategoria); 


        // Busca subcategoria na parte de editar
        function buscaEditSubcategoria() {
            var base_url = '<?php echo base_url() ?>';
            var categoria = $("#editCategoria").val();
            var subcategoria = $("#controleSucategoria").val();
            $.ajax({
                url: base_url+"SubCategorias/getSubcategoria/edit",
                type: "POST",
                data: {categoria:categoria, subcategoria:subcategoria},
                success: function(data){
                    $("#editSubcategoria").html(data);
                    console.log(data);
                }
            });
        }

        // Busca subcategoria
        function buscaSubcategoria() {
            var base_url = '<?php echo base_url() ?>';
            var categoria = $("#userCategoria").val();
            $.ajax({
                url: base_url+"SubCategorias/getSubcategoria",
                type: "POST",
                data: {categoria:categoria},
                success: function(data){
                    $("#userSubcategoria").html(data);
                }
            });
        }
    </script>
</body>
</html>