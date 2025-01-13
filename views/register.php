

@section('title' , 'Contact us')
@section('content')

    <div class="bg-primary py-5">
        <div class="container row align-items-center mx-auto">
            <h1 class="col-6 text-white">Create an account ...</h1>
            <div class="col-6">
                <div class="border p-3 rounded shadow bg-white">
                    <?php $form = app\core\form\Form::begin('' , 'post'); ?>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                <?php echo $form->field($model , 'firstName'); ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                <?php echo $form->field($model , 'lastName'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <?php echo $form->field($model , 'email'); ?>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <?php echo $form->field($model , 'password')->passwordField(); ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <?php echo $form->field($model , 'confirmPassword')->passwordField(); ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-5">Sign Up</button>
                    <?php app\core\form\Form::end(); ?>
                </div>
                
            </div>
        </div>
    </div>

@endSection