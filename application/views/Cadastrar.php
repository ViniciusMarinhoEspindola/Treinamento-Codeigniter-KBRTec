<main>
    <div class="row">
        <div class="col-12">
            <div class="container col-5">    
                <h1 class="text-center display-4 mt-5 text-success">CADASTRE-SE</h1>
                
                <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                
                <form class="col-12" action="<?php echo base_url('usuarios/setUser'); ?>" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input required type="text" name="name" value="<?php echo set_value('name'); ?>" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input required type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="nascimento">Data de nascimento</label>
                        <input required type="date" name="nascimento" value="<?php echo set_value('nascimento'); ?>" class="form-control" id="nascimento">
                    </div>

                    <div class="form-group">
                        <label for="img">Foto</label>
                        <input required type="file" name="img" class="form-control col-12" id="img">
                        <!-- Preview Imagem -->
                        <center id="preview">
                            
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
                        <select required class="form-control"  value="<?php echo set_value('categoria'); ?>" name="categoria" id="userCategoria" >
                            <?php 
                                foreach ($categorias->result() as $row)
                                {   
                                    if ($row->id_categoria == set_value('categoria')) {
                            ?>
                                        <option selected value="<?php echo $row->id_categoria;?>"><?php echo $row->categoria;?></option>
                            <?php
                                    }else{
                            ?>
                                        <option value="<?php echo $row->id_categoria;?>"><?php echo $row->categoria;?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subcategoria">Sub-Categoria</label>
                        <select class="form-control" required name="subcategoria"  value="<?php echo set_value('subcategoria'); ?>" id="userSubcategoria">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control" required id="descricao" name="descricao" rows="6">
                            <?php echo set_value('descricao'); ?>
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