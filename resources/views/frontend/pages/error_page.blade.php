<html>
<header>
    <title>403 Forbidden</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</header>
<style type="text/css">
    body{ background-color: #e9e9e9; }
    .error-template { padding: 40px 15px;text-align: center; color: #00e777; }
    .error-actions { margin-top:15px;margin-bottom:15px; }
    .error-details { color: black; }
    .error-actions .btn { margin-right:10px; }
    .container { padding-top: 200px; }
</style>

<body>
<div class="container">
    <div class="row">
    <div class="error-template">
        <h1>403</h1>
        <h2>Forbidden</h2>
        <div class="error-details">
            Sorry, you do not have permission to access this page!<br>
        </div>
        <div class="error-actions">
        <a href="{{URL::route('frontend_index')}}" class="btn btn-primary">
            <i class="icon-home icon-white"></i> Take Me Home </a>
        </div>
    </div>
    </div>
</div>
</body>
</html>

