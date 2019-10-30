<main>
    <div class="row">
        <div class="container col-5 mt-5">
            <h1 class="text-success text-center col-12 display-4">Editar Subcategoria</h1>

            <?php echo validation_errors('<div class="alert alert-danger mt-5">', '</div>'); ?>

            <form class="col-12" action="<?php echo base_url('subcategorias/editSubcategoria/'.$subcategoria->result()[0]->id_subcategoria); ?>" method="POST">
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select class="form-control" name="editCategoria" id="categoria">
                        <?php 
                            foreach ($categorias->result() as $row)
                            {
                                if($row->id_categoria == $subcategoria->result()[0]->id_categoria) {
                        ?>
                                    <option selected value="<?php echo $row->id_categoria;?>"><?php echo $row->categoria;?></option>
                        <?php
                                }
                                else{
                        ?>
                                    <option value="<?php echo $row->id_categoria;?>"><?php echo $row->categoria;?></option>
                        <?php
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Subcategoria">Editar Subcategoria</label>
                    <input type="text" name="editSubcategoria" value="<?php echo $subcategoria->result()[0]->subcategoria; ?>" class="form-control" id="editSubcategoria">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Editar">
                    <input type="reset" class="btn btn-outline-success" value="Limpar">
                </div>
            </form>
        </div>
    </div>
</main>