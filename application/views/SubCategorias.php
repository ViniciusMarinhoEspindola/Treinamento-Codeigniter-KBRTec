<main>
    <div class="row">
        <div class="container col-5 mt-5">
            <h1 class="text-success text-center col-12 display-3">Subcategorias</h1>

            <?php echo validation_errors('<div class="alert alert-danger mt-5">', '</div>'); ?>
            <?php if($flash_message !== null) { ?> <div class="alert alert-success mt-5"><?php echo $flash_message; ?></div> <?php } ?>

            <form class="col-12" action="<?php echo base_url('subcategorias/setSubcategoria'); ?>" method="POST">
                <div class="form-group">
                    <label for="categoria">Categoria</label>
                    <select reuqired class="form-control" name="categoria" id="categoria">
                        <?php 
                            foreach ($categorias->result() as $row)
                            {
                        ?>
                                <option value="<?php echo $row->id_categoria;?>"><?php echo $row->categoria;?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="subcategoria">Nova Subcategoria</label>
                    <input reuqired type="text" value="<?php echo set_value('subcategoria'); ?>" name="subcategoria" class="form-control" id="subcategoria">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Cadastrar">
                    <input type="reset" class="btn btn-outline-success" value="Limpar">
                </div>
            </form>

            <button class="btn btn-success mt-5" data-toggle="modal" data-target="#subcategoriasModal">Listar Categorias</button>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="subcategoriasModal" tabindex="-1" role="dialog" aria-labelledby="subcategoriasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row center">
                        <h3 class="col-12 mb-4 bg-success text-center text-light p-3">
                            Subcategorias
                        </h3>

                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Categoria</th>
                                    <th class="text-center">Subcategoria</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>                                     
                                <?php
                                    foreach ($subcategorias as $row)
                                    {
                                ?>      
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $row->categoria; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row->subcategoria; ?>
                                            </td>
                
                                            <td class="text-center"><a class="btn btn-warning" href="<?php echo base_url('subcategorias/editar/'.$row->id_subcategoria); ?>"><i class="fas text-light fa-pen"></i></a></td>
                                            <td class="text-center"><a class="btn btn-danger" href="<?php echo base_url('subcategorias/deleteSubcategoria/'.$row->id_subcategoria); ?>"><i class="fas fa-trash"></i></a></td>
                                        </tr>
                                <?php
                                    }
                                ?>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>