<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js">
    </script>
    <link rel= "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css"/>
    <title>Multiple Emails</title>
</head>
<body>
<div class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#sendEmail">
                                Send Email
                            </button>
                            <div class="modal fade" id="sendEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" action="{{url('send')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Email</label>
                                                        <select name="email" class="form-control">
                                                            @forelse($users as $user)
                                                                <option >{{$user->email}}</option>
                                                            @empty
                                                                <option >No User</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">CC</label>
                                                        <select id="id-name" name="email" class="form-control" multiple="multiple">
                                                            @forelse($users as $user)
                                                                <option >{{$user->email}}</option>
                                                            @empty
                                                                <option >No User</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Subject</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Message</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Attachment</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    Send
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <select id = "mltislct" multiple = "multiple">
                <option value = "Bootstrap"> Bootstrap </option>
                <option value = "Angular"> Angular </option>
                <option value = "JavaScript"> JavaScript </option>
                <option value = "jquery"> jquery </option>
            </select>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#id-name').multiselect();
    });
</script>
</body>
</html>
