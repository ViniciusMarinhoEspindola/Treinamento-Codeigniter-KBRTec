<div class="container" style="width: 100vw;">
    <div class="row center my-5">
        <div class="col-8 p-5 text-light bg-success" style="box-shadow: 0px 0px 20px gray;">
            <div class="row">
                <div class="col-7">
                    <div class="row">
                        <div class="col-12">
                            <h4><?php echo $user->nome; ?></h4>
                        </div>
                        <div class="col-12 mb-3">
                            <?php echo $user->email; ?>
                        </div>
                        <div class="col-12">
                            <p>Data de nascimento: <?php echo date('d/m/Y', strtotime($user->nascimento)); ?></p>
                        </div>
                        <div class="col-4">
                            <?php echo $user->categoria; ?>
                        </div>
                        <div class="col-6">
                            <?php echo $user->subcategoria; ?>
                        </div>
                    </div>
                </div>
                
                <div class="col-5 center">
                    <img src="<?php echo base_url('assets/images/'.$user->img); ?>" style="max-width: 200px; max-heght: 100px;" alt="">
                </div>
                
                <div class="mt-5 col-12">
                    <p><?php echo $user->descricao; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>