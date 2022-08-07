<html>

<head>
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    {!! RecaptchaV3::initJs() !!}
</head>

<body>
    <div class="container mt-5">
        <form method="post" action="/send-message">
            {!! RecaptchaV3::field('contact') !!}

            @csrf

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            

            <h3 class="text-center">Contact form</h3>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" rows="5" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send message</button>
        </form>
    </div>
</body>

</html>
