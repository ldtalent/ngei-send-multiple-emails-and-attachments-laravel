<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js">
    </script>
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css"/>
</head>
<body>
<div class="container">
    <h2>Send Multiple Mails and Attachments</h2>
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#sendEmail">
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
                                <select id = "mltislct" multiple = "multiple">
                                    @forelse($users as $user)
                                        <option >{{$user->email}}</option>
                                    @empty
                                        <option >No User</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Subject</label>
                                <input type="text" class="form-control" name="subject">
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Message</label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label">Attachment</label>
                                <input type="file" class="form-control" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
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
<script>
    $(document).ready(function() {
        $('#mltislct').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            filterPlaceholder:'Search Here..'
        });
    });
</script>
</body>
</html>
