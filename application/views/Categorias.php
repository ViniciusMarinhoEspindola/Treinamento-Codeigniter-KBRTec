<main>
    
    <div class="row">
        <div class="container col-5 mt-5">
            <h1 class="text-success text-center col-12 display-3">Categorias</h1>

            <?php echo validation_errors('<div class="alert alert-danger mt-5">', '</div>'); ?>
            <?php if($flash_message !== null) { ?> <div class="alert alert-success mt-5"><?php echo $flash_message; ?></div> <?php } ?>
            
            <form class="col-12" action="<?php echo base_url('categorias/setCategoria'); ?>" method="POST">
                <div class="form-group">
                    <label for="categoria">Nova categoria</label>
                    <input reuqired type="text" value="<?php echo set_value('categoria'); ?>" name="categoria" class="form-control" id="categoria">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Cadastrar">
                    <input type="reset" class="btn btn-outline-success" value="Limpar">
                </div>
            </form>

            <button class="btn btn-success mt-5" data-toggle="modal" data-target="#categoriasModal">Listar Categorias</button>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="categoriasModal" tabindex="-1" role="dialog" aria-labelledby="categoriasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-5 pr-5">
                    <div class="row center">
                        <h3 class="col-12 mb-4 bg-success text-center text-light p-3">
                            Categorias
                        </h3>
                        <table class="table table-hover" id="table" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">Categoria</th>
                                    <th class="text-center">Editar</th>
                                    <th class="text-center">Excluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($categorias as $row)
                                    {
                                ?>
                                     <tr>
                                        <td class="text-center">
                                            <?php echo $row->categoria; ?>
                                        </td>

                                        <td class="text-center"><a class="btn btn-warning" href="<?php echo base_url('categorias/editar/'.$row->id_categoria); ?>"><i class="fas text-light fa-pen"></i></a></td>
                                        <td class="text-center"><a class="btn btn-danger" href="<?php echo base_url('categorias/deleteCategoria/'.$row->id_categoria); ?>"><i class="fas fa-trash"></i></a></td>
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