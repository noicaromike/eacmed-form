const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

// dev mike
// i made it reusable by adding on input hidden value to <?php echo URLROOT . '/users/delete/';?>
// so we can use it for other delete functions.
function openModal(userId) {
    var modal = document.getElementById("modal");
    modal.style.display = "block";
    var deleteForm = document.getElementById("delete-form");
    var urlRootInput = document.getElementById("urlroot");
    var urlRoot = urlRootInput.value;
    deleteForm.action = urlRoot + userId; // output example www.eacmed-form/users/delete/1
}

function closeModal() {
    var modal = document.getElementById("modal");
    modal.style.display = "none";
}


function showSuccessAlert() {
    // console.log("showSuccessAlert() function called");
    var alertBox = document.getElementById("alert-container");
    if (alertBox) {
        // console.log("Alert container found");
        alertBox.style.display = "block";
        setTimeout(function(){
            // console.log("Hiding alert");
            alertBox.style.display = "none";
        }, 3000); // 3 seconds
    }
}
  
  // Call the function to show the alert
  showSuccessAlert();
