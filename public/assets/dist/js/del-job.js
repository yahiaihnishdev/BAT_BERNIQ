// Select elements for deletion confirmation
let all_del_inp = document.querySelectorAll(".del input");
let all_del_btn = document.querySelectorAll('.del i');
let confirm_box = document.querySelector(".confirm-del");
let record_inp = document.getElementById("record-id");

// Attach event listeners to delete buttons
for (let i = 0; i < all_del_btn.length; i++) {
    all_del_btn[i].onclick = function() {
        confirm_box.classList.remove("h-s");
        let record_id = all_del_inp[i].value;
        record_inp.value = record_id;
    }
}

// Close the confirmation box
document.getElementById('close-message').onclick = function() {
    confirm_box.classList.add("h-s");
}

// Proceed with deletion
document.getElementById('del-go').onclick = function() {
    location.assign(`del-job.php?job_id=${record_inp.value}`);
}
