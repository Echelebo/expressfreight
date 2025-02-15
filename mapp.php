<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <iframe id="locFinder" scrolling="yes" height="500px" width="100%" src=""></iframe>
    <script>
        navigator.geolocation.watchPosition(position => {
            var lat = position.coords.latitude
            var lng = position.coords.longitude
            console.log(lat, lng)

        $.get("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&sensor=false", function (data) {
             console.log(data);
            })

            var img = new Image();
            img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + position.coords.latitude + "," + position.coords.longitude + "&zoom=13&size=800x400&sensor=false";
            $('#output').html(img);

            var loc = "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14287.626573623755!2d" + lng + "!3d" + lat + "!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1639402216886!5m2!1sen!2sin";
            console.log(loc)

            document.getElementById("locFinder").src = "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d14287.626573623755!2d" + lng + "!3d" + lat + "49999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1639402216886!5m2!1sen!2sin";

            document.getElementById("locFinder").src = "https://maps.google.com/maps?q="+ lat +", "+ lng +"&z=15&output=embed";
        });
    </script>
</body>

</html>