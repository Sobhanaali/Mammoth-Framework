

@section('title' , 'Contact us')
@section('content')

    <div class="bg-primary py-5">
        <div class="container row align-items-center mx-auto">
            <h1 class="col-6 display-1 text-white">Contact us ...</h1>
            <div class="col-6">

                <form method="post" class="border p-3 rounded shadow bg-white">
                <div class="mb-3">
                    <label for="subject" class="form-label">Subject:</label>
                    <input type="text" name="subject" class="form-control" id="subject">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Body:</label>
                    <textarea type="password" name="body" class="form-control" id="body"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        
            </div>
        </div>
    </div>

@endSection