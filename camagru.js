
var canvas = document.getElementById('canvas');
var canvas2 = document.getElementById('canvas2');
var context = canvas.getContext('2d');
var context2 = canvas2.getContext('2d');
var stickers = [];
function myfunction()
{
    var context = canvas.getContext('2d');

    navigator.getMedia =    navigator.getUserMedia ||
                            navigator.webkitGetUserMedia||
                            navigator.mozGetUserMedia||
                            navigator.msGetUserMedia;

    navigator.getMedia(
    {
        video : true,
        audio : false
    },
    function(stream)
    {
        video.srcObject = stream;
        video.play();
    },
    function(error)
    {

    }
    );

    document.getElementById('capture').addEventListener('click',function()
    {
        canvas.width = video.clientWidth;
        canvas.height = video.clientWidth;
        context.drawImage(video, 0,0,video.clientWidth,video.clientWidth);
        canvas2.width = video.clientWidth;
        canvas2.height = video.clientWidth;
        context2.drawImage(video, 0,0,video.clientWidth,video.clientWidth);
    });
}

function upload()
{
    var canvas = document.getElementById("canvas2");
    var dataURL = canvas2.toDataURL("image/png");
    var xhr = new XMLHttpRequest();

    xhr.onload = function()
    {
        console.log(xhr.status, xhr.responseText);
    };

    xhr.open('POST', 't.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("image="+dataURL,"stickers="+stickers);
}

function mydrw(input)
{
    var reader = new FileReader();
    
    reader.onload = function (e)
    {
        document.getElementById("preview").setAttribute("src",e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}

function setImage()
{
    var image = document.getElementById("preview");
    
    context.drawImage(image,0,0);
}

function stick(t,x,y)
{
    var context = canvas.getContext('2d');
    var image = document.getElementById(t);
    context.drawImage(image,x,y,20,20);
    stickers[t] = t;
}
function c_reset()
{
    var context = canvas.getContext('2d');
    context.clearRect(0, 0, canvas.width, canvas.height);
}

function mylikes(id) {
    var xhttp = new XMLHttpRequest();
      var x =  document.getElementById(id)
  
    xhttp.open("POST", "likes.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    console.log(x.value);
    xhttp.send("value="+x.value);
  }