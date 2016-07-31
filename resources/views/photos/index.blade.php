
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Villa Guest Residence</title>
    <meta name="description" content="Photo Real Time">
    <meta name="author" content="seojtix">
    <link rel="stylesheet" href="/css/vendor.css">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="fluid-container">
            <div class="navbar-header">
                <!--
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mobile-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                -->
                <a class="navbar-brand" href="/">Villa Guest Residence</a>
            </div>

            <!--
            <div class="collapse navbar-collapse" id="mobile-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/">Home</a></li>
                    <li><a href="/webcam">Webcam</a></li>
                </ul>
            </div>--><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

	<div class="fluid-container">

        <div v-if="$loadingAsyncData">Загрузка...</div>

        <div id="grid" v-if="!$loadingAsyncData" data-columns>
            <div class="panel panel-default" v-for="photo in photos">
                <div class="panel-body">
                    <a href="@{{ photo.name }}" target="_blank"><img v-bind:src="photo.name"></a>
                </div>
                <div class="panel-footer">@{{ photo.text_trimmed }}</div>
            </div>
        </div>

	</div>

    <footer class="footer">
        <div class="fluid-container">
            <p class="text-muted">&copy; Villa Guest Residence, {{ date('Y') }}.</p>
        </div>
    </footer>

    <script src="/js/vendor.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>
