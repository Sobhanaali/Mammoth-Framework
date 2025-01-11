

@section('title' , 'Contact us')
@section('content')

    <div class="bg-primary py-5">
        <div class="container row align-items-center mx-auto">
            <h1 class="col-6 text-white">Create an account ...</h1>
            <div class="col-6">

                <form method="post" class="border p-3 rounded shadow bg-white">

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name:</label>
                                <input type="text" name="firstName" class="form-control" id="firstName">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name:</label>
                                <input type="text" name="lastName" class="form-control" id="lastName">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password:</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                                <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
                            </div>
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary px-5">Login</button>
                </form>
        
            </div>
        </div>
    </div>

@endSection