// Set constraints for the video stream
var constraints = { video: { facingMode: "user" }, audio: false };
let url_list = [];
// Define constants
const cameraView = document.querySelector("#camera--view"),
    cameraOutput = document.querySelector("#camera--output"),
    cameraSensor = document.querySelector("#camera--sensor"),
    cameraTrigger = document.querySelector("#camera--trigger"),
    returnArrow = document.getElementById("return_arrow"),
    complete = document.getElementById("complete"),
    camera = document.getElementById("camera"),
    edit_page = document.getElementById("edit_page");
// Access the device camera and stream to cameraView
function cameraStart() {
    navigator.mediaDevices
        .getUserMedia(constraints)
        .then(function(stream) {
        track = stream.getTracks()[0];
        cameraView.srcObject = stream;
    })
    .catch(function(error) {
        console.error("Oops. Something is broken.", error);
    });
}
// Take a picture when cameraTrigger is tapped
cameraTrigger.onclick = function() {
    if (cameraTrigger.innerText === "Confirm"){
    	url_list.push(cameraOutput.src);
		camera.classList.add("display_none");
		edit_page.classList.remove("display_none");
		for(i=0;i<url_list.length;i++) {
			let img_id = "img_" + (i+1);
			let img_tag = document.getElementById(img_id);
			img_tag.src = url_list[i]
		}
    }else{
    	cameraSensor.width = cameraView.videoWidth;
	    cameraSensor.height = cameraView.videoHeight;
	    cameraSensor.getContext("2d").drawImage(cameraView, 0, 0);
	    cameraOutput.src = cameraSensor.toDataURL("image/png");
	    cameraOutput.classList.remove("display_none");
	    cameraOutput.classList.add("taken");
	    cameraTrigger.classList.add("complete");
	    cameraView.classList.add("display_none");
	    cameraSensor.classList.add("display_none");
	    cameraTrigger.innerText = "Confirm";
    }
};

let img_2 = document.getElementById("img_2");
let img_3 = document.getElementById("img_3");
img_2.onclick = function(){
	cameraSensor.getContext("2d").clearRect(0,0,cameraSensor.width,cameraSensor.height);
	img_3.classList.remove("display_none");
	window.addEventListener("load", cameraStart, false);
	edit_page.classList.add("display_none");
	camera.classList.remove("display_none");
	cameraOutput.src = "//:0";
	cameraView.classList.remove("display_none");
	cameraSensor.classList.remove("display_none");
	cameraOutput.classList.add("display_none");
	cameraTrigger.innerText = "Take a picture";
};

img_3.onclick = function(){
	cameraSensor.getContext("2d").clearRect(0,0,cameraSensor.width,cameraSensor.height);
	window.addEventListener("load", cameraStart, false);
	edit_page.classList.add("display_none");
	camera.classList.remove("display_none");
	cameraOutput.src = "//:0";
	cameraView.classList.remove("display_none");
	cameraSensor.classList.remove("display_none");
	cameraOutput.classList.add("display_none");
	cameraTrigger.innerText = "Take a picture";
};


// Start the video stream when the window loads
window.addEventListener("load", cameraStart, false);


