<main>
    <div class="row">
        <div class="container col-5 mt-5">
            <h1 class="text-success text-center col-12 display-3">Editar categoria</h1>

            <?php echo validation_errors('<div class="alert alert-danger mt-5">', '</div>'); ?>

            <form class="col-12" action="<?php echo base_url('categorias/editCategoria/'.$categoria->result()[0]->id_categoria); ?>" method="POST">
                <div class="form-group">
                    <label for="editCategoria">Editar categoria</label>
                    <input type="text" name="categoria" value="<?php echo $categoria->result()[0]->categoria; ?>" class="form-control" id="editCategoria">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Editar">
                    <input type="reset" class="btn btn-outline-success" value="Limpar">
                </div>
            </form>
        </div>
    </div>
</main>