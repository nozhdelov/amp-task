<!doctype html>
<html>
<head>
   
 
    @vite(['resources/css/app.css'])
</head>

<body>
    
    @include($contentTpl)
    
     @vite(['resources/js/app.js'])
    
</body>

</html>