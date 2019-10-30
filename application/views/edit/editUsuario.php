<main>
    <div class="row">
        <div class="col-12">
            <div class="container col-5">    
                <h1 class="text-center display-4 mt-5 text-success">EDITAR</h1>  
                
                <?php echo validation_errors('<div class="alert alert-danger mt-5">', '</div>'); ?>
                
                <form class="col-12" action="<?php echo base_url('usuarios/editUser/'.$user->id_user); ?>" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" value="<?php echo $user->nome; ?>" name="name" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" value="<?php echo $user->email; ?>" name="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="nascimento">Data de nascimento</label>
                        <input type="date" value="<?php echo $user->nascimento; ?>" name="nascimento" class="form-control" id="nascimento">
                    </div>

                    <div class="form-group">
                        <label for="img">Foto</label>
                        <input type="file" name="img" value="<?php echo $user->img; ?>" class="form-control col-12" id="img">
                        <!-- Preview Imagem -->
                        <center id="preview">
                            <img src="<?php echo base_url('assets/images/'.$user->img); ?>" alt="">
                        </center>
                    </div>

                    <!-- Cordenadas -->
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />

                    <!-- Categorias e subcategorias -->
                    <div class="form-group">
                        <label for="categoria">Categoria</label>
                        <select class="form-control" name="categoria" id="editCategoria" >
                            <?php 
                                foreach ($categorias->result() as $row)
                                {
                                    if ($row->id_categoria == $user->id_categoria) {
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
                    
                    <input type="hidden" name="controleSucategoria" id="controleSucategoria" value="<?php echo $user->id_subcategoria; ?>">

                    <div class="form-group">
                        <label for="subcategoria">Sub-Categoria</label>
                        <select required class="form-control" name="subcategoria" id="editSubcategoria">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="6">
                            <?php echo $user->descricao; ?>
                        </textarea>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-success">
                        <input type="reset" class="btn btn-outline-success" value="Limpar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>