<div class="row">
    <div class="container">
        <h1 class="text-success my-5 text-center col-12 display-3">Categorias</h1>
        
        <?php echo validation_errors('<div class="alert alert-danger mt-5">', '</div>'); ?>
        <?php if($flash_message !== null) { ?> <div class="alert alert-success mt-5"><?php echo $flash_message; ?></div> <?php } ?>
        <div class="table-responsive">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th colspan="4" class="text-center">Informações</th>
                        <th colspan="3" class="text-center">Opções</th>
                    </tr>
                    <tr>
                        <th class="text-center">Imagem</th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Categoria</th>
                        <th class="text-center">Ver</th>
                        <th class="text-center">Editar</th>
                        <th class="text-center">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($usuarios as $row)
                        {
                    ?>
                            <tr>
                                <td class="text-center">
                                    <img src="<?php echo base_url('assets/images/'.$row->img); ?>" style="max-width: 200px; max-heght: 100px;" alt="">
                                </td>

                                <td class="text-center">
                                    <?php echo $row->nome; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $row->email; ?>
                                </td>

                                <td class="text-center">
                                    <?php echo $row->categoria; ?>
                                </td>

                                <td class="text-center"><a class="btn btn-primary" href="<?php echo base_url('usuarios/vizualizar/'.$row->id_user); ?>"><i class="fas fa-user"></i></a></td>
                                <td class="text-center"><a class="btn btn-warning" href="<?php echo base_url('usuarios/editar/'.$row->id_user); ?>"><i class="fas text-light fa-user-edit"></i></a></td>
                                <td class="text-center"><a class="btn btn-danger" href="<?php echo base_url('usuarios/deleteUsuario/'.$row->id_user); ?>"><i class="fas fa-user-times"></i></a></td>
                            </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>