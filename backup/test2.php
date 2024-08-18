<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hide URL Parameters</title>
  <script type='text/javascript'>
    function getURLParameter(name) {
        return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]);
    }
    function hideURLParams() {
        //Parameters to hide (ie ?success=value, ?error=value, etc)
        var hide = ['id','class'];
        for(var h in hide) {
            if(getURLParameter(h)) {
                history.replaceState(null, document.getElementsByTagName("title")[0].innerHTML, window.location.pathname);
            }
        }
    }

    //Run onload, you can do this yourself if you want to do it a different way
    window.onload = hideURLParams;
</script>
</head>
<body>
  <div id="content">
    <!-- Your page content goes here -->
    <a href="test2.php?id=1&class=4" class="btn btn-outline-danger me-2">ตรวจสอบการสมัคร</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</body>
</html>